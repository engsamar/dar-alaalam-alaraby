<?php

namespace App\Http\Controllers\Admin\Product;

use App\Helpers\Constants;
use Illuminate\Http\Request;
use App\Models\Product\Category;
use App\Http\Requests\ItemRequest;
use App\Http\Controllers\Controller;
use App\Interfaces\CRUDRepositoryInterface;

class SubCategoriesController extends Controller
{
    private CRUDRepositoryInterface $itemRepository;

    private $path = 'sub_categories';
    private $folderPath = 'product.';
    private $model = 'App\Models\Product\Category';

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
        $counts = $this->itemRepository->getCount($this->model, null, 'SubCategory');
        $items = $this->itemRepository->getPaginateItems($this->model, $data, 'SubCategory');
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
    public function create(Category  $item)
    {
        $result['categories'] = $this->itemRepository
            ->getAllItemsWithScope($this->model, 'Category');

        return view('admin.'.$this->folderPath.$this->path.'.create_and_edit', compact('item', 'result'));
    }

    public function store(ItemRequest $request)
    {
        $data = $request->all();
        if ($request->hasFile('image')) {
            $data['image'] = \App\Helpers\Image::upload($request->file('image'), $this->path);

        }

        $this->itemRepository->createItem($this->model, $data);
        $request->session()->flash('success', __('titles.AddedMessage'));

        return redirect()->route('admin.'.$this->path.'.index');
    }

    public function edit($id)
    {
        $item = $this->itemRepository->getItemById($this->model, $id);
        $result['categories'] = $this->itemRepository
            ->getAllItemsWithScope($this->model, 'Category');

        return view('admin.'.$this->folderPath.$this->path.'.create_and_edit', compact('item','result'));
    }

    public function update(ItemRequest $request, $id)
    {
        $data = $request->except(['_token', '_method' ]);

        if ($request->hasFile('image')) {
            $data['image'] = \App\Helpers\Image::upload($request->file('image'), $this->path);
        }
        $this->itemRepository->updateItem($this->model, $id, $data);
        $request->session()->flash('success', __('titles.UpdatedMessage'));

        return redirect()->route('admin.'.$this->path.'.index');
    }

    public function destroy(Request $request, $id)
    {
        $this->itemRepository->deleteItem($this->model, $id);
        $request->session()->flash('success', __('titles.DeletedMessage'));
        return redirect()->route('admin.'.$this->path.'.index');
    }

    //searchSubCat search
    public function search(Request $request)
    {

        $result['categories'] = $this->itemRepository
            ->getPaginateItems($this->model, ['where'=>['category_id' => $request->category ]], 'SubCategory');

        return view('admin.'.$this->folderPath.$this->path.'option',compact('result'))->render();
    }

}
