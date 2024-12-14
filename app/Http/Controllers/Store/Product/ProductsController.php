<?php

namespace App\Http\Controllers\Store\Product;

use Illuminate\Http\Request;
use App\Models\Product\Product;
use App\Http\Requests\ItemRequest;
use App\Http\Controllers\Controller;
use App\Models\Product\ProductCategory;
use App\Interfaces\CRUDRepositoryInterface;

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
        $data['conditionsWhere'] = ['store_id' => auth()->guard('store')->user()->id];
        $counts = $this->itemRepository->getCount($this->model, $data);
        $items = $this->itemRepository->getPaginateItems($this->model, $data);
        $result = [
            'items' => $items,
            'counts' => $counts,
        ];
        return view(
            'store.'.$this->folderPath.$this->path.'.index',
            compact('result')
        );
    }

    public function show($id)
    {
        $item = $this->itemRepository->getItemById($this->model, $id);
        return view('store.'.$this->folderPath.$this->path.'.show', compact('item'));
    }

    /**
     * Create a new controller instance.
    */
    public function create(Product $item)
    {
        $result['categories'] = $this->itemRepository
            ->getAllItemsWithScope('App\Models\Product\Category', 'Food');


        return view('store.'.$this->folderPath.$this->path.'.create_and_edit', compact('item', 'result'));
    }

    public function store(ItemRequest $request)
    {
        $data = $request->all();
        if ($request->hasFile('image')) {
            $data['image'] = \App\Helpers\Image::upload($request->file('image'), $this->path);
        }
        $data['store_id'] = auth()->guard('store')->user()->id;

        $item = $this->itemRepository->createItem($this->model, $data);
        //product_categories

        foreach ($request->input('document', []) as $file) {
            $item->addMedia(storage_path('tmp/uploads/' . $file))
                ->toMediaCollection('document');
        }
        $request->session()->flash('success', __('messages.AddedMessage'));

        return redirect()->route('store.'.$this->path.'.index');
    }

    public function edit($id)
    {
        $item = $this->itemRepository->getItemById($this->model, $id);
        $result['categories'] = $this->itemRepository
            ->getAllItemsWithScope('App\Models\Product\Category', 'Food');

        return view('store.'.$this->folderPath.$this->path.'.create_and_edit', compact('item', 'result'));
    }

    public function update(ItemRequest $request, $id)
    {
        $data = $request->except(['_token', '_method' ]);

        if ($request->hasFile('image')) {
            $data['image'] = \App\Helpers\Image::upload($request->file('image'), $this->path);
        }
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
                $item->addMedia(storage_path('tmp/uploads/' . $file))
                    ->addCustomHeaders([
                        'ACL' => 'public-read',
                    ])
                    ->toMediaCollection('document');
            }
        }

        $request->session()->flash('success', __('messages.UpdatedMessage'));

        return redirect()->route('store.'.$this->path.'.index');
    }

    public function destroy(Request $request, $id)
    {
        $this->itemRepository->deleteItem($this->model, $id);
        $request->session()->flash('success', __('messages.DeletedMessage'));

        return redirect()->route('store.'.$this->path.'.index');
    }
}
