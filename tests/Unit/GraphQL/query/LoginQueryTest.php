<?php

namespace Tests\Unit;

use App\Models\Administrative;
use App\Models\Student;
use Illuminate\Foundation\Testing\WithFaker;
use Nuwave\Lighthouse\Testing\ClearsSchemaCache;
use Nuwave\Lighthouse\Testing\MakesGraphQLRequests;
use Tests\TestCase;

class LoginQueryTest extends TestCase
{
    use MakesGraphQLRequests;
    use ClearsSchemaCache;
    use WithFaker;

    private string $loginPassword = 'password';

    protected function setUp(): void
    {
        parent::setUp();
        $this->bootClearsSchemaCache();
    }

    /** @test */
    public function testStudentLogin(): void
    {
        $result = $this->getStudentLogin();
        $this->assertIsString($result);
    }

    /** @test */
    public function testAdministrativeLogin(): void
    {
        $result = $this->getAdministrativeLogin();
        $this->assertIsString($result);
    }

    /** @test */
    public function testStudentLogged(): void
    {
        $token = $this->getStudentLogin();
        $result = $this->graphQL(/** @lang GraphQL */ '
            query {
                me {
                ... on Student {
                        id,
                        firstName,
                        lastName
                    }
                }
        }
        ', [], [], ['Authorization' => "Bearer $token"])->baseResponse->original['data'];

        $this->assertIsString($result['me']['id']);
    }

    /** @test */
    public function testAdministrativeLogged(): void
    {
        $token = $this->getAdministrativeLogin();
        $result = $this->graphQL(/** @lang GraphQL */ '
            query {
                me {
                ... on Administrative {
                        id,
                        firstName,
                        lastName
                    }
                }
        }
        ', [], [], ['Authorization' => "Bearer $token"])->baseResponse->original['data'];

        $this->assertIsString($result['me']['id']);
    }

    private function getStudentLogin(): string
    {
        $id = Student::inRandomOrder()->first()->id;
        return $this->graphQL(/** @lang GraphQL */ '
            query ($id: String!, $password: String!) {
                login(id: $id, password: $password) {
                    token
            }
        }
        ', ['id' => $id, 'password' => $this->loginPassword])->baseResponse->original['data']['login']['token'];
    }

    private function getAdministrativeLogin(): string
    {
        $id = Administrative::inRandomOrder()->first()->email;
        print_r($id);
        return $this->graphQL(/** @lang GraphQL */ '
            query ($id: String!, $password: String!) {
                login(id: $id, password: $password) {
                    token
            }
        }
        ', ['id' => $id, 'password' => $this->loginPassword])->baseResponse->original['data']['login']['token'];
    }
}
