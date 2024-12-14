<?php

namespace App\GraphQL\Queries\Product;

use App\Models\Product\Brand;
use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Database\Eloquent\Builder;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class GetBrand
{
    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo): Builder
    {
        $items = Brand::query()->publish();

        if(isset($args['search'])) {
            $items->where('title', 'like','%'.$args['search'].'%');
        }

        return $items;

    }
}
