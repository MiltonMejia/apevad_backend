<?php

namespace App\GraphQL\Queries;

use App\Models\Administrative;
use App\Models\Student;
use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class Login
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolve)
    {
        $student = Auth::guard('student');
        if($student->attempt($args)) {
            return [
                'token' => $student->user()->createToken('Student')->plainTextToken,
                'user' => $student->user()
            ];
        }

        $administrative = Auth::guard('administrative');
        if($administrative->attempt(['email' => $args['id'], 'password' => $args['password']])) {
            return [
                'token' => $administrative->user()->createToken('Student')->plainTextToken,
                'user' => $administrative->user()
            ];
        }

        return [
            'error' => trans('auth.failed')
        ];
    }
}
