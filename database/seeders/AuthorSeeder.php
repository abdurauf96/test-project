<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $authors=collect([
            ['id'=>1, 'name'=>'James Clear'],
            ['id'=>2, 'name'=>'Jason Fried'],
        ]);

        $authors->each(function($author){
            \DB::table('authors')->insert($author);
        });
        
    }
}
