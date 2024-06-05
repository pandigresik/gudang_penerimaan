<?php

use App\Models\Base\ProductCategory;
use Illuminate\Database\Seeder;

class ProductCategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {                
        ProductCategory::insert([
            [
            'code' => 'RMM',
            'name' => 'Bahan Baku Mentah',
            'description' => 'Bahan baku berasal dari supplier'
        ],
        [
            'code' => 'RMG',
            'name' => 'Bahan Baku',
            'description' => 'Bahan baku untuk produksi'
        ],
    ]);       
        
    }
}