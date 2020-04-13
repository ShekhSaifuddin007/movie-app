<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    public function home_page_work_correctly()
    {
        $response = $this->get(route('movies.index'));

        $response->assertOk();
    }
}
