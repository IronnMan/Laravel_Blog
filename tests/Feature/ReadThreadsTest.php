<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ReadThreadsTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();  // TODO: Change the autogenerated stub

        $this->thread = factory('App\Thread')->create();
    }

    /**
     * @test
     */
    public function a_user_can_view_all_threads()
    {
        $this->get('/threads')
            ->assertSee($this->thread->title);
    }

    /**
     * @test
     */
    public function a_user_can_read_a_single_thread()
    {
        $this->get($this->thread->path())
            ->assertSee($this->thread->title);
    }

    /**
     * @test
     */
    public function a_user_can_read_replies_that_are_associated_with_a_thread()
    {
        // 如果存在 Thread
        // 并且该 Thread 拥有回复
        $reply = factory('App\Reply')
            ->create(['thread_id' => $this->thread->id]);

        // 那么当我们看该 Thread 时
        // 我们也要看到回复
        $this->get($this->thread->path())
            ->assertSee($reply->body);
    }


}
