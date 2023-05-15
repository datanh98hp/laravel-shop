<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        for($i=0; $i<=30;$i++){
            DB::table('products')->insert([
                'name'=>Str::random(10)."name",
                'category_id'=>1,
                'des'=>'ahidwnciwdes'.Str::createRandomStringsNormally(),
                'price'=>10,
                'slug'=>Str::slug(Str::createRandomStringsNormally()),
                'tag'=>Str::random(10),
                'quanlity'=>10,
            ]);
        }
        
    }
}
