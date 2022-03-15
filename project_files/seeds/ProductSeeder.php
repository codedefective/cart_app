<?php

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // https://picsum.photos/200/300
        $faker = Factory::create();

        for ($x = 1; $x <= 10; $x++){
            DB::table('products')->insert([
                'name' =>   $faker->text(30),
                'price' => $faker->randomFloat(3,2,999),
                'cover' => 'https://picsum.photos/id/'. rand(1,500) .'/474/300',
                'created_at' => now('Europe/Istanbul')
            ]);
        }
    }
}
