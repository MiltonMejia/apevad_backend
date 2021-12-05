<?php

namespace App\GraphQL\Queries;

use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Support\Facades\Auth;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class Login
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolve)
    {
        if(!Auth::attempt(['id' => $args['id'], 'password' => $args['password']]))
        {
            return [
                'error' => 'User or password is incorrect',
            ];
        }
        return [
            'token' => Auth::user()->createToken('Student')->plainTextToken,
            'user' => Auth::user(),
        ];
    }
}
