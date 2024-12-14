<?php

namespace App\Http\Controllers\Admin;

use App\Models\Store\Store;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRequest;
use App\Http\Controllers\Controller;
use App\Interfaces\CRUDRepositoryInterface;

class StoresController extends Controller
{
    private CRUDRepositoryInterface $itemRepository;

    private $path = 'stores';
    private $folderPath = '';
    private $model = 'App\Models\Store\Store';

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
    public function create(Store  $item)
    {
        $result['categories'] = $this->itemRepository
            ->getAllItemsWithScope('App\Models\Product\Category', 'Store');

        $result['cities'] = $this->itemRepository
            ->getAllItemsWithScope('App\Models\City', 'City');

        $result['areas'] = $this->itemRepository
            ->getAllItemsWithScope('App\Models\City', 'Area');

        return view('admin.'.$this->folderPath.$this->path.'.create_and_edit', compact('item', 'result'));
    }

    public function store(StoreRequest $request)
    {
        $data = $request->all();
        if ($request->hasFile('image')) {
            $data['image'] = \App\Helpers\Image::upload($request->file('image'), $this->path);
        }
        if ($request->hasFile('logo')) {
            $data['logo'] = \App\Helpers\Image::upload($request->file('logo'), 'logo-'.$this->path);
        }
        $item = $this->itemRepository->createItem($this->model, $data);

        foreach ($request->input('document', []) as $file) {
            $item->addMedia(storage_path('tmp/uploads/' . $file))
                ->toMediaCollection('document');
        }
        $request->session()->flash('success', __('titles.AddedMessage'));

        return redirect()->route('admin.'.$this->path.'.index');
    }

    public function edit($id)
    {
        $item = $this->itemRepository->getItemById($this->model, $id);
        $result['categories'] = $this->itemRepository->getAllItemsWithScope('App\Models\Product\Category', 'Store');
        $result['cities'] = $this->itemRepository
            ->getAllItemsWithScope('App\Models\City', 'City');

        $result['areas'] = $this->itemRepository
            ->getAllItemsWithScope('App\Models\City', 'Area');

        return view('admin.'.$this->folderPath.$this->path.'.create_and_edit', compact('item', 'result'));
    }

    public function update(StoreRequest $request, $id)
    {
        $data = $request->except(['_token', '_method' ]);

        if ($request->hasFile('image')) {
            $data['image'] = \App\Helpers\Image::upload($request->file('image'), $this->path);
        }
        if ($request->hasFile('logo')) {
            $data['logo'] = \App\Helpers\Image::upload($request->file('logo'), 'logo-'.$this->path);
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
