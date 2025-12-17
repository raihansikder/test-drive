<?php

use App\Mainframe\Features\Responder\Response;
use App\Module;
use App\Setting;



beforeEach(function () {
    $this->module = Module::byName('settings');
    login(user(config('test.super_admin_user_id')));
});



test('user can not store invalid element', function () {
    $name = $this->faker->slug;
    $response = $this->post("/{$this->module->route_path}?ret=json",
        [
            'name' => $name,
        ]);

    $response->assertStatus(200)
        ->assertJson([
            'code' => 422,
            'status' => 'fail',
            'errors' => [
                'Failed to create new setting',
                'The title field is required.',
                'The type field is required.',
            ],
        ]);
});

test('user can store valid element', function () {
    $name = $this->faker->slug;
    $this->post("/{$this->module->route_path}?ret=json",
        [
            'name' => $name,
            'title' => strtoupper($name),
            'type' => 'string',
            'value' => $this->faker->sentence,
            'description' => $this->faker->sentence,
        ])
        ->assertStatus(200)
        ->assertJson([
            'code' => 200,
            'status' => 'success',
            'data' => [
                'name' => $name,
            ],
        ]);
});

test('user can not store element of same name', function () {
    $latest = $this->latest(Setting::class);

    $this->post("/{$this->module->route_path}?ret=json",
        [
            'name' => $latest->name,
            'title' => strtoupper($latest->name),
            'type' => 'string',
            'value' => $this->faker->sentence,
            'description' => $this->faker->sentence,
        ])
        ->assertStatus(200)
        ->assertJson([
            'code' => Response::HTTP_UNPROCESSABLE_ENTITY,
            'status' => 'fail',
            'data' => [
                'name' => $latest->name,
            ],
            'validation_errors' => [
                'name' => [
                    'The name has already been taken.',
                ],
            ],
        ]);
});

test('user can view list', function () {
    $latest = $this->latest(Setting::class);

    $this->get("/{$this->module->route_path}/list/json")
        ->assertStatus(200)
        ->assertSee($latest->name);
});

test('user can view element', function () {
    $latest = $this->latest(Setting::class);

    $this->get("/{$this->module->route_path}/{$latest->id}?ret=json")
        ->assertStatus(200)
        ->assertSee($latest->name);
});

test('user can update element', function () {
    $latest = $this->latest(Setting::class);
    $newValue = $this->faker->sentence;

    $this->followingRedirects()
        ->patch("/{$this->module->route_path}/{$latest->id}?ret=json",
            [
                'value' => $newValue,
            ])
        ->assertStatus(200)
        ->assertJson([
            'code' => 200,
            'status' => 'success',
            'data' => [
                'name' => $latest->name,
                'value' => $newValue,
            ],
        ]);
});

test('user can delete element', function () {
    // Note: The element got deleted earlier so had to add a delay for deletion so that
    //  other tests can run and then the delete is executed.
    // $this->markTestSkipped('Skipped because it executes and makes the element inaccessible');
    // sleep(1);
    // ------------------------------------------------------------------------------------------
    $latest = $this->latest(Setting::class);

    // delete with redirect=success to index route.
    $this->followingRedirects()
        ->delete("/{$this->module->route_path}/{$latest->id}?ret=json&redirect_success=".route($this->module->name.'.index'))
        ->assertJson([
            'code' => 200,
            'status' => 'success',
            'message' => "The {$this->module->title} has been deleted",
            'data' => [
                'name' => $latest->name,
            ],
        ]);

    // Check if it has been soft deleted.
    $this->assertDatabaseMissing($this->module->module_table, ['id' => $latest->id, 'deleted_at' => null]);
});
