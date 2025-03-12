<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ImageModel;

class ImageModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ImageModel::create([
            'category' => 'Nature',
            'images' => json_encode(['image1.jpg', 'image2.jpg']),
            'image' => 'main_image.jpg',
            'extra' => 'Extra information',
            'extra2' => 'Additional information',
        ]);

        ImageModel::create([
            'category' => 'Technology',
            'images' => json_encode(['tech1.jpg', 'tech2.jpg']),
            'image' => 'tech_main_image.jpg',
            'extra' => 'Tech extra information',
            'extra2' => 'Tech additional information',
        ]);
    }
}
