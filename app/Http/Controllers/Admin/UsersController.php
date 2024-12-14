<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Permission\Role;
use App\Http\Requests\AdminRequest;
use App\Http\Controllers\Controller;
use App\Interfaces\CRUDRepositoryInterface;

class UsersController extends Controller
{
    private CRUDRepositoryInterface $itemRepository;

    private $path = 'users';
    private $folderPath = 'admin.users.';
    private $model = 'App\Models\User';

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
        $counts = $this->itemRepository->getCount($this->model,$data);
        $items = $this->itemRepository->getPaginateItems($this->model,$data);
        $result = [
            'from_date' => $from_date,
            'to_date' => $to_date,
            'items' => $items,
            'counts' => $counts,
            'status' => $status,
            'search' => $search,
        ];
        return view(
            'admin.'.$this->path.'.index',
            compact('result')
        );
    }

    public function show($id)
    {
        $item = $this->itemRepository->getItemById($this->model, $id);
        return view($this->folderPath.'.show', compact('item'));
    }

    public function create(User $item)
    {
        $result = [];
        return view($this->folderPath.'.create_and_edit', compact('item', 'result'));
    }

    public function store(AdminRequest $request)
    {
        $data = $request->all();
        if ($request->hasFile('image')) {
            $data['image'] = \App\Helpers\Image::upload($request->file('image'), $this->path);
        }
        $user = $this->itemRepository->createItem($this->model, $data);


        if (isset($request->action) && $request->action == 'preview') {
            return redirect()->route('admin.'.$this->path.'.store')
                    ->with(['alert' => 'success' , 'message'=> __('admin.AddedMessage')]);
        }

        return redirect()->route('admin.'.$this->path.'.index')
            ->with(['alert' => 'success' ,'message'=> __('admin.AddedMessage')]);
    }

    public function edit($id)
    {
        $item = $this->itemRepository->getItemById($this->model, $id);
        $result=[];

        return view($this->folderPath.'.create_and_edit', compact('item','result'));
    }

    public function update(AdminRequest $request, $id)
    {
        $data = $request->except(['_token', '_method' ]);
        if(! $request->password ){
            $data = $request->except(['_token', '_method','password' ]);
        }
        if ($request->hasFile('image')) {
            $data['image'] = \App\Helpers\Image::upload($request->file('image'), $this->path);
        }

        $this->itemRepository->updateItem($this->model, $id, $data);
        $user = $this->itemRepository->getItemById($this->model, $id);

        return redirect()->route('admin.'.$this->path.'.index')
            ->with(['alert' => 'warning' ,'message'=> __('admin.UpdatedMessage')]);
    }

    public function destroy($id)
    {
        $this->itemRepository->deleteItem($this->model, $id);

        return redirect()->route('admin.'.$this->path.'.index')
            ->with(['alert' => 'danger' ,'message'=> __('admin.DeletedMessage')]);
    }
}
