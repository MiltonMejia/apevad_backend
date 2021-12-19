<?php

namespace App\GraphQL\Mutations;

use App\Exceptions\UploadException;
use App\Models\Administrative;
use App\Models\Teacher;

class CreateTeacher
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        if(array_key_exists('photo', $args))
        {
            if(!$args['photo']->isValid()) throw new UploadException();
            $storePhoto = $args['photo']->store('photos/administrators');
            return Teacher::create([
                'firstName' => $args['firstName'],
                'lastName' => $args['lastName'],
                'photo' => pathinfo($storePhoto)['basename']
            ]);
        }

        return Teacher::create($args);
    }
}
