<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Ordering\Order;
use App\Http\Requests\OrderRequest;
use App\Http\Controllers\Controller;
use App\Interfaces\CRUDRepositoryInterface;

class OrdersController extends Controller
{
    private CRUDRepositoryInterface $orderRepository;
    private $path = 'orders';
    private $model = 'App\Models\Ordering\Order';

    private $scope = null;


    public function __construct(CRUDRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function index(Request $request)
    {
        $result = [];
        $data = [];

        // $data['conditionsWhere'] = ['order_type' => $request->type ?? 'cart'];

        // if(isset($data['status']) && $data['status'] == 'new') {
        //     $this->scope = 'Opened';
        // } elseif(isset($data['status']) && $data['status'] == 'past') {
        //     $this->scope = 'Closed';
        // }elseif(isset($data['status']) && $data['status'] == 'processing') {
        //     $this->scope = 'Processing';
        // }elseif(isset($data['status']) && $data['status'] == 'cancelled') {
        //     $this->scope = 'Cancelled';
        // }

        // cancelled processing
        $counts = $this->orderRepository->getCount($this->model, $data, $this->scope);
        $items = $this->orderRepository->getPaginateItems($this->model, $data, $this->scope);
        $result = [
            'items' => $items,
            'counts' => $counts,
        ];
        return view(
            'admin.'.$this->path.'.index',
            compact('result')
        );
    }

    public function show($id)
    {
        $item = $this->orderRepository->getItemById($this->model, $id);
        return view('admin.'.$this->path.'.show', compact('item'));
    }

    public function create(Order $item)
    {
        return view('admin.'.$this->path.'.create_and_edit', compact('item'));
    }


    public function edit($id)
    {
        $item = $this->orderRepository->getItemById($this->model, $id);
        // dd( $item );
        return view('admin.'.$this->path.'.create_and_edit', compact('item'));
    }

    public function update(OrderRequest $request, $id)
    {
        $data = $request->except(['_token', '_method' ]);

        $this->orderRepository->updateItem($this->model,$id, $data);

        return redirect()->route('admin.'.$this->path.'.index')
            ->with('message', __('admin.UpdatedMessage'));
    }

    public function destroy($id)
    {
        $this->orderRepository->deleteItem($this->model, $id);

        return redirect()->route('admin.'.$this->path.'.index')
            ->with('message', __('admin.DeletedMessage'));
    }
}
