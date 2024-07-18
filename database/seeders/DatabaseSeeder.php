<?php 

namespace Database\Seeders;

use App\Models\User;
use App\Models\Store;
use App\Models\StoreUser;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\Inventory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed Users
        $users = User::factory()->count(10)->create();

        // Seed Stores
        $stores = Store::factory()
            ->count(5)
            ->for($users->random(), 'owner')
            ->create();

        // Seed StoreUsers
        foreach ($stores as $store) {
            // Each store will have between 1 and 3 additional users (excluding the owner)
            StoreUser::factory()
                ->count(rand(1, 3))
                ->for($store)
                ->for($users->random(), 'user')
                ->create();
        }

        // Seed Products
        $products = Product::factory()
            ->count(20)
            ->for($stores->random())
            ->create();

        // Seed Sales and SaleItems
        foreach ($stores as $store) {
            // Each store will have between 5 and 10 sales
            $sales = Sale::factory()
                ->count(rand(5, 10))
                ->for($store)
                ->for($users->random(), 'user')
                ->create();

            foreach ($sales as $sale) {
                // Each sale will have between 1 and 5 sale items
                SaleItem::factory()
                    ->count(rand(1, 5))
                    ->for($sale)
                    ->for($products->random(), 'product')
                    ->create();
            }
        }

        // Seed Inventory
        foreach ($products as $product) {
            Inventory::factory()
                ->for($product)
                ->for($stores->random())
                ->create([
                    'initial_quantity' => $product->quantity,
                    'current_quantity' => $product->quantity,
                ]);
        }
    }
}
