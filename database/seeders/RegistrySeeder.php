<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegistrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $registries = array(
          array('id' => '1','name' => 'Accra High Court Registry','code' => 'AHCR','status' => 'Published','location_id' => '1','region_id' => '1','slug' => '2f7db496c845d','created_by' => NULL,'created_at' => '2023-08-17 10:12:25','updated_at' => '2023-08-22 08:57:22','deleted_at' => NULL),
          array('id' => '2','name' => 'Adenta High Court Registry','code' => 'ADHCR','status' => 'Published','location_id' => '2','region_id' => '2','slug' => 'a694946e87e7f','created_by' => NULL,'created_at' => '2023-08-22 08:54:06','updated_at' => '2023-08-22 08:57:30','deleted_at' => NULL),
          array('id' => '3','name' => 'Tema High Court Registry','code' => 'THCR','status' => 'Published','location_id' => '3','region_id' => '1171','slug' => 'f816466e7634b','created_by' => NULL,'created_at' => '2023-08-22 08:57:15','updated_at' => '2023-08-22 08:57:15','deleted_at' => NULL)
      );


        DB::table('registries')->insert($registries);

    }
}
