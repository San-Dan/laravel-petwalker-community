<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    // Checks /register url.
    public function test_view_register_form()
    {
        $response = $this->get('/register');
        $response->assertStatus(200);
    }

    // Check register form.
    public function test_register_user()
    {
        $user = new User();
        $user->name = 'Mr Test';
        $user->email = 'admin@test.se';
        $user->password = Hash::make('666');
        $user->save();

        $response = $this
            ->followingRedirects()
            ->post('register', [
                'email'    => 'admin@test.se',
                'password' => '666',
            ]);

        $response->assertStatus(200);
    }
}
