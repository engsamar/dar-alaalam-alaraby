<?php

namespace App\GraphQL\Queries\Product;

use App\Models\Product\Product;
use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Database\Eloquent\Builder;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class Index
{
    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo): Builder
    {
        $products = Product::query()->publish();

        if(isset($args['from_price'])) {
            $products->where('price', '>=', $args['from_price']);
        }
        if(isset($args['to_price'])) {
            $products->where('price','<=', $args['to_price']);
        }

        if(isset($args['category_id'])) {
            $products->where('category_id', $args['category_id']);
        }
        if(isset($args['sub_category_id'])) {
            $products->where('sub_category_id', $args['sub_category_id']);
        }

        if(isset($args['brand_id'])) {
            $products->where('brand_id', $args['brand_id']);
        }

        if(isset($args['store_id'])) {
            $products->where('store_id', $args['store_id']);
        }

        if(isset($args['in_new'])) {
            $products->where('in_new', $args['in_new']);
        }

        if(isset($args['in_top_selling'])) {
            $products->where('in_top_selling', $args['in_top_selling']);
        }

        if(isset($args['search'])) {
            $products->where('title', 'like','%'.$args['search'].'%');
        }
        if(isset($args['sortBy']) && isset($args['sortType']) && in_array($args['sortType'],['DESC','ASC'] )
            && in_array($args['sortBy'],['created_at','price','in_top_selling','in_new'] )) {
                $products->orderBy($args['sortBy'], $args['sortType']);
        }else{
            $products->ordered();
        }

        return $products;

    }
}
