<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\ItemRequest;
use App\Interfaces\CRUDRepositoryInterface;
use App\Models\Product\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    private CRUDRepositoryInterface $itemRepository;

    private $path = 'products';
    private $folderPath = 'product.';
    private $model = 'App\Models\Product\Product';

    /**
     * Instantiate a new controller instance.
     */
    public function __construct(CRUDRepositoryInterface $itemRepository)
    {
        $this->itemRepository = $itemRepository;
    }

    public function index(Request $request)
    {
        $result = [];
        $data = $request->all();
        $counts = $this->itemRepository->getCount($this->model);
        $items = $this->itemRepository->getPaginateItems($this->model, $data);
        $result = [
            'items' => $items,
            'counts' => $counts,
        ];

        return view(
            'admin.'.$this->folderPath.$this->path.'.index',
            compact('result')
        );
    }

    public function show($id)
    {
        $item = $this->itemRepository->getItemById($this->model, $id);

        return view('admin.'.$this->folderPath.$this->path.'.show', compact('item'));
    }

    /**
     * Create a new controller instance.
     */
    public function create(Product $item)
    {
        $result['categories'] = $this->itemRepository
            ->getAllItemsWithScope('App\Models\Product\Category', 'Category');
        // $result['brands'] = $this->itemRepository
        //     ->getAllItems('App\Models\Product\Brand');

        $result['stores'] = $this->itemRepository
            ->getAllItemsWithScope('App\Models\Store\Store', 'Publish');

        $result['authors'] = $this->itemRepository
        ->getAllItems('App\Models\Product\Author');

        $result['tags'] = $this->itemRepository
            ->getAllItemsWithScope('App\Models\Product\Tag', 'Product');

        return view('admin.'.$this->folderPath.$this->path.'.create_and_edit', compact('item', 'result'));
    }

    public function store(ItemRequest $request)
    {
        $data = $request->all();
        if ($request->hasFile('image')) {
            $data['image'] = \App\Helpers\Image::upload($request->file('image'), $this->path);
        }

        $data['slug'] = \Illuminate\Support\Str::slug($data['title'][app()->getLocale()], '-');

        $item = $this->itemRepository->createItem($this->model, $data);
        // product_categories

        foreach ($request->input('document', []) as $file) {
            $item->addMedia(storage_path('tmp/uploads/'.$file))
                ->toMediaCollection('document');
        }
        $request->session()->flash('success', __('titles.AddedMessage'));

        return redirect()->route('admin.'.$this->path.'.index');
    }

    public function edit($id)
    {
        $item = $this->itemRepository->getItemById($this->model, $id);
        $result['categories'] = $this->itemRepository
            ->getAllItemsWithScope('App\Models\Product\Category', 'Category');
        $result['tags'] = $this->itemRepository
            ->getAllItemsWithScope('App\Models\Product\Tag', 'Product');
        $result['stores'] = $this->itemRepository
            ->getAllItemsWithScope('App\Models\Store\Store', 'Publish');
        // $result['brands'] = $this->itemRepository
        //     ->getAllItems('App\Models\Product\Brand');
        $result['sub_categories'] = $this->itemRepository
            ->getAllItemsWithScope('App\Models\Product\Category', 'SubCategory', ['category_id' => $item->category_id]);

        $result['authors'] = $this->itemRepository
        ->getAllItems('App\Models\Product\Author');

        return view('admin.'.$this->folderPath.$this->path.'.create_and_edit', compact('item', 'result'));
    }

    public function copy($id)
    {
        $item = $this->itemRepository->getItemById($this->model, $id);
        $newItem = $item->replicate();
        $newItem->save();

        return redirect()->route('admin.'.$this->path.'.edit', $newItem->id);
    }

    public function update(ItemRequest $request, $id)
    {
        $data = $request->except(['_token', '_method']);

        if ($request->hasFile('image')) {
            $data['image'] = \App\Helpers\Image::upload($request->file('image'), $this->path);
        }
        $data['slug'] = \Illuminate\Support\Str::slug($data['title'][app()->getLocale()], '-');
        $this->itemRepository->updateItem($this->model, $id, $data);
        $item = $this->itemRepository->getItemById($this->model, $id);

        if (!empty($item->getMedia('document'))) {
            foreach ($item->getMedia('document') as $media) {
                if (!in_array($media->file_name, $request->input('document', []))) {
                    $media->delete();
                }
            }
        }

        $media = $item->getMedia('document')->pluck('file_name')->toArray();

        foreach ($request->input('document', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $item->addMedia(storage_path('tmp/uploads/'.$file))
                    ->addCustomHeaders([
                        'ACL' => 'public-read',
                    ])
                    ->toMediaCollection('document');
            }
        }

        $request->session()->flash('success', __('titles.UpdatedMessage'));

        return redirect()->route('admin.'.$this->path.'.index');
    }

    public function destroy(Request $request, $id)
    {
        $this->itemRepository->deleteItem($this->model, $id);
        $request->session()->flash('success', __('titles.DeletedMessage'));

        return redirect()->route('admin.'.$this->path.'.index');
    }
}
