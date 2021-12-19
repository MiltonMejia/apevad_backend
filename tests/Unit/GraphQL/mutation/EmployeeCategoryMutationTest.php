<?php

namespace Tests\Unit\GraphQL\mutation;

use Illuminate\Foundation\Testing\WithFaker;
use Nuwave\Lighthouse\Testing\ClearsSchemaCache;
use Nuwave\Lighthouse\Testing\MakesGraphQLRequests;
use Tests\TestCase;

class EmployeeCategoryMutationTest extends TestCase
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
    public function testCreateEmployeeCategory()
    {
        $employeeCategory = $this->faker->sentence(1, false);
        $result = $this->graphQL(/** @lang GraphQL */ '
            mutation ($employeeCategory: String!) {
                createEmployeeCategory(name: $employeeCategory) {
                    id
                }
            }
        ', ['employeeCategory' => $employeeCategory])->baseResponse->original['data'];
        $this->assertIsString($result['createEmployeeCategory']['id']);
    }
}
