<?php

namespace Tests\Unit\GraphQL\mutation;

use App\Models\Degree;
use App\Models\Group;
use Illuminate\Foundation\Testing\WithFaker;
use Nuwave\Lighthouse\Testing\ClearsSchemaCache;
use Nuwave\Lighthouse\Testing\MakesGraphQLRequests;
use Tests\TestCase;

class GroupMutationTest extends TestCase
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
    public function testCreateGroup(): void
    {
        $group = [
            'id' => $this->createGroupID(),
            'semester' => strval($this->faker->numberBetween(1, 6)),
            'degreeID' => intval(Degree::inRandomOrder()->first()->id),
        ];
        $result = $this->graphQL(/** @lang GraphQL */ '
            mutation ($group: GroupInput!) {
                createGroup(group: $group) {
                    id
                }
            }
        ', ['group' => $group])->baseResponse->original['data'];
        $this->assertIsString($result['createGroup']['id']);
    }

    private function createGroupID(): string
    {
        $id = null;
        while(is_null($id))
        {
            $idTest = $this->faker->regexify('[A-Z]{1}') . $this->faker->randomNumber() . $this->faker->regexify('[A-Z]{2}');
            $idExists = Group::where('id', $idTest)->exists();
            $id = $idExists ? null : $idTest;
        }
        return $id;
    }
}
