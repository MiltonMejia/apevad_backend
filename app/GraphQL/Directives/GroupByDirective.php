<?php

namespace App\GraphQL\Directives;

use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Nuwave\Lighthouse\Schema\Directives\BaseDirective;
use Nuwave\Lighthouse\Schema\Values\FieldValue;
use Nuwave\Lighthouse\Support\Contracts\ArgDirectiveForArray;
use Nuwave\Lighthouse\Support\Contracts\ArgResolver;
use Nuwave\Lighthouse\Support\Contracts\FieldMiddleware;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class GroupByDirective  extends BaseDirective implements FieldMiddleware {
    // TODO implement the directive https://lighthouse-php.com/master/custom-directives/getting-started.html

    public static function definition(): string {
        return /** @lang GraphQL */ <<<'GRAPHQL'
        """
        A description of what this directive does.
        """
        directive @groupBy(
            """
            Directives can have arguments to parameterize them.
            """
            groupBy: String
        ) on ARGUMENT_DEFINITION | INPUT_FIELD_DEFINITION
        GRAPHQL;
    }

    public function handleBuilder($builder, $value): object
    {
        $builder->groupBy($value);

        return $builder;
    }

    public function handleField(FieldValue $fieldValue, Closure $next): FieldValue
    {
        $previousResolver = $fieldValue->getResolver();
        $wrappedResolver = function ($root, array $args, GraphQLContext $context, ResolveInfo $info) use ($previousResolver): Collection {
            $result = $previousResolver($root, $args, $context, $info);
            $groupByName = $this->directiveArgValue('groupBy');
            return $result->groupBy($groupByName);
        };
        $fieldValue->setResolver($wrappedResolver);
        return $next($fieldValue);
    }
}
