<?php

namespace Modules\Core\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Core\Entities\Permission;
use Modules\Core\Entities\User;

class CoreDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $this->call([
             PermissionSeeder::class,
         ]);
//        User::factory()->count(100)->create();
//        Permission::factory()->count(50)->create();
    }
}
