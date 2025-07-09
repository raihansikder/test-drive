<?php

namespace Tests\Feature\Mainframe\Api;

use App\Upload;
use Tests\ApiTestCase;
use Illuminate\Http\UploadedFile;

class GetSettingByKeyApiTest extends ApiTestCase
{

    /**
     * @return void
     */
    public function test_get_setting_by_key()
    {

        $key = 'app-name';
        $this->get("api/1.0/setting/{$key}")
            ->assertStatus(200)
            ->assertJson([
                'code' => 200,
                'status' => 'success',

            ])->assertJsonStructure([
                'code', 'status', 'message', 'data',
            ]);
    }

    /**
     * @return void
     */
    public function test_get_data_block_by_key()
    {

        $key = 'sample-data-block';
        $response = $this->get("api/1.0/data/{$key}");

        // $response->dump();

        $response->assertStatus(200)
            ->assertJson([
                'code' => 200,
                'status' => 'success',

            ])->assertJsonStructure([
                'code', 'status', 'message', 'data',
            ]);
    }

    public function test_upload()
    {
        // $file = UploadedFile::fake()->createWithContent('customer.csv', 'id;name;group\n9999;Customer1;');

        $this->post('api/1.0/uploads',
            [
                'file' => UploadedFile::fake()->image('avatar.jpg'),
                'module_id' => 7, // settings module
                'element_id' => 1,
                'type' => Upload::TYPE_SETTING_PUBLIC,
            ])->assertStatus(200)
            ->assertJson([
                'code' => 200,
                'status' => 'success',

            ])->assertJsonStructure([
                'code', 'status', 'message', 'data',
            ]);
    }

}
