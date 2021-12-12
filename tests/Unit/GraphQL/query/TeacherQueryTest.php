<?php

namespace Tests\Unit\GraphQL\query;

use Nuwave\Lighthouse\Testing\ClearsSchemaCache;
use Nuwave\Lighthouse\Testing\MakesGraphQLRequests;
use Tests\TestCase;

class TeacherQueryTest extends TestCase
{
    use MakesGraphQLRequests;
    use ClearsSchemaCache;

    protected function setUp(): void
    {
        parent::setUp();
        $this->bootClearsSchemaCache();
    }

    /** @test */
    public function testTeacherData()
    {
        $id = 1;
        $result = $this->graphQL(/** @lang GraphQL */ '
            query ($id: Int!) {
                teacher(id: $id) {
                    id
                }
            }
        ', ['id' => $id])->baseResponse->original['data'];

        $this->assertIsString($result['teacher']['id']);
    }
}
