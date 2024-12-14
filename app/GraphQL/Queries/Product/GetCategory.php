<?php

namespace App\GraphQL\Queries\Product;

use App\Models\Product\Category;
use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Database\Eloquent\Builder;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class GetCategory
{
    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo): Builder
    {
        $items = Category::query()->publish();

        if(isset($args['search'])) {
            $items->where('title', 'like','%'.$args['search'].'%');
        }
        if(isset($args['category_id'])) {
            $items->SubCategory()->where('category_id', $args['category_id']);
        }else{
            $items = $items->Category();
        }
        return $items;

    }
}
