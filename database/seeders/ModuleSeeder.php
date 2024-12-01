<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $allModules = [
//            [
//                'slug' => uniqid(),
//                'name' => 'Dashboard',
//                'permissions' => [
//                    'Read dashboard',
//                    'Read dashboard chart',
//                ]
//            ],
//            [
//                'slug' => uniqid(),
//                'name' => 'Categories',
//                'permissions' => [
//                    'Manage categories',
//                    'Create categories',
//                    'Read categories',
//                    'Update categories',
//                    'Delete categories',
//                    'Print categories',
//                ]
//            ],
            [
                'slug' => uniqid(),
                'name' => 'Cases',
                'permissions' => [
//                    'Manage cases',
//                    'Create cases',
//                    'Upload cases',
                    'Manual case allocation',
//                    'Read cases',
//                    'Update cases',
                    'Change case options',
//                    'Set case as urgent',
//                    'Set case location',
//                    'Re-assign cases',
//                    'Track cases',
//                    'Print cases',
//                    'Download cases',
//                    'Delete cases',
                    'Read case logs',
                    'Read case metadata',
                ]
            ],
//            [
//                'slug' => uniqid(),
//                'name' => 'Reports',
//                'permissions' => [
//                    'Read reports',
//                    'Filter reports',
//                    'Export reports',
//                    'Print reports',
//                ]
//            ],
//
//            [
//                'slug' => uniqid(),
//                'name' => 'Registries',
//                'permissions' => [
//                    'Manage registries',
//                    'Create registries',
//                    'Read registries',
//                    'Update registries',
//                    'Delete registries',
//                    'Print registries',
//                ]
//            ],
//            [
//                'slug' => uniqid(),
//                'name' => 'Locations',
//                'permissions' => [
//                    'Manage locations',
//                    'Create locations',
//                    'Read locations',
//                    'Update locations',
//                    'Delete locations',
//                    'Print locations',
//                ]
//            ],
            [
                'slug' => uniqid(),
                'name' => 'Courts',
                'permissions' => [
//                    'Manage courts',
//                    'Create courts',
//                    'Read courts',
//                    'Update courts',
//                    'Delete courts',
//                    'Print courts',
//                    'Assign court judges',
//                    'Assign categories courts',
                    'Read court logs',
                ]
            ],
//            [
//                'slug' => uniqid(),
//                'name' => 'Judges',
//                'permissions' => [
//                    'Manage judges',
//                    'Create judges',
//                    'Read judges',
//                    'Update judges',
//                    'Delete judges',
//                    'Print judges',
//                ]
//            ],
//            [
//                'slug' => uniqid(),
//                'name' => 'Court type',
//                'permissions' => [
//                    'Manage court type',
//                    'Create court type',
//                    'Read court type',
//                    'Update court type',
//                    'Delete court type',
//                    'Print court type',
//                ]
//            ],
//            [
//                'slug' => uniqid(),
//                'name' => 'Users',
//                'permissions' => [
//                    'Manage users',
//                    'Create users',
//                    'Read users',
//                    'Update users',
//                    'Delete users',
//                    'Print users',
//                    'Export users',
//                    'Ban users',
//                ]
//            ],
//
//            [
//                'slug' => uniqid(),
//                'name' => 'Roles',
//                'permissions' => [
//                    'Manage roles',
//                    'Create roles',
//                    'Read roles',
//                    'Update roles',
//                    'Delete roles',
//                    'Print roles',
//                    'Export roles',
//                ]
//            ],
//            [
//                'slug' => uniqid(),
//                'name' => 'System Settings',
//                'permissions' => [
//                    'Manage settings',
//                    'Create settings',
//                    'Read settings',
//                    'Update settings',
//                ]
//            ],
//            [
//                'slug' => uniqid(),
//                'name' => 'Logs',
//                'permissions' => [
//                    'Read logs',
//                ]
//            ],
//            [
//                'slug' => uniqid(),
//                'name' => 'Ticket & Support',
//                'permissions' => [
//                    'Manage support',
//                ]
//            ]

        ];

        foreach ($allModules as $module) {

            $createdModule = \App\Models\Module::query()->updateOrcreate(
                [

                    'name' => $module['name']
                ],
                [
                    'slug' => $module['slug'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

            foreach ($module['permissions'] as $permission) {
                \Spatie\Permission\Models\Permission::query()->updateOrcreate(
                    [
                        'name' => $permission,
                        'module_id' => $createdModule->id,
                    ],
                    [
                        'guard_name' => 'web',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
            }
        }
    }
}
