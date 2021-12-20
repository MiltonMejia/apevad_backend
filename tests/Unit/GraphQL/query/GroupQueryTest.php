<?php

namespace Tests\Unit\GraphQL\query;

use Nuwave\Lighthouse\Testing\ClearsSchemaCache;
use Nuwave\Lighthouse\Testing\MakesGraphQLRequests;
use Tests\TestCase;

class GroupQueryTest extends TestCase
{
    use MakesGraphQLRequests;
    use ClearsSchemaCache;

    protected function setUp(): void
    {
        parent::setUp();
        $this->bootClearsSchemaCache();
    }

    /** @test */
    public function testTeacherData(): void
    {
        $id = "F6AM";
        $result = $this->graphQL(/** @lang GraphQL */ '
            query ($id: String!) {
                group(id: $id) {
                    id
                }
            }
        ', ['id' => $id])->baseResponse->original['data'];

        $this->assertIsString($result['group']['id']);
    }
}
