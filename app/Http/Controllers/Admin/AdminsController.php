<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Models\Permission\Role;
use App\Http\Requests\AdminRequest;
use App\Http\Controllers\Controller;
use App\Interfaces\CRUDRepositoryInterface;

class AdminsController extends Controller
{
    private CRUDRepositoryInterface $itemRepository;

    private $path = 'admins';
    private $folderPath = 'admin.admins.';
    private $model = 'App\Models\Admin';

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
        $counts = $this->itemRepository->getCount();
        $items = $this->itemRepository->getPaginateAdmins($data);
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
        $item = $this->itemRepository->getAdminById($id);
        return view('admin.'.$this->path.'.show', compact('item'));
    }

    public function create(Admin $item)
    {
        $result['roles'] = Role::all();
        return view('admin.'.$this->path.'.create_and_edit', compact('item', 'result'));
    }

    public function store(AdminRequest $request)
    {
        $data = $request->all();
        if ($request->hasFile('image')) {
            $data['image'] = \App\Helpers\Image::upload($request->file('image'), $this->path);
        }
        $user = $this->itemRepository->createAdmin($data);
        $user->syncRoles([$request->role_id]);

        if (isset($request->action) && $request->action == 'preview') {
            return redirect()->route('admin.'.$this->path.'.store')
                    ->with(['alert' => 'success' , 'message'=> __('admin.AddedMessage')]);
        }

        return redirect()->route('admin.'.$this->path.'.index')
            ->with(['alert' => 'success' ,'message'=> __('admin.AddedMessage')]);
    }

    public function edit($id)
    {
        $item = $this->itemRepository->getAdminById($id);
        $result['roles'] = Role::all();

        return view('admin.'.$this->path.'.create_and_edit', compact('item','result'));
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

        $this->itemRepository->updateAdmin($id, $data);
        $user = $this->itemRepository->getAdminById($id);

        $user->syncRoles([$request->role_id]);

        return redirect()->route('admin.'.$this->path.'.index')
            ->with(['alert' => 'warning' ,'message'=> __('admin.UpdatedMessage')]);
    }

    public function destroy($id)
    {
        $this->itemRepository->deleteAdmin($id);

        return redirect()->route('admin.'.$this->path.'.index')
            ->with(['alert' => 'danger' ,'message'=> __('admin.DeletedMessage')]);
    }
}
