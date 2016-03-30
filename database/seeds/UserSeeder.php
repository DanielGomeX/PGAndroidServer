<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        
        DB::table('users')->insert([
            'name' => 'Cleber Silva',
            'email' => 'cleber@digitalmap.com.br',
            'password' => bcrypt('123456'),
            'created_at' => date('Y-M-D H:m:i:s'),
            'updated_at' => date('Y-M-D H:m:i:s'),
            'group_id' => 1,
        ]); 

        DB::table('groups')->insert([
            'name' => 'Digital Map',    
            'nivel' => -1,       
            'created_at' => date('Y-M-D H:m:i:s'),
            'updated_at' => date('Y-M-D H:m:i:s'),          
        ]); 

        DB::table('permissions')->insert([
            'name' => 'Adm. Root',    
            'slug' => 'root',       
            'created_at' => date('Y-M-D H:m:i:s'),
            'updated_at' => date('Y-M-D H:m:i:s'),          
        ]);  

        DB::table('group_permission')->insert([
            'group_id' => 1,    
            'permission_id' => 1,                     
        ]);        
    }
}
