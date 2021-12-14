<?php

namespace Tests\Unit\GraphQL\mutation;

use Nuwave\Lighthouse\Testing\ClearsSchemaCache;
use Nuwave\Lighthouse\Testing\MakesGraphQLRequests;
use Tests\TestCase;

class StudentMutationTest extends TestCase
{
    use MakesGraphQLRequests;
    use ClearsSchemaCache;

    protected function setUp(): void
    {
        parent::setUp();
        $this->bootClearsSchemaCache();
    }

    /** @test */
    public function testCreateStudent()
    {
        $student = [
            'firstName' => 'John',
            'lastName' => 'Doe',
            'group' => 'F6AM'
        ];
        $result = $this->graphQL(/** @lang GraphQL */ '
            mutation ($student: StudentInput) {
                createStudent(student: $student) {
                    id
                }
            }
        ', ['student' => $student])->baseResponse->original['data'];

        $this->assertIsString($result['group']['id']);
    }
}
