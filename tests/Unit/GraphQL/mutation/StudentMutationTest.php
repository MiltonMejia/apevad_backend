<?php

namespace Tests\Unit\GraphQL\mutation;

use App\Models\Group;
use App\Models\Student;
use Illuminate\Foundation\Testing\WithFaker;
use Nuwave\Lighthouse\Testing\ClearsSchemaCache;
use Nuwave\Lighthouse\Testing\MakesGraphQLRequests;
use Tests\TestCase;

class StudentMutationTest extends TestCase
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
    public function testCreateStudent(): void
    {
        $studentID = ltrim(Student::orderBy('id', 'desc')->first()->id, 'F');
        $groupID = Group::inRandomOrder()->first()->id;
        $student = [
            'id' => 'F'.(int)$studentID + 1,
            'firstName' => $this->faker->firstName,
            'lastName' => $this->faker->lastName,
            'password' => 'password',
            'groupID' => $groupID
        ];
        $result = $this->graphQL(/** @lang GraphQL */ '
            mutation ($student: StudentInput!) {
                createStudent(student: $student) {
                    id
                }
            }
        ', ['student' => $student])->baseResponse->original['data'];

        $this->assertIsString($result['createStudent']['id']);
    }
}
