<?php

namespace App\GraphQL\Directives;

use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Schema\Directives\BaseDirective;
use Nuwave\Lighthouse\Schema\Values\FieldValue;
use Nuwave\Lighthouse\Support\Contracts\FieldMiddleware;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class VersionDirective extends BaseDirective implements FieldMiddleware
{
    public $result;

    public static function definition(): string
    {
        return /* @lang GraphQL */ <<<'GRAPHQL'
directive @version on FIELD_DEFINITION
GRAPHQL;
    }

    public function handleField(FieldValue $fieldValue, Closure $next): FieldValue
    {
        $originalResolver = $fieldValue->getResolver();

        return $next(
            $fieldValue->setResolver(function (
                $root,
                array $args,
                GraphQLContext $context,
                ResolveInfo $resolveInfo
            ) use ($originalResolver) {
                $user = $context->user();
                $supported_version = config('app.version');
                $version = \Request::header('version');

                if (!isset($version) || (isset($version) && version_compare($supported_version, $version, '>'))) {
                    $this->result = ['error' => 1, 'message' => __('messages.VersionNotSupported'), 'update' => true];

                    return [
                        'valid' => 0,
                        'data' => [],
                        'result' => $this->result,
                    ];
                }

                return $originalResolver($root, $args, $context, $resolveInfo);
            })
        );
    }
}
