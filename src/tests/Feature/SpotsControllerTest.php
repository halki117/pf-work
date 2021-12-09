<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\User;
use App\Spot;

class SpotsControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;

    public function test_トップページに飛ぶことができる()
    {
        $response = $this->get(route('spots.index'));

        $response->assertStatus(200)->assertViewIs('spots.index');
    }

    public function test_未ログイン状態で投稿画面へ移るとverify機能に引っかかりログイン画面へ遷移する()
    {
        $response = $this->get(route('spots.create'));

        $response->assertRedirect('/email/verify');
    }

    public function test_ログイン状態なら投稿画面へ遷移できる()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
            ->get(route('spots.create'));

        $response->assertStatus(200)->assertViewIs('spots.create');
    }

    public function test_IsLikedByメソッドの引数にnullを入れるとfalseが返る()
    {
        $spot = factory(Spot::class)->create();

        $result = $spot->isLikedBy(null);

        $this->assertFalse($result);
    }

    public function test_IsLikedByメソッドに記事をいいねしているUserモデルのインスタンスを引数として渡した時trueが返る()
    {
        $spot = factory(Spot::class)->create();
        $user = factory(User::class)->create();
        $spot->likes()->attach($user);

        $result = $spot->isLikedBy($user);

        $this->assertTrue($result);
    }

    public function test_IsLikedByメソッドに記事をいいねしていないUserモデルのインスタンスを引数として渡した時falseが返る()
    {
        $spot = factory(Spot::class)->create();
        $user = factory(User::class)->create();
        $another = factory(User::class)->create();
        $spot->likes()->attach($another);

        $result = $spot->isLikedBy($user);

        $this->assertFalse($result);
    }

}
