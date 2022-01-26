<?php

namespace Tests\Unit;

use App\Models\Brand;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BrandTest extends TestCase
{

    use RefreshDatabase;

    /**
     * Get paginated brands list.
     *
     * @return void
     */
    public function test_get_brands()
    {
        $seeder = [
            new Brand(['name' => 'BMW']),
            new Brand(['name' => 'Audi']),
            new Brand(['name' => 'Ferrari']),
        ];

        foreach ($seeder as $item) {
            $item->save();
        }

        $response = $this->get(route('brand.index'), getTestingAuthHeader());

        $response->assertStatus(200);
    }

    /**
     * Add new brand.
     *
     * @return void
     */
    public function test_store_brand_success()
    {
        $data = ['name' => 'BMW'];

        $response = $this->post(route('brand.store'), $data, getTestingAuthHeader());

        $response->assertStatus(200)
            ->assertJson([
                'name' => $data['name']
            ]);
    }

    /**
     * Update brand.
     *
     * @return void
     */
    public function test_store_brand_fail()
    {
        $data = ['name' => null];

        $response = $this->post(route('brand.store'), $data, getTestingAuthHeader());

        $response->assertStatus(422);
    }

    /**
     * Delete brand success.
     *
     * @return void
     */
    public function test_delete_brand_success()
    {
        $brand = Brand::create([
            'name' => 'Some name'
        ]);

        $response = $this->delete(route('brand.destroy', ['brand' => $brand->id]), [], getTestingAuthHeader());

        $response->assertStatus(200);
    }

    /**
     * Delete brand fail.
     *
     * @return void
     */
    public function test_delete_brand_fail()
    {
        $response = $this->delete(route('brand.destroy', ['brand' => 'not a num']), [], getTestingAuthHeader());

        $response->assertStatus(404);
    }
}
