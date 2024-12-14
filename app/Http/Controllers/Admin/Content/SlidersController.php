<?php

namespace App\Http\Controllers\Admin\Content;

use App\Models\Banner;
use App\Helpers\Constants;
use Illuminate\Http\Request;
use App\Http\Requests\ItemRequest;
use App\Http\Controllers\Controller;
use App\Interfaces\CRUDRepositoryInterface;


class SlidersController extends Controller
{
    private CRUDRepositoryInterface $itemRepository;

    private $path = 'sliders';
    private $scope = 'Slider';
    private $folderPath = 'content.';
    private $model = 'App\Models\Banner';

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
        $counts = $this->itemRepository->getCount($this->model, $data, $this->scope);
        $items = $this->itemRepository->getPaginateItems($this->model, $data, $this->scope);
        $result = [
            'items' => $items,
            'counts' => $counts,
        ];
        return view(
            'admin.' . $this->folderPath . $this->path . '.index',
            compact('result')
        );
    }

    public function show($id)
    {
        $item = $this->itemRepository->getItemById($this->model, $id);
        return view('admin.' . $this->folderPath . $this->path . '.show', compact('item'));
    }

    /**
     * Create a new controller instance.
     */
    public function create(Banner $item)
    {
        return view('admin.' . $this->folderPath . $this->path . '.create_and_edit', compact('item'));
    }

    public function store(ItemRequest $request)
    {
        $data = $request->all();
        $image = 'image';
        if ($request->hasFile($image . '.en')) {
            $data[$image]['en'] = \App\Helpers\Image::upload($request->file($image . '.en'), $this->path . '/en');
        }
        if ($request->hasFile($image . '.ar')) {
            $data[$image]['ar'] = \App\Helpers\Image::upload($request->file($image . '.ar'), $this->path . '/ar');
        }
        $data['type'] = Constants::SLIDER_BANNER;
        $this->itemRepository->createItem($this->model, $data);
        $request->session()->flash('success', __('titles.AddedMessage'));

        return redirect()->route('admin.' . $this->path . '.index');
    }

    public function edit($id)
    {
        $item = $this->itemRepository->getItemById($this->model, $id);

        return view('admin.' . $this->folderPath . $this->path . '.create_and_edit', compact('item'));
    }

    public function update(ItemRequest $request, $id)
    {
        $data = $request->except(['_token', '_method']);

        $image = 'image';
        if ($request->hasFile($image . '.en')) {
            $data[$image]['en'] = \App\Helpers\Image::upload($request->file($image . '.en'), $this->path . '/en');
        }
        if ($request->hasFile($image . '.ar')) {
            $data[$image]['ar'] = \App\Helpers\Image::upload($request->file($image . '.ar'), $this->path . '/ar');
        }
        $this->itemRepository->updateItem($this->model, $id, $data);
        $request->session()->flash('success', __('titles.UpdatedMessage'));

        return redirect()->route('admin.' . $this->path . '.index');
    }

    public function destroy(Request $request, $id)
    {
        $this->itemRepository->deleteItem($this->model, $id);
        $request->session()->flash('success', __('titles.DeletedMessage'));
        return redirect()->route('admin.' . $this->path . '.index');
    }
}
