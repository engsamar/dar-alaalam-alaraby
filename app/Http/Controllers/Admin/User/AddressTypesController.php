<?php

namespace App\Http\Controllers\Admin\User;


use Illuminate\Http\Request;
use App\Models\User\AddressType;
use App\Http\Requests\ItemRequest;
use App\Http\Controllers\Controller;
use App\Interfaces\CRUDRepositoryInterface;


class AddressTypesController extends Controller
{
    private CRUDRepositoryInterface $itemRepository;

    private $path = 'types';
    private $folderPath = 'user.';
    private $model = 'App\Models\User\AddressType';

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
        $counts = $this->itemRepository->getCount($this->model, null);
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
    public function create(AddressType  $item)
    {
        return view('admin.'.$this->folderPath.$this->path.'.create_and_edit', compact('item'));
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

        return view('admin.'.$this->folderPath.$this->path.'.create_and_edit', compact('item'));
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

    //searchSubCat
    public function searchSubCat()
    {
        $id =  app('request')->input('id');
        $data = $this->itemRepository
            ->getAllItemsWithScope($this->model, 'SubAddressType')
            ->where('AddressType_id', app('request')->input('id'));

        return view('admin.layouts.pages.options', compact('data'))->render();
    }
}
