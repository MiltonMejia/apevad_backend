<?php

namespace Tests\Unit\GraphQL\mutation;

use App\Models\Degree;
use App\Models\Group;
use Illuminate\Foundation\Testing\WithFaker;
use Nuwave\Lighthouse\Testing\ClearsSchemaCache;
use Nuwave\Lighthouse\Testing\MakesGraphQLRequests;
use Tests\TestCase;

class DegreeMutationTest extends TestCase
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
    public function testCreateDegree(): void
    {
        $degree = $this->faker->sentence(2, false);
        $result = $this->graphQL(/** @lang GraphQL */ '
            mutation ($degree: String!) {
                createDegree(name: $degree) {
                    id
                }
            }
        ', ['degree' => $degree])->baseResponse->original['data'];
        $this->assertIsString($result['createDegree']['id']);
    }
}
