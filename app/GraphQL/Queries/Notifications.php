<?php

namespace App\GraphQL\Queries;

use App\Models\Promotion\Notification;
use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Database\Eloquent\Builder;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class Notifications
{
    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo): Builder
    {
        return Notification::query()
            ->where('user_id', auth()->user()->id)
            ->ordered();
    }
}
