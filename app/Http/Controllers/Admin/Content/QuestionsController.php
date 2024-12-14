<?php

namespace App\Http\Controllers\Admin\Content;

use App\Models\Content;
use App\Helpers\Constants;
use Illuminate\Http\Request;
use App\Http\Requests\ItemRequest;
use App\Http\Controllers\Controller;
use App\Interfaces\CRUDRepositoryInterface;


class QuestionsController extends Controller
{
    private CRUDRepositoryInterface $itemRepository;

    private $path = 'questions';
    private $scope = 'Question';
    private $folderPath = 'content.';
    private $model = 'App\Models\Content';

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
        $items = $this->itemRepository->getPaginateItems($this->model, $data, $this->scope);
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
    public function create(Content $item)
    {
        return view('admin.'.$this->folderPath.$this->path.'.create_and_edit', compact('item'));
    }

    public function store(ItemRequest $request)
    {
        $data = $request->all();
        $data['type'] = Constants::QUESTION_TYPE;
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

}
