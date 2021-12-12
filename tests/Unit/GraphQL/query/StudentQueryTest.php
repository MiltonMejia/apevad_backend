<?php

namespace Tests\Unit;

use Nuwave\Lighthouse\Testing\ClearsSchemaCache;
use Nuwave\Lighthouse\Testing\MakesGraphQLRequests;
use Tests\TestCase;

class StudentQueryTest extends TestCase
{
    use MakesGraphQLRequests;
    use ClearsSchemaCache;

    protected function setUp(): void
    {
        parent::setUp();
        $this->bootClearsSchemaCache();
    }

    /** @test */
    public function testStudentData()
    {
        $id = "F160012";
        $result = $this->graphQL(/** @lang GraphQL */ '
            query ($id: String!) {
                student(id: $id) {
                    id
                }
            }
        ', ['id' => $id])->baseResponse->original['data'];

        $this->assertIsString($result['student']['id']);
    }
}
