<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Band::class, 4)->create();      
        
        /*
        factory(App\User::class, 10)->create(); 
        factory(App\Song::class, 30)->create();
        for ($i = 1; $i < 11; $i++) {
            $number = rand(2, 8);
            for ($j = 1; $j <= $number; $j++) {
                DB::table('song_user')->insert([
                    'user_id' => rand(1, 10),
                    'song_id' => $i
                ]);
            }
        } 
        //ce script crééra $number x $i lignes. Le pb est que des songs appartiennent à plusieurs users mais bon pas grave c'est du test
        */
        
        factory(App\User::class, 10)->create();

        $ids = range(1, 10);

        factory(App\Song::class, 40)->create()->each(function ($song) use($ids) {
            shuffle($ids);
        });

    }
}
