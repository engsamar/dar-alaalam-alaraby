<?php

namespace App\GraphQL\Queries\Ordering;


use App\Helpers\Constants;
use App\Models\Ordering\Order;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use Illuminate\Database\Eloquent\Builder;

class ListOrders
{
    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo): Builder
    {

        $user = auth()->user();
        $orders = Order::query()->where('user_id', $user->id)
            ->orderBy('id', 'DESC')->whereIn('status_id', $args['status']);
        return $orders;
    }
}
