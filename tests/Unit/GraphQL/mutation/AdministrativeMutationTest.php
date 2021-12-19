<?php

namespace Tests\Unit\GraphQL\mutation;

use App\Models\AdministrativeCategory;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Nuwave\Lighthouse\Testing\ClearsSchemaCache;
use Nuwave\Lighthouse\Testing\MakesGraphQLRequests;
use Tests\TestCase;

class AdministrativeMutationTest extends TestCase
{
    use MakesGraphQLRequests;
    use ClearsSchemaCache;
    use WithFaker;

    protected function setUp(): void
    {
        parent::setUp();
        $this->bootClearsSchemaCache();
    }

    /** @test */
    public function testCreateAdministrative()
    {
        $photo = UploadedFile::fake()->create('test.jpg', 500);
        $administrative = [
            'firstName' => $this->faker->firstName,
            'lastName' => $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail,
            'photo' => null,
            'password' => 'password',
            'categoryID' => AdministrativeCategory::inRandomOrder()->first()->id
        ];
        $operations = [
            'query' => /** @lang GraphQL */ '
                mutation ($firstName: String!, $lastName: String!, $email: String!, $photo: Upload, $password: String, $categoryID: Int!) {
                    createAdministrative(administrative: {
                        firstName: $firstName,
                        lastName: $lastName,
                        email: $email,
                        password: $password,
                        categoryID: $categoryID,
                        photo: $photo
                    }) {
                        id
                    }
                }
            ',
            'variables' => $administrative
        ];

        $map = [
            '0' => ['variables.photo'],
        ];

        $file = [
            '0' => $photo
        ];

        $result = $this->multipartGraphQL($operations, $map, $file)->baseResponse->original['data'];
        $this->assertIsString($result['createAdministrative']['id']);
    }

    /** @test */
    public function testCreateAdministrativeNoPhoto()
    {
        $administrative = [
            'firstName' => $this->faker->firstName,
            'lastName' => $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail,
            'password' => 'password',
            'categoryID' => AdministrativeCategory::inRandomOrder()->first()->id
        ];
        $result = $this->graphQL(/** @lang GraphQL */ '
            mutation ($administrative: AdministrativeInput!) {
                createAdministrative(administrative: $administrative) {
                    id
                }
            }
        ', ['administrative' => $administrative])->baseResponse->original['data'];
        $this->assertIsString($result['createAdministrative']['id']);
    }
}

