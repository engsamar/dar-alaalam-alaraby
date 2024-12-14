<?php

namespace App\Http\Controllers\Auth;


use App\Helpers\Image;
use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRequest;
use App\Interfaces\ContentRepositoryInterface;
use App\Models\Ordering\OrderProduct;
use App\Models\User;

class ProfileController extends Controller
{
    private $__path = 'users';
    private $__order_model = 'App\Models\Ordering\Order';
    private ContentRepositoryInterface $__contentRepository;

    public function __construct(
        ContentRepositoryInterface $__contentRepository
    ) {
        $this->__contentRepository = $__contentRepository;
    }
    public function index()
    {
        $result = [];

        return view('auth.profile.customer', compact('result'));
    }

    public function home()
    {
        $result = [];
        //get no of orders
        $data = [];

        $data['user_id'] = auth()->user()->id;
        $result['countProducts'] = OrderProduct::whereHas('order', function ($q) {
            $q->where('user_id', auth()->user()->id)->paid();
        })->count();

        $result['countClosedOrders'] = $this->__contentRepository
            ->getCount($this->__order_model, ['Delivered'], $data);


        $result['countOrders'] = $this->__contentRepository
            ->getCount($this->__order_model,[ 'processing'], $data);


        return view('auth.profile.home', compact('result'));

    }

    public function editPassword()
    {
        $result = [];
        return view('auth.profile.update-password', compact('result'));
    }

    public function update(CustomerRequest $request)
    {
        $data = $request->all();
        $user = User::where('id', auth()->user()->id)->first();
        $data['name'] = $data['first_name'].' '.$data['last_name'];

        if ($request->hasFile('image')) {
            $path = $this->__path.'/customers/image';
            $data['image'] = Image::upload($request->file('image'), $path);
        }

        $user->update($data);

        toastr()->success(__('website.UpdateProfileSuccessfully'));
        return redirect()->route('website.auth.profile.index');
    }
}
