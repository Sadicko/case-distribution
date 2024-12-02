<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //maintain id  because it is used in allocation process
        $categories = array(
            array('id' => '1','slug' => '6749b0ed38a2e','name' => 'COMMERCIAL','courttype_id' => '3','status' => 'Published','created_by' => '1','created_at' => '2024-11-29 12:17:49','updated_at' => '2024-11-29 12:20:18','deleted_at' => NULL),
            array('id' => '2','slug' => '6749b10be24d6','name' => 'CRIMINAL','courttype_id' => '3','status' => 'Published','created_by' => '1','created_at' => '2024-11-29 12:18:19','updated_at' => '2024-11-29 12:20:36','deleted_at' => NULL),
            array('id' => '3','slug' => '6749b11c8665e','name' => 'FAMILY','courttype_id' => '3','status' => 'Published','created_by' => '1','created_at' => '2024-11-29 12:18:36','updated_at' => '2024-11-29 12:20:31','deleted_at' => NULL),
            array('id' => '4','slug' => '6749b12bc2594','name' => 'FINANCIAL & ECONOMIC','courttype_id' => '3','status' => 'Published','created_by' => '1','created_at' => '2024-11-29 12:18:51','updated_at' => '2024-11-29 12:20:25','deleted_at' => NULL),
            array('id' => '5','slug' => '6749b13cad6d7','name' => 'HUMAN RIGHTS','courttype_id' => '3','status' => 'Published','created_by' => '1','created_at' => '2024-11-29 12:19:08','updated_at' => '2024-11-29 12:20:22','deleted_at' => NULL),
            array('id' => '6','slug' => '6749b14b8308b','name' => 'INDUSTRIAL & LABOUR','courttype_id' => '3','status' => 'Published','created_by' => '1','created_at' => '2024-11-29 12:19:23','updated_at' => '2024-11-29 12:19:52','deleted_at' => NULL),
            array('id' => '7','slug' => '6749b2264c29f','name' => 'LAND','courttype_id' => '3','status' => 'Published','created_by' => '1','created_at' => '2024-11-29 12:23:02','updated_at' => '2024-11-29 12:23:02','deleted_at' => NULL),
            array('id' => '8','slug' => '6749b2382b7cf','name' => 'PROBATE & LETTERS OF ADMINISTRATION','courttype_id' => '3','status' => 'Published','created_by' => '1','created_at' => '2024-11-29 12:23:20','updated_at' => '2024-11-29 12:23:20','deleted_at' => NULL)
        );

        DB::table('categories')->insert($categories);
    }
}
