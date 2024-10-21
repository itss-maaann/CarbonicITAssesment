<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $products = Product::factory()->count(10)->create();

        User::factory()
            ->count(5)
            ->has(Order::factory()->count(2)->afterCreating(function (Order $order) use ($products) {
                $order->products()->attach(
                    $products->random(3)->pluck('id')->toArray()
                );
                $order->update(['total_amount' => $order->calculateTotalAmount()]);
            }))
            ->create();
    }
}
