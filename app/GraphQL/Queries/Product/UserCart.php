<?php

namespace App\GraphQL\Queries\Product;

use App\Models\Product\Cart;
use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Database\Eloquent\Builder;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class UserCart
{
    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo): Builder
    {
        $cart = Cart::query()->where("user_id", auth()->user()->id)
            ->whereHas('product', function($q){
                $q->publish();
            });
        return $cart;

    }
}
