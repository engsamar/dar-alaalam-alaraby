<?php

namespace App\GraphQL\Queries\Product;

use App\Models\Product\Product;
use App\Models\Product\Favourite;
use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Database\Eloquent\Builder;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class GetFavourite
{
    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo): Builder
    {
        $ids = Favourite::where("user_id", auth()->user()->id)
                ->whereStatus(1)->pluck('product_id')->toArray();

        return Product::query()->whereIn("id", $ids)->publish();

    }
}
