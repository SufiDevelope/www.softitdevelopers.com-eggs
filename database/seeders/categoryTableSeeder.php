<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\category;

class categoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $categories = [
            ['id'=>1,'parent_id'=>0,'category_name'=>'clothing','category_image'=>'','category_discount'=>0,'description'=>'','url'=>'clothing','meta_title'=>'','meta_description'=>'','meta_keywords'=>'','status'=>1],
            ['id'=>2,'parent_id'=>0,'category_name'=>'Electronics','category_image'=>'','category_discount'=>0,'description'=>'','url'=>'Electronics','meta_title'=>'','meta_description'=>'','meta_keywords'=>'','status'=>1],
            ['id'=>3,'parent_id'=>0,'category_name'=>'Appliances','category_image'=>'','category_discount'=>0,'description'=>'','url'=>'Appliances','meta_title'=>'','meta_description'=>'','meta_keywords'=>'','status'=>1],
            ['id'=>4,'parent_id'=>1,'category_name'=>'Men','category_image'=>'','category_discount'=>0,'description'=>'','url'=>'Men','meta_title'=>'','meta_description'=>'','meta_keywords'=>'','status'=>1],
            ['id'=>5,'parent_id'=>1,'category_name'=>'Women','category_image'=>'','category_discount'=>0,'description'=>'','url'=>'Women','meta_title'=>'','meta_description'=>'','meta_keywords'=>'','status'=>1],
            ['id'=>6,'parent_id'=>1,'category_name'=>'Kids','category_image'=>'','category_discount'=>0,'description'=>'','url'=>'Kids','meta_title'=>'','meta_description'=>'','meta_keywords'=>'','status'=>1],
        ];
        category::insert($categories);
    }
}
