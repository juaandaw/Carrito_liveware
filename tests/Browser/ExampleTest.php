<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ExampleTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Categorias')
                    ->screenshot('example-test');
        });
    }
    /** @test */
    public function pressCategoryButtonAndDisplay()
    {
        $this->browse(function (Browser $browser){
           $browser->visit('/')
               ->assertSee('Categorias')
           ->clickLink('Categorias')
           ->screenshot('categorias-test');
        });
    }

    /** @test */
    public function mouseClickOnCategoriesAndSubcategories()
    {
        $this->browse(function (Browser $browser){
            $browser->visit('/')
                ->assertSee('Categorias')
                ->clickLink('Categorias')
                ->mouseover('.hover:text-orange-500')
                ->assertSee('Celulares y smartphones')
                ->screenshot('categorias-test');
        });
    }
}
