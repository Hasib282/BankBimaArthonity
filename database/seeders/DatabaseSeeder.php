<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            // Setup Data Seeders
            TransactionGroupeSeeder::class,
            TransactionHeadSeeder::class,
            
            // Client Side Setup Seeder
            StoreSeeder::class,
            TransactionWithSeeder::class,
            DepartmentSeeder::class,
            DesignationSeeder::class,
            
            ClientInfoSeeder::class,
            SupplierInfoSeeder::class,
        ]);
    }
}
