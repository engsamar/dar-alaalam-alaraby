<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderDeliveryRequest;
use App\Interfaces\CRUDRepositoryInterface;

use Illuminate\Http\Request;

class OrdersController extends Controller
{
    private CRUDRepositoryInterface $itemRepository;

    private $model = 'App\Models\Ordering\Order';
    private $address_model = 'App\Models\Address';
    private $favourite_model = 'App\Models\Product\Favourite';
    private $path = 'orders';
    private $scope = 'Processing';

    public function __construct(
        CRUDRepositoryInterface $itemRepository
    ) {
        $this->itemRepository = $itemRepository;
    }

    public function reviews(Request $request)
    {
        $items = [];
        $counts = 0;
        $conditions = [];
        $result = [
            'items' => $items,
            'counts' => $counts,
        ];
        return view('auth.reviews.index', compact('result'));
    }

    //shipping
    public function shipping(Request $request)
    {
        $items = [];
        $counts = 0;
        $conditions = [];
        $result = [
            'items' => $items,
            'counts' => $counts,
        ];
        return view('auth.shipping.index', compact('result'));
    }

    public function index(Request $request)
    {
        $result = [];
        $conditions = [];
        //get orders
        $this->scope = null;

        $data = $request->all();
        // $data['conditions']['payment_status'] = 1;
        $data['conditions']['user_id'] = auth()->user()->id;


        // if(isset($data['type']) &&  $data['type'] == 'closed') {
        //     $this->scope = 'Closed';
        // }
        // $data['whereHas']= ['relation' => 'tickets','conditions' => null] ;

        $counts = $this->itemRepository->getCount($this->model, $data, $this->scope);
        $items = $this->itemRepository->getPaginateItems($this->model, $data, $this->scope);

        $result = [
            'items' => $items,
            'counts' => $counts,
        ];

        return view('auth.orders.index', compact('result'));
    }


    public function show($reference_number)
    {
        $result = [];

        $result['addresses'] = $this->itemRepository
            ->getAllItems($this->address_model);

        $result['item'] = $this->itemRepository
            ->getPaginateItems($this->model, ['conditions' => ['reference_number' => $reference_number]])
            ->first();

        if(empty($result['item'])) {
            abort(404);
        }

        return view('auth.orders.show', compact('result'));
    }

    //favourites
    public function favourites(Request $request)
    {
        $result = [];
        $data = $request->all();
        $data['conditions']['user_id'] = auth()->user()->id;

        $counts = $this->itemRepository->getCount($this->favourite_model, $data);
        $items = $this->itemRepository->getPaginateItems($this->favourite_model, $data);
        $result = [
            'items' => $items,
            'counts' => $counts,
        ];
        return view(
            'auth.favourites',
            compact('result')
        );
    }
}
