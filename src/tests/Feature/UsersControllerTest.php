<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

use App\User;

class UsersControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_未ログイン状態ならトップページに「マイページ」のリンクが表示されない()
    {
        $response = $this->get('/');

        $response->assertStatus(302);
        $response->assertDontSee('マイページ');
    }

    public function test_未ログイン状態ならトップページに「投稿をする」のリンクが表示されない()
    {
        $response = $this->get('/');

        $response->assertStatus(302);
        $response->assertDontSee('投稿をする');
    }

    public function test_ログイン状態ならマイページへ遷移できる()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
            ->get(route('users.show',$user->id));

        $response->assertStatus(200)->assertViewIs('users.show');
    }
}
