<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CmsPage;

class CmsPageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $CmsPageRecords = [
            ['id'=>1,'title'=>'About Us','description'=>'Content is coming soon.','url'=>'about_us','meta_title'=>'About Us','meta_description'=>'About Us content','meta_keywords'=>'about us , about','status'=>1],
            ['id'=>2,'title'=>'Terms & Conditions','description'=>'Content is coming soon.','url'=>'terms_and_conditon','meta_title'=>'Terms & Conditions','meta_description'=>'Terms & Conditions content','meta_keywords'=>'terms conditions , terms','status'=>1],
            ['id'=>3,'title'=>'Privacy Policy','description'=>'Content is coming soon.','url'=>'privacy_policy','meta_title'=>'Privacy Policy','meta_description'=>'Privacy Policy content','meta_keywords'=>'privacy , privacy policy','status'=>1],
        ];

        CmsPage::insert($CmsPageRecords);
    }
}
