<?php

namespace Tests\Unit\GraphQL\mutation;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Nuwave\Lighthouse\Testing\ClearsSchemaCache;
use Nuwave\Lighthouse\Testing\MakesGraphQLRequests;
use Tests\TestCase;

class TeacherMutationTest extends TestCase
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
    public function testCreateTeacher()
    {
        $photo = UploadedFile::fake()->create('test.jpg', 500);
        $teacher = [
            'firstName' => $this->faker->firstName,
            'lastName' => $this->faker->lastName,
            'photo' => null,
        ];
        $operations = [
            'query' => /** @lang GraphQL */ '
                mutation ($firstName: String!, $lastName: String!, $photo: Upload) {
                    createTeacher(teacher: {
                        firstName: $firstName,
                        lastName: $lastName,
                        photo: $photo
                    }) {
                        id
                    }
                }
            ',
            'variables' => $teacher
        ];

        $map = [
            '0' => ['variables.photo'],
        ];

        $file = [
            '0' => $photo
        ];

        $result = $this->multipartGraphQL($operations, $map, $file)->baseResponse->original['data'];
        $this->assertIsString($result['createTeacher']['id']);
    }

    /** @test */
    public function testCreateTeacherNoPhoto()
    {
        $teacher = [
            'firstName' => $this->faker->firstName,
            'lastName' => $this->faker->lastName,
        ];
        $result = $this->graphQL(/** @lang GraphQL */ '
            mutation ($teacher: TeacherInput!) {
                createTeacher(teacher: $teacher) {
                    id
                }
            }
        ', ['teacher' => $teacher])->baseResponse->original['data'];
        $this->assertIsString($result['createTeacher']['id']);
    }
}

