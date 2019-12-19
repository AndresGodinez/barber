<?php

namespace Tests\Feature\Http\Controller\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TreatmentControllerTest extends TestCase
{
    /** @test */
    function user_can_see_the_form_to_create_new_treatment()
    {
        $user = $this->getDefaultUser();
        $response = $this->actingAs($user)->get('create-treatment');

    }
}
