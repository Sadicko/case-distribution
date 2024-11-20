<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourtSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $courts = array(
            array('id' => '1','name' => 'Adenta High Court 1','code' => 'as','registry_id' => '2','courttype_id' => '3','location_id' => '2','region_id' => '1171','category_id' => NULL,'slug' => '646d5234e43fc','status' => 'Published','created_by' => '1','created_at' => '2023-08-17 16:05:07','updated_at' => '2023-08-22 08:58:42','deleted_at' => NULL),
            array('id' => '2','name' => 'Tema High Court 1','code' => 'TM1','registry_id' => '3','courttype_id' => '3','location_id' => '3','region_id' => '1171','category_id' => NULL,'slug' => '65de456ac644b','status' => 'Published','created_by' => '1','created_at' => '2023-08-17 16:05:31','updated_at' => '2023-08-22 08:58:15','deleted_at' => NULL),
            array('id' => '3','name' => 'Land Court 1','code' => 'LD1','registry_id' => '1','courttype_id' => '3','location_id' => '1','region_id' => '1171','category_id' => NULL,'slug' => '4e347ddf8e746','status' => 'Published','created_by' => '1','created_at' => '2023-08-22 08:59:15','updated_at' => '2023-08-22 08:59:15','deleted_at' => NULL)
        );

        DB::table('courts')->insert($courts);
    }
}
