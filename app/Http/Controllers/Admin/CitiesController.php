<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use Illuminate\Http\Request;
use App\Http\Requests\ItemRequest;
use App\Http\Controllers\Controller;
use App\Interfaces\CRUDRepositoryInterface;

class CitiesController extends Controller
{
    private CRUDRepositoryInterface $itemRepository;

    private $path = 'cities';
    private $route = 'admin.cities';
    private $folderPath = 'admin.cities';
    private $model = 'App\Models\City';

    private $scope = 'City';
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
        $status = $data['status'] ?? '-1';
        $search = $data['search'] ?? '';
        $from_date = $data['from_date'] ?? '';
        $to_date = $data['to_date'] ?? '';
        $counts = $this->itemRepository->getCount($this->model, [], $this->scope);
        $items = $this->itemRepository->getPaginateItems($this->model, $data, $this->scope);
        $result = [
            'from_date' => $from_date,
            'to_date' => $to_date,
            'items' => $items,
            'counts' => $counts,
            'status' => $status,
            'search' => $search,
        ];
        return view(
            $this->folderPath.'.index',
            compact('result')
        );
    }

    public function show($id)
    {
        $item = $this->itemRepository->getItemById($this->model, $id);
        return view($this->folderPath.'.show', compact('item'));
    }

    public function create(City $item)
    {
        return view($this->folderPath.'.create_and_edit', compact('item'));
    }

    public function store(ItemRequest $request)
    {
        $data = $request->all();
        if ($request->hasFile('image')) {
            $data['image'] = \App\Helpers\Image::upload($request->file('image'), $this->path);
        }

        $this->itemRepository->createItem($this->model, $data);

        if (isset($request->action) && $request->action == 'preview') {
            return redirect()->route($this->route.'.store')
                    ->with('message', __('admin.AddedMessage'));
        }

        return redirect()->route($this->route.'.index')
            ->with('message', __('admin.AddedMessage'));
    }

    public function edit($id)
    {
        $item = $this->itemRepository->getItemById($this->model, $id);
        // dd( $item );
        return view($this->route.'.create_and_edit', compact('item'));
    }

    public function update(ItemRequest $request, $id)
    {
        $data = $request->except(['_token', '_method' ]);

        if ($request->hasFile('image')) {
            $data['image'] = \App\Helpers\Image::upload($request->file('image'), $this->path);
        }
        $this->itemRepository->updateItem($this->model, $id, $data);

        return redirect()->route($this->route.'.index')
            ->with('message', __('admin.UpdatedMessage'));
    }

    public function destroy($id)
    {
        $this->itemRepository->deleteItem($this->model, $id);

        return redirect()->route($this->route.'.index')
            ->with('message', __('admin.DeletedMessage'));
    }
}
