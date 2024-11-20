<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourttypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name' => 'Supreme Court', 'slug' => 'supreme-court', 'code' => 'SC'],
            ['name' => 'Court of Appeal', 'slug' => 'court-of-appeal', 'code' => 'CC'],
            ['name' => 'High Court', 'slug' => 'high-court', 'code' => 'HC'],
            ['name' => 'Circuit Court', 'slug' => 'circuit-court', 'code' => 'CC'],
            ['name' => 'District Court', 'slug' => 'district-court', 'code' => 'DC'],
        ];

        DB::table('courttypes')->insert($data);
    }
}
