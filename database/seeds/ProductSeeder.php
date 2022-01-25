<?php

use App\Product;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    const PROCTED_NAME = "Off White Air Jordan 1 Retro High UNC";
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            "name" => self::PROCTED_NAME,
            "slug" => Str::slug(Str::lower(self::PROCTED_NAME)),
            "price" => '90291.75',
            "description" => `Time for some Tobacco Road vibes with these Jordan 1 Retro Off-Whites. Also known as the “UNC” editions, these Jordan 1s are the third colorway designed by Virgil Abloh and made in collaboration with his Off-White label. The sneakers come in a white, dark powder blue and cone colorway, with a white and blue deconstructed leather upper and Off-White detailing throughout. If you’re a fan of Virgil Abloh’s work and want to rep Off-White, this pair is another must-have.`,
            "image" => "off-white-x-air-jordan-1-retro-high-og-unc.jpg"
        ]);
    }
}
