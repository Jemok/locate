<?php

use Illuminate\Database\Seeder;

class LevelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('levels')->insert([

            'levelName' => 'Single Location',

        ]);

        DB::table('levels')->insert([

            'levelName' => 'Basement',

        ]);

        DB::table('levels')->insert([

            'levelName' => 'Ground Floor',

        ]);

        DB::table('levels')->insert([

            'levelName' => '1st floor',

        ]);

        DB::table('levels')->insert([

            'levelName' => '2nd floor',

        ]);

        DB::table('levels')->insert([

            'levelName' => '3rd floor',

        ]);

        DB::table('levels')->insert([

            'levelName' => '4th floor',

        ]);

        DB::table('levels')->insert([

            'levelName' => '5th floor',

        ]);

        DB::table('levels')->insert([

            'levelName' => '6th floor',

        ]);

        DB::table('levels')->insert([

            'levelName' => '7th floor',

        ]);

        DB::table('levels')->insert([

            'levelName' => '8th floor',

        ]);

        DB::table('levels')->insert([

            'levelName' => '9th floor',

        ]);

        DB::table('levels')->insert([

            'levelName' => '10th floor',

        ]);

    }
}
