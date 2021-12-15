<?php

namespace App\GraphQL\Mutations;

use App\Exceptions\UploadException;
use App\Models\Administrative;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class CreateAdministrative
{
    /**
     * @throws UploadException
     */
    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolve)
    {
        if(array_key_exists('photo', $args))
        {
            if($args['photo']->isValid())
            {
                $storePhoto = $args['photo']->store('photos/administratives');
                return Administrative::create([
                    'firstName' => $args['firstName'],
                    'lastName' => $args['lastName'],
                    'email' => $args['email'],
                    'administrative_category_id' => $args['administrative_category_id'],
                    'photo' => pathinfo($storePhoto)['basename']
                ]);
            } else {
                throw new UploadException();
            }
        }

        return Administrative::create([
            'firstName' => $args['firstName'],
            'lastName' => $args['lastName'],
            'email' => $args['email'],
            'administrative_category_id' => $args['administrative_category_id']
        ]);
    }
}
