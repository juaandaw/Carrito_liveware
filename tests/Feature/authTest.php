<?php

namespace Tests\Feature;

use App\Http\Controllers\WelcomeController;
use App\Http\Livewire\CategoryProducts;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Models\Subcategory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class authTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    /** @test */
    function its_shows_the_welcome_view()
    {
        $brand = Brand::factory()->create();
        $category = Category::factory()->create();
        $category->brands()->attach([
            'brand_id' => $brand->id,
            'category_id' => $category->id
        ]);
        $subcategory = Subcategory::factory()->create([
            'category_id' => $category->id,
        ]);
        $productA = Product::factory()->create(['name' => 'leche','subcategory_id' => $subcategory->id,'brand_id' => $brand->id]);
        $image = Image::factory(2)->create([
            'imageable_id' => $productA->id,
            'imageable_type' => Product::class
        ]);
        $role = Role::create(['name' => 'admin']);
        $user = User::factory()->create()->assignRole('admin');

        Livewire::actingAs($user)->test('show-products2',['product',$productA])
        ->assertSeeLivewire('leche');

        $this->get('/admin/products2');

        $this->actingAs(User::factory()->create());
    }

    /** @test */

    public function can_show_a_product()
    {
        $brand = Brand::factory()->create();
        $category = Category::factory()->create();
        $category->brands()->attach([
            'brand_id' => $brand->id,
            'category_id' => $category->id
        ]);
        $subcategory = Subcategory::factory()->create([
            'category_id' => $category->id,
        ]);
        $productA = Product::factory()->create(['slug' => 'leche','subcategory_id' => $subcategory->id,'brand_id' => $brand->id]);
        $image = Image::factory(2)->create([
            'imageable_id' => $productA->id,
            'imageable_type' => Product::class
        ]);

        $this->get('products/'.$productA->slug)
            ->assertStatus(200)
            ->assertSee($productA->name)
            ->assertSee($productA->brand->name);
    }


}
