<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Item::truncate();
        Item::create(['title' => '手錶A','price' => 500,'pic'=>'img/gallery/popular1.png']);
        Item::create(['title' => '手錶B', 'price' => 600, 'pic' => 'img/gallery/popular2.png']);
        Item::create(['title' => '手錶C', 'price' => 700, 'pic' => 'img/gallery/popular3.png']);
        Item::create(['title' => '手錶D', 'price' => 400, 'pic' => 'img/gallery/popular4.png']);
        Item::create(['title' => '手錶E', 'price' => 1500, 'pic' => 'img/gallery/popular5.png']);
        Item::create(['title' => '手錶F', 'price' => 800, 'pic' => 'img/gallery/popular6.png']);
        Item::create(['title' => '手錶G', 'price' => 900, 'pic' => 'img/gallery/choce_watch1.png']);
        Item::create(['title' => '手錶H', 'price' => 1000, 'pic' => 'img/gallery/choce_watch2.png']);
    }
}
