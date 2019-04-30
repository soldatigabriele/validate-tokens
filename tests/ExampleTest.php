<?php

use App\Word;
use Laravel\Lumen\Testing\DatabaseMigrations;

class ExampleTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testSuccess()
    {
        $w = factory(Word::class)->create();
        $this->get('validate?password=' . $w->value);
        $this->assertEquals('ok', json_decode($this->response->getContent(),true)['status']);
        $this->assertEquals(200, $this->response->getStatusCode());
        $this->assertTrue(Word::latest('id')->first()->value !== $w->value);
    }

    public function testFail()
    {
        $w = factory(Word::class)->create();
        $this->get('validate?password=wrong');
        $this->assertEquals('ko', json_decode($this->response->getContent(),true)['status']);
        $this->assertEquals($w->attempts + 1, $w->fresh()->attempts);
        $this->assertEquals(403, $this->response->getStatusCode());
    }
}
