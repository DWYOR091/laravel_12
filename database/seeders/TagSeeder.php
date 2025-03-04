<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Tag::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $data = [
            [
                'name' => 'Adventure'
            ],
            [
                'name' => 'Traveling'
            ],
            [
                'name' => 'Lifestyle'
            ],
            [
                'name' => 'Food & Cooking'
            ],
            [
                'name' => 'Education'
            ]
        ];

        //memasukan beberapa data sekaligus tanpa loop
        Tag::insert($data);
    }
}
