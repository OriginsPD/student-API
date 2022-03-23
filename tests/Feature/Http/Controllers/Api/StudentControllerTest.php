<?php

namespace Tests\Feature\Http\Controllers\Api;

use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\StudentController
 */
class StudentControllerTest extends TestCase
{
    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('student.create'));

        $response->assertOk();
        $response->assertViewIs('student.create');
    }
}
