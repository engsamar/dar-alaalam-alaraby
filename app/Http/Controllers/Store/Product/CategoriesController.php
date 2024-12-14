<?php

namespace App\Http\Controllers\Store\Product;

use App\Helpers\Constants;
use Illuminate\Http\Request;
use App\Models\Product\Category;
use App\Http\Requests\ItemRequest;
use App\Http\Controllers\Controller;
use App\Interfaces\CRUDRepositoryInterface;


class CategoriesController extends Controller
{
    private CRUDRepositoryInterface $itemRepository;

    private $path = 'categories';
    private $folderPath = 'store.product.';
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
        $data['conditionsWhere'] = ['store_id' => auth()->guard('store')->user()->id];

        $counts = $this->itemRepository->getCount($this->model, $data, 'Food');
        $items = $this->itemRepository->getPaginateItems($this->model, $data, 'Food');
        $result = [
            'items' => $items,
            'counts' => $counts,
        ];
        return view(
            $this->folderPath.$this->path.'.index',
            compact('result')
        );
    }

    public function show($id)
    {
        $item = $this->itemRepository->getItemById($this->model, $id);
        return view($this->folderPath.$this->path.'.show', compact('item'));
    }

    /**
     * Create a new controller instance.
    */
    public function create(Category  $item)
    {
        return view($this->folderPath.$this->path.'.create_and_edit', compact('item'));
    }

    public function store(ItemRequest $request)
    {
        $data = $request->all();
        if ($request->hasFile('image')) {
            $data['image'] = \App\Helpers\Image::upload($request->file('image'), $this->path);

        }
        $data['type'] = Constants::CATEGORY_FOOD;
        $data['store_id'] = auth()->guard('store')->user()->id;
        $this->itemRepository->createItem($this->model, $data);
        $request->session()->flash('success', __('messages.AddedMessage'));

        return redirect()->route('store.'.$this->path.'.index');
    }

    public function edit($id)
    {
        $item = $this->itemRepository->getItemById($this->model, $id);

        return view($this->folderPath.$this->path.'.create_and_edit', compact('item'));
    }

    public function update(ItemRequest $request, $id)
    {
        $data = $request->except(['_token', '_method' ]);

        if ($request->hasFile('image')) {
            $data['image'] = \App\Helpers\Image::upload($request->file('image'), $this->path);
        }
        $this->itemRepository->updateItem($this->model, $id, $data);
        $request->session()->flash('success', __('messages.UpdatedMessage'));

        return redirect()->route('store.'.$this->path.'.index');
    }

    public function destroy(Request $request, $id)
    {
        $this->itemRepository->deleteItem($this->model, $id);
        $request->session()->flash('success', __('messages.DeletedMessage'));
        return redirect()->route('store.'.$this->path.'.index');
    }

    //searchSubCat
    public function searchSubCat()
    {
        $id =  app('request')->input('id');
        $data = $this->itemRepository
            ->getAllItemsWithScope($this->model, 'SubCategory')
            ->where('category_id', app('request')->input('id'));

        return view('admin.layouts.pages.options', compact('data'))->render();
    }
}
