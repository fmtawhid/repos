<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('languages')->delete();
        
        DB::table('languages')->insert(array (
            0 => 
            array (
                'id'                      => '1',
                'name'                    => 'English',
                'flag'                    => 'en',
                'code'                    => 'en',
                'is_rtl'                  => '0',
                'is_active'               => 1,
                'user_id'                 => 1,
                'created_by_id'           => 1,
                'is_active_for_templates' => 1
            ),
        )); 
    }
}
