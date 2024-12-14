<?php

namespace App\GraphQL\Mutations\Ordering;

use App\Models\Setting;
use App\Models\Ordering\Order;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class CancelOrder
{
    public $error = 0;
    public $message = '';
    public $orderId = null;
    public $response;

    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        return $this->__constructor($args);
    }

    protected function __constructor($args)
    {
        $this->error = 0;
        $this->message = '';

        $user = auth()->user();

        $order = Order::where('user_id', $user->id)
            ->where('id', $args['order_id'])->update(['status' => 3]);

        return [
            'error' => $this->error,
            'status' => 'SUCCESS',
            'message' =>'your order cancelled successfully'
        ];
    }


}
