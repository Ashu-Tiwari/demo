<?php

use App\User;
use App\Product;
use App\Category;
use App\Transaction;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        User::truncate();
        Category::truncate();
        Product::truncate();
        Transaction::truncate();
        DB::table('category_product')->truncate();

        $productQty = 200;
        $categoryQty = 20;
        $userQty = 10;
        $transactionQty = 100;

        factory(User::class, $userQty)->create();
        factory(Category::class, $categoryQty)->create();
        factory(Product::class, $productQty)->create()->each(function($product){
        	$categories = Category::all()->random(mt_rand(1,5))->pluck('id');
        	$product->categories()->attach($categories);
        });
        factory(Transaction::class, $transactionQty)->create();


        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
