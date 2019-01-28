<?php

namespace Tests\Feature;

use App\Project;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectsTest extends TestCase
{

    use WithFaker, RefreshDatabase;

    public function testUserCanCreateAProject()
    {
        $this->withoutExceptionHandling();

        $attributes = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
        ];

        $this->post('/projects', $attributes)->assertRedirect('/projects');

        $this->assertDatabaseHas('projects', $attributes);

        $this->get('/projects')->assertSee($attributes['title']);
    }

    public function testAProjectRequiresATitle()
    {
        $attributes = factory(Project::class)->raw(['title' => '']);

        $this->post('/projects', $attributes)->assertSessionHasErrors('title');
    }

    public function testAProjectRequiresADescription()
    {
        $attributes = factory(Project::class)->raw(['description' => '']);

        $this->post('/projects', $attributes)->assertSessionHasErrors('description');
    }

    public function testAUserCanViewAProject()
    {
        $this->withoutExceptionHandling();

        $project = factory(Project::class)->create();

        $this->get('/projects/'.$project->id)
            ->assertSee($project->title)
            ->assertSee($project->description);
    }




}
