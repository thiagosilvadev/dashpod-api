<?php

namespace Tests\Feature;

use App\Modules\User\Actions\CreateUser;
use App\Modules\User\DTO\CreateUserDTO;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateUserTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * A basic feature test example.
     */
    public function test_should_create_user(): void
    {
        $payload = CreateUserDTO::from([
            'password' => $this->faker->password(),
            'email' => $this->faker->email,
            'name' => $this->faker->name(),
        ]);

        $user = (new CreateUser($payload))->execute();

        $this->assertNotEmpty($user->id);
        $this->assertDatabaseHas('users', [
            'email' => $user->email,
            'name' => $user->name,
        ]);
    }
}
