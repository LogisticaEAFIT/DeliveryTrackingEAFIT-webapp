<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoutesTest extends TestCase
{
    public function testHome()
    {
        $this->get('/')->assertSee('Home');
    }

    public function testLogin()
    {
        $this->get('/login')->assertSee('Remember Me');
    }
}
