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
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this::call([
            // Auth Seeders
            CompanyTypeSeeder::class,
            CompanyDetailsSeeder::class,
            RoleSeeder::class,
            UserInfoSeeder::class,
            
            // Setup Data Seeders
            TransactionMainHeadSeeder::class,
            // ItemManufacturerSeeder::class,
            // ItemCategorySeeder::class,
            ItemUnitSeeder::class,
            // ItemFormSeeder::class,
            LocationInfoSeeder::class,
            TransactionGroupeSeeder::class,
            TransactionHeadSeeder::class,
            
            // Bank + Permission Seeders
            BankInfoSeeder::class,
            PermissionMainHeadSeeder::class,
            PermissionHeadSeeder::class,
            // RoutePermissionSeeder::class,
            
            // Client Side Setup Seeder
            StoreSeeder::class,
            TransactionWithSeeder::class,
            // DepartmentSeeder::class,
            // DesignationSeeder::class,
            
            ClientInfoSeeder::class,
            SupplierInfoSeeder::class,
        ]);
        
        


    }
}
