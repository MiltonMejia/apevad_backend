<?php

namespace Tests\Unit;

use Nuwave\Lighthouse\Testing\ClearsSchemaCache;
use Nuwave\Lighthouse\Testing\MakesGraphQLRequests;
use Tests\TestCase;

class LoginQueryTest extends TestCase
{
    use MakesGraphQLRequests;
    use ClearsSchemaCache;

    protected function setUp(): void
    {
        parent::setUp();
        $this->bootClearsSchemaCache();
    }

    /** @test */
    public function testStudentLogin(): void
    {
        //You must change id value after seeding database
        $id = "F160012";
        $password = "password";
        $this->graphQL(/** @lang GraphQL */ '
            query ($id: String!, $password: String!) {
                login(id: $id, password: $password) {
                    token,
                    error,
                    user {
                    ... on Student {
                            id,
                            firstName,
                            lastName
                        }
                    }
            }
        }
        ', ['id' => $id, 'password' => $password])->assertJsonStructure([
            'data' => [
                'login' => [
                    'token',
                    'error',
                    'user' => [
                        'id',
                        'firstName',
                        'lastName'
                    ]
                ],
            ],
        ]);
    }

    /** @test */
    public function testAdministrativeLogin(): void
    {
        //You must change email value after seeding database
        $id = "arlo.cassin@example.com";
        $password = "password";
        $this->graphQL(/** @lang GraphQL */ '
            query ($id: String!, $password: String!) {
                login(id: $id, password: $password) {
                    token,
                    error,
                    user {
                    ... on Administrative {
                            id,
                            firstName,
                            lastName
                        }
                    }
            }
        }
        ', ['id' => $id, 'password' => $password])->assertJsonStructure([
            'data' => [
                'login' => [
                    'token',
                    'error',
                    'user' => [
                        'id',
                        'firstName',
                        'lastName'
                    ]
                ],
            ],
        ]);
    }

    /** @test */
    public function testStudentLogged()
    {
        //You must get token manually
        $token = "1|5rLoOUvTHAHSlzY6HvQBf6X5oLCHaa5OY7QWSfKC";
        $this->graphQL(/** @lang GraphQL */ '
            query {
                me {
                ... on Student {
                        id,
                        firstName,
                        lastName
                    }
                }
        }
        ', [], [], ['Authorization' => "Bearer $token"])->assertJsonStructure([
            'data' => [
                'me' => [
                    'id',
                    'firstName',
                    'lastName'
                ],
            ],
        ]);
    }

    /** @test */
    public function testAdministrativeLogged()
    {
        //You must get token manually
        $token = "34|Qcp5xkqSlaEi2hfUtG184mUzq8dqd4kFXo0K63KC";
        $this->graphQL(/** @lang GraphQL */ '
            query {
                me {
                ... on Administrative {
                        id,
                        firstName,
                        lastName
                    }
                }
        }
        ', [], [], ['Authorization' => "Bearer $token"])->assertJsonStructure([
            'data' => [
                'me' => [
                    'id',
                    'firstName',
                    'lastName'
                ],
            ],
        ]);
    }
}
