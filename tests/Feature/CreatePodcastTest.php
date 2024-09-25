<?php

namespace Tests\Feature;

use App\Models\Enums\MembershipRole;
use App\Models\User;
use App\Modules\Podcast\Actions\CreatePodcast;
use App\Modules\Podcast\DTO\CreatePodcastDTO;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreatePodcastTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * A basic feature test example.
     */
    public function test_should_create_podcast(): void
    {
        $action = new CreatePodcast;
        $payload = CreatePodcastDTO::from([
            'name' => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'user' => User::factory()->create(),
        ]);

        $podcast = $action->execute($payload);

        $this->assertNotEmpty($podcast->id);
        $this->assertDatabaseHas('podcasts', [
            'id' => $podcast->id,
            'name' => $podcast->name,
        ]);
    }

    /**
     * A basic feature test example.
     */
    public function test_should_create_membership(): void
    {
        $action = new CreatePodcast;
        $user = User::factory()->create();
        $payload = CreatePodcastDTO::from([
            'name' => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'user' => $user,
        ]);

        $podcast = $action->execute($payload);

        $this->assertNotEmpty($podcast->id);
        $this->assertDatabaseHas('podcasts', [
            'id' => $podcast->id,
            'name' => $podcast->name,
        ]);

        $this->assertDatabaseHas('memberships', [
            'podcast_id' => $podcast->id,
            'user_id' => $user->id,
            'role' => MembershipRole::ADMIN,
        ]);
    }
}
