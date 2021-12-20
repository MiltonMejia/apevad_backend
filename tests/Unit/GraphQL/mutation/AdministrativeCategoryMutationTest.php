<?php

namespace Tests\Unit\GraphQL\mutation;

use Illuminate\Foundation\Testing\WithFaker;
use Nuwave\Lighthouse\Testing\ClearsSchemaCache;
use Nuwave\Lighthouse\Testing\MakesGraphQLRequests;
use Tests\TestCase;

class AdministrativeCategoryMutationTest extends TestCase
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
    public function testCreateAdministrativeCategory(): void
    {
        $category = $this->faker->sentence(2, false);
        $result = $this->graphQL(/** @lang GraphQL */ '
            mutation ($category: String!) {
                createAdministrativeCategory(name: $category) {
                    id
                }
            }
        ', ['category' => $category])->baseResponse->original['data'];
        $this->assertIsString($result['createAdministrativeCategory']['id']);
    }
}
