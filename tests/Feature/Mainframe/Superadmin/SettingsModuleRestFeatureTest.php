<?php

use App\Module;
use App\Setting;

beforeEach(function () {
    $this->module = Module::byName('settings');
    login(user(config('test.super_admin_user_id')));
});

test('user can see create form', function () {
    $this->get('/'.$this->module->route_path.'/create')
        ->assertStatus(200)
        ->assertSee($this->module->title);
});

test('user can not store invalid element', function () {
    $name = $this->faker->slug;
    $this->followingRedirects()
        ->post('/'.$this->module->route_path, [
            'name' => $name,
        ])
        ->assertStatus(200)
        ->assertSee('Fail')
        ->assertSee('The title field is required.')
        ->assertSee('The type field is required');
});

test('user can store valid element', function () {
    $name = $this->faker->slug;
    $this->followingRedirects()
        ->post('/'.$this->module->route_path, [
            'name' => $name,
            'title' => strtoupper($name),
            'type' => 'string',
            'value' => $this->faker->sentence,
            'description' => $this->faker->sentence,
        ])
        ->assertStatus(200)
        ->assertSee('Success');
});

test('user can not store element of same name', function () {
    $latest = $this->latest(Setting::class);

    $this->followingRedirects()
        ->post('/'.$this->module->route_path, [
            'name' => $latest->name,
            'title' => strtoupper($latest->name),
            'type' => 'string',
            'value' => $this->faker->sentence,
            'description' => $this->faker->sentence,
        ])
        ->assertStatus(200)
        ->assertSee('Fail')
        ->assertSee('The name has already been taken.');
});

test('user can view list', function () {
    $latest = $this->latest(Setting::class);

    $this->get('/'.$this->module->route_path)
        ->assertStatus(200)
        ->assertSee($this->module->title);

    $this->get('/'.$this->module->route_path.'/datatable/json')
        ->assertStatus(200)
        ->assertSee($latest->name);
});

test('user can view element', function () {
    $latest = $this->latest(Setting::class);

    $this->followingRedirects()
        ->get("/{$this->module->route_path}/{$latest->id}")
        ->assertStatus(200)
        ->assertSee($latest->name);
});

test('user can edit element', function () {
    $latest = $this->latest(Setting::class);

    $this->get("/{$this->module->route_path}/{$latest->id}/edit")
        ->assertStatus(200)
        ->assertSee($latest->name);
});

test('user can update element', function () {
    $latest = $this->latest(Setting::class);
    $newValue = $this->faker->sentence;

    $this->followingRedirects()
        ->patch("/{$this->module->route_path}/{$latest->id}", [
            'value' => $newValue,
        ])
        ->assertStatus(200)
        ->assertSee('Success')
        ->assertSee($newValue);
});

test('user can delete element', function () {
    // Note: The element got deleted earlier so had to add a delay for deletion so that
    //  other tests can run and then the delete is executed.
    // $this->markTestSkipped('Skipped because it executes and makes the element inaccessible');
    // sleep(1);
    // ------------------------------------------------------------------------------------------
    $setting = $this->latest(Setting::class);

    $upload = $setting->uploads()->create([
        'uploadable_id' => $setting->id,
        'uploadable_type' => Setting::class,
        'name' => 'test.jpg',
        'path' => 'test.jpg',
    ]);

    // delete with redirect=success to index route.
    $this->followingRedirects()
        ->delete("/{$this->module->route_path}/{$setting->id}?redirect_success=".route($this->module->name.'.index'))
        ->assertStatus(200)
        ->assertSee($this->module->title);

    // Check if it has been soft deleted.
    $this->assertDatabaseMissing('uploads', ['id' => $upload->id, 'deleted_at' => null]);
});

/*
|--------------------------------------------------------------------------
| Helpers
|--------------------------------------------------------------------------
|
| These are not actual tests rather helpers to fun the tests.
|
*/
