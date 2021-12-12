<?php

namespace Tests\Unit\GraphQL\query;

use Nuwave\Lighthouse\Testing\ClearsSchemaCache;
use Nuwave\Lighthouse\Testing\MakesGraphQLRequests;
use Tests\TestCase;

class AdministrativeQueryTest extends TestCase
{
    use MakesGraphQLRequests;
    use ClearsSchemaCache;

    protected function setUp(): void
    {
        parent::setUp();
        $this->bootClearsSchemaCache();
    }

    /** @test */
    public function testAdministrativeData()
    {
        $id = 1;
        $result = $this->graphQL(/** @lang GraphQL */ '
            query ($id: Int!) {
                administrative(id: $id) {
                    id
                }
            }
        ', ['id' => $id])->baseResponse->original['data'];

        $this->assertIsString($result['administrative']['id']);
    }
}
