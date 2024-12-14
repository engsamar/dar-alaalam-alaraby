<?php

namespace App\GraphQL\Queries\Store;

use App\Models\Store\Store;
use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Database\Eloquent\Builder;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class Index
{
    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo): Builder
    {
        $stores = Store::query()->publish();
        
        if(isset($args['latitude']) &&  isset($args['longitude'])) {
            $stores = $stores->Distance($args['latitude'], $args['longitude'], 1000);
        }
        if(isset($args['category_id'])) {
            $stores->where('category_id', $args['category_id']);
        }

        if(isset($args['search'])) {
            $stores->where('title', 'like','%'.$args['search'].'%');
        }

        if(isset($args['type']) && $args['type'] == 1) {
            $stores->where('is_popular', 1);
        }
        return $stores;

    }
}
