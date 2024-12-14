<?php

namespace App\Http\Controllers\Store;

use App\Helpers\Constants;
use Illuminate\Http\Request;
use App\Models\Ordering\Order;
use App\Http\Requests\OrderRequest;
use App\Http\Controllers\Controller;
use App\Interfaces\CRUDRepositoryInterface;

class OrdersController extends Controller
{
    private CRUDRepositoryInterface $orderRepository;
    private $path = 'orders';
    private $scope = null;


    public function __construct(CRUDRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function index(Request $request)
    {
        $result = [];
        $data = $request->all();
        $data['conditionsWhere'] = ['store_id' => auth()->guard('store')->user()->id,'order_type' => 'cart'];


        if(isset($data['status']) && $data['status'] == 'new') {
            $this->scope = 'Opened';
        } elseif(isset($data['status']) && $data['status'] == 'past') {
            $this->scope = 'Closed';
        }elseif(isset($data['status']) && $data['status'] == 'processing') {
            $this->scope = 'Processing';
        }elseif(isset($data['status']) && $data['status'] == 'cancelled') {
            $this->scope = 'Cancelled';
        }



        $counts = $this->orderRepository->getCount($data, $this->scope);
        $items = $this->orderRepository->getPaginateOrders($data, $this->scope);
        $result = [
            'items' => $items,
            'counts' => $counts,
        ];
        return view(
            'store.'.$this->path.'.index',
            compact('result')
        );
    }

    public function show($id)
    {
        $item = $this->orderRepository->getOrderById($id);
        return view('store.'.$this->path.'.show', compact('item'));
    }

    public function create(Order $item)
    {
        return view('store.'.$this->path.'.create_and_edit', compact('item'));
    }

    public function store(OrderRequest $request)
    {
        $data = $request->all();
        if ($request->hasFile('image')) {
            $data['image'] = \App\Helpers\Image::upload($request->file('image'), $this->path);
        }
        $data['type'] = Constants::BankType;

        $this->orderRepository->createOrder($data);

        if (isset($request->action) && $request->action == 'preview') {
            return redirect()->route('store.'.$this->path.'.store')
                    ->with('message', __('store.AddedMessage'));
        }

        return redirect()->route('store.'.$this->path.'.index')
            ->with('message', __('store.AddedMessage'));
    }

    public function edit($id)
    {
        $item = $this->orderRepository->getOrderById($id);
        // dd( $item );
        return view('store.'.$this->path.'.create_and_edit', compact('item'));
    }

    public function update(OrderRequest $request, $id)
    {
        $data = $request->except(['_token', '_method' ]);

        if ($request->hasFile('image')) {
            $data['image'] = \App\Helpers\Image::upload($request->file('image'), $this->path);
        }
        $this->orderRepository->updateOrder($id, $data);

        return redirect()->route('store.'.$this->path.'.index')
            ->with('message', __('store.UpdatedMessage'));
    }

    public function destroy($id)
    {
        $this->orderRepository->deleteOrder($id);

        return redirect()->route('store.'.$this->path.'.index')
            ->with('message', __('store.DeletedMessage'));
    }
}
