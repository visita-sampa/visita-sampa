<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RouteTest extends TestCase
{
	/** @test */
	public function check_if_home_route_is_correct()
	{
		$response = $this->get('/pt/home/');

		$response->assertStatus(200);
	}
}
