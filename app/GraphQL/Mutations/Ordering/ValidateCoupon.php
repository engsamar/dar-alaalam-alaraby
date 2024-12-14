<?php

namespace App\GraphQL\Mutations\Ordering;

use App\Helpers\OrderPricing;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class ValidateCoupon
{
    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        return $this->__constructor($args);
    }

    protected function __constructor($args)
    {
        $user = auth()->user();
        $calculateTotalPrice = OrderPricing::calculate($user, $args);

        return [
            'data' => $calculateTotalPrice,
            'error' => false,
            'status' => 'SUCCESS',
            'message' => __('messages.CouponValidated'),
        ];
    }
}
