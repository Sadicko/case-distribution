<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $locations = array(
          array('id' => '1','name' => 'Accra - The Law Court Complex','status' => 'Published','code' => NULL,'country_id' => NULL,'region_id' => '1171','slug' => 'ec54e36e729d6','courttype_id' => '3','created_by' => '1','created_at' => '2023-08-17 15:36:18','updated_at' => '2023-08-22 08:54:53','deleted_at' => NULL),
          array('id' => '2','name' => 'Adenta Courts','status' => 'Published','code' => NULL,'country_id' => NULL,'region_id' => '1171','slug' => '675ed382bf643','courttype_id' => '3','created_by' => '1','created_at' => '2023-08-17 15:39:17','updated_at' => '2023-08-17 15:39:17','deleted_at' => NULL),
          array('id' => '3','name' => 'Tema Courts','status' => 'Published','code' => NULL,'country_id' => NULL,'region_id' => '1171','slug' => '1ec282147643c','courttype_id' => '3','created_by' => '1','created_at' => '2023-08-22 08:56:12','updated_at' => '2023-08-22 08:56:12','deleted_at' => NULL)
      );


        DB::table('locations')->insert($locations);
    }
}
