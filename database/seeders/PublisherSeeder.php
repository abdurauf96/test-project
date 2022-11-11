<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PublisherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $publishers=collect([
            ['id'=>1, 'name'=>'Publisher One'],
            ['id'=>2, 'name'=>'Publisher Two'],
        ]);
        $publishers->each(function($publisher){
            \DB::table('publishers')->insert($publisher);
        });
    }
}
