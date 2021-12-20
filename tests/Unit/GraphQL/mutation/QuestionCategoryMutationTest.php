<?php

namespace Tests\Unit\GraphQL\mutation;

use Illuminate\Foundation\Testing\WithFaker;
use Nuwave\Lighthouse\Testing\ClearsSchemaCache;
use Nuwave\Lighthouse\Testing\MakesGraphQLRequests;
use Tests\TestCase;

class QuestionCategoryMutationTest extends TestCase
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
    public function testQuestionCategory(): void
    {
        $questionCategory = [
            'name' => $this->faker->sentence(2, false),
            'description' => $this->faker->sentence(10, false)
        ];
        $result = $this->graphQL(/** @lang GraphQL */ '
            mutation ($questionCategory: QuestionCategoryInput!) {
                createQuestionCategory(category: $questionCategory) {
                    id
                }
            }
        ', ['questionCategory' => $questionCategory])->baseResponse->original['data'];
        $this->assertIsString($result['createQuestionCategory']['id']);
    }
}
