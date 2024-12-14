<?php

namespace App\Http\Controllers\Admin\Promotion;

use App\Helpers\Constants;
use Illuminate\Http\Request;
use App\Models\User\Notification;
use App\Http\Requests\ItemRequest;
use App\Http\Controllers\Controller;
use App\Models\Promotion\CouponCompany;
use App\Interfaces\CRUDRepositoryInterface;

class NotificationsController extends Controller
{
    private CRUDRepositoryInterface $itemRepository;

    private $path = 'notifications';
    private $folderPath = 'admin.promotions';
    private $__route_path = 'admin';
    private $model = 'App\Models\User\Notification';

    /**
     * Instantiate a new controller instance.
    */
    public function __construct(CRUDRepositoryInterface $itemRepository)
    {
        $this->itemRepository = $itemRepository;
        // $this->middleware('checkPermission:notifications.index')->only(['index']);
        // $this->middleware('checkPermission:notifications.show')->only(['show']);
        // $this->middleware('checkPermission:notifications.edit')->only(['edit']);
        // $this->middleware('checkPermission:notifications.delete')->only(['destroy']);
        // $this->middleware('checkPermission:notifications.create')->only(['create']);
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
            $this->folderPath.'.'.$this->path.'.index',
            compact('result')
        );
    }

    public function show($id)
    {
        $item = $this->itemRepository->getItemById($this->model, $id);
        return view($this->folderPath.'.'.$this->path.'.show', compact('item'));
    }

    /**
     * Create a new controller instance.
    */
    public function create(Notification  $item)
    {
        $result['companies'] = $this->itemRepository
            ->getPaginateItems('App\Models\User', [], 'Company');

        $result['punchers'] = $this->itemRepository
            ->getPaginateItems('App\Models\User', [], 'Puncher');

        $result['customers'] = $this->itemRepository
            ->getPaginateItems('App\Models\User', [],'Customer');

        $result['employees'] = $this->itemRepository
            ->getPaginateItems('App\Models\User', [],'Employee');

        $result['topics'] = Constants::FCM_TOPICS;

        return view($this->folderPath.'.'.$this->path.'.create_and_edit', compact('item', 'result'));
    }

    public function store(ItemRequest $request)
    {
        $arDevices = [];
        $enDevices = [];
        $data = $request->all();
        $item = $this->itemRepository->createItem($this->model, $data);
        $ids1 = array_merge($request->companies ?? [], $request->punchers ?? []);
        $ids2 = array_merge($request->employees ?? [], $request->customers ?? []);
        $users = array_merge($ids2, $ids1);
        $users = array_filter($users);
        if(! empty($users) && count($users)){
            $enDevices = \App\Models\User\UserDevice::whereLang('en')->whereUserId($users)->pluck('fcm_token')->toArray();
            $arDevices = \App\Models\User\UserDevice::whereLang('ar')->whereUserId($users)->pluck('fcm_token')->toArray();
        }
        if(! empty($enDevices) && count($enDevices)){
            $sent = \App\Services\Firebase::send($enDevices, $item->getTranslation('title', 'en'), $item->getTranslation('message', 'en'), []);
        }

        if(! empty($arDevices) && count($arDevices)){
            $sent = \App\Services\Firebase::send($arDevices, $item->getTranslation('title', 'ar'), $item->getTranslation('message', 'en'), []);
        }
        $request->session()->flash('success', __('titles.AddedMessage'));

        return redirect()->route($this->__route_path.'.'.$this->path.'.index');
    }

    public function edit($id)
    {
        $item = $this->itemRepository->getItemById($this->model, $id);
        $result['companies'] = $this->itemRepository
            ->getPaginateItems('App\Models\Company\Company', []);

        return view($this->folderPath.'.'.$this->path.'.create_and_edit', compact('item', 'result'));
    }

    public function update(ItemRequest $request, $id)
    {
        $data = $request->except(['_token', '_method' ]);

        $this->itemRepository->updateItem($this->model, $id, $data);
        $item = $this->itemRepository->getItemById($this->model, $id);
        CouponCompany::whereNotIn('company_id', [$request->companies])->delete();

        if(! empty($request->companies)) {
            foreach($request->companies as $company) {
                $companyItem = ['company_id' => $company,'coupon_id' => $item->id];
                CouponCompany::updateOrCreate($companyItem, $companyItem);
            }
        }
        $request->session()->flash('success', __('titles.UpdatedMessage'));

        return redirect()->route($this->__route_path.'.'.$this->path.'.index');
    }

    public function destroy(Request $request, $id)
    {
        $this->itemRepository->deleteItem($this->model, $id);
        $request->session()->flash('success', __('titles.DeletedMessage'));

        return redirect()->route($this->__route_path.'.'.$this->path.'.index');
    }
}
