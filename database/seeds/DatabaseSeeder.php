<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bands')->insert([
            'id' => 1,
            'bandname' => 'The Demo Band',
            'slug' => 'demo-band',
            'ville_id' => '30000',
        ]);

        DB::table('bands')->insert([
            'id' => 2,
            'bandname' => 'The Rolling Fools',
            'slug' => 'rolling_bugs',
            'ville_id' => '15000',
        ]);

        DB::table('bands')->insert([
            'id' => 3,
            'bandname' => 'Mothers if Invasion',
            'slug' => 'mothers_invasion',
            'ville_id' => '9200',
        ]);

        DB::table('bands')->insert([
            'id' => 4,
            'bandname' => 'Arthur and the Minigirls',
            'slug' => 'arthur_minigirls',
            'ville_id' => '28546',
        ]);
             
        
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
        
        DB::table('users')->insert([
            'band_id' => 1,
            'name' => 'Phil',
            'admin' => true,
            'leader' => true,
            'email' => 'philirol@hotmail.com',
            'password' => Hash::make('password'),
        ]);
        
        DB::table('users')->insert([
            'band_id' => 1,
            'name' => 'Clarence',
            'admin' => false,
            'leader' => false,
            'email' => 'Clarence@toppy.net',
            'password' => Hash::make('password'),
        ]);

        DB::table('users')->insert([
            'band_id' => 1,
            'name' => 'Franck',
            'admin' => false,
            'leader' => true,
            'email' => 'leader2@outlook.fr',
            'password' => Hash::make('password'),
        ]);

        DB::table('users')->insert([
            'band_id' => 1,
            'name' => 'Bob',
            'admin' => false,
            'leader' => false,
            'email' => 'bob@online.com',
            'password' => Hash::make('password'),
        ]);

        DB::table('users')->insert([
            'band_id' => 1,
            'name' => 'Janice',
            'admin' => false,
            'leader' => false,
            'email' => 'j2356@outty.org',
            'password' => Hash::make('password'),
        ]);

        DB::table('users')->insert([
            'band_id' => 1,
            'name' => 'Pat',
            'admin' => false,
            'leader' => false,
            'email' => 'patboum@orange.net',
            'password' => Hash::make('password'),
        ]);

        DB::table('users')->insert([
            'band_id' => 2,
            'name' => 'Héloise',
            'admin' => false,
            'leader' => false,
            'email' => 'hdou@trybe.de',
            'password' => Hash::make('password'),
        ]);

        factory(App\User::class, 3)->create(); //mettre 10 users pour être raccord avec le nombre de songs sinon erreur sur song.show


        DB::table('songs')->insert([
            'band_id' => 1,
            'user_id' => rand(2, 6),
            'title' => 'David Bowie – Life On Mars',
            'url' => 'https://www.youtube.com/watch?v=AZKcl4-tcuo',
            'order' => 1,
            'list' => 1,
            'comments' => 'Franck : Let\'s sing all together, guys.',
        ]);
        DB::table('songs')->insert([
            'band_id' => 1,
            'user_id' => rand(2, 6),
            'title' => 'Radiohead - No Surprises',
            'url' => 'https://www.youtube.com/watch?v=u5CVsCnxyXg',
            'order' => 2,
            'list' => 1,
            'comments' => 'Clarence : I would like to change the tonality in Am.',
        ]);
        DB::table('songs')->insert([
            'band_id' => 1,
            'user_id' => rand(1, 10),
            'title' => 'Cleopatra\'s cat - Spin Doctors',
            'url' => 'https://www.youtube.com/watch?v=GuDgvbpVQD4',
            'order' => 3,
            'list' => 1,
            'comments' => 'Pat : my bloody favorit song ever.. 20 years ago,  but still sexy indeed',
        ]);
        DB::table('songs')->insert([
            'band_id' => 1,
            'user_id' => rand(1, 10),
            'title' => 'U2 - I Still Haven\'t Found',
            'url' => 'https://www.youtube.com/watch?v=e3-5YC_oHjE',
            'order' => 4,
            'list' => 1,
            'comments' => 'Jany : If someone says that Bono is a bad vocalist send them this song',
        ]);
        DB::table('songs')->insert([
            'band_id' => 1,
            'user_id' => rand(1, 10),
            'title' => 'The White Stripes-Jolene',
            'url' => 'https://www.youtube.com/watch?v=yXlULkwhgrc',
            'order' => 5,
            'list' => 1,
            'comments' => 'Clarence : Thanks john but I prefer the M.Cyrus vs',
        ]);
        DB::table('songs')->insert([
            'band_id' => 1,
            'user_id' => rand(1, 10),
            'title' => 'Coldplay - Yellow',
            'url' => 'https://www.youtube.com/watch?v=yKNxeF4KMsY',
            'order' => 1,
            'list' => 0,
            'comments' => 'Use your chimes for that Bob please Franck!',
        ]);
        DB::table('songs')->insert([
            'band_id' => 1,
            'user_id' => rand(1, 10),
            'title' => 'Tracy Chapman - Fast car',
            'url' => 'https://www.youtube.com/watch?v=VmnDIcabkBU',
            'order' => 2,
            'list' => 0,
            'comments' => 'Jany : doesn\'t even sound like an 80s song I like it',
        ]);
        DB::table('songs')->insert([
            'band_id' => 1,
            'user_id' => rand(1, 10),
            'title' => 'Wonderwal',
            'order' => 3,
            'list' => 0,
            'comments' => 'Pat : We start with it for next live, itwldbnice',
        ]);

//songsubs

        DB::table('songsubs')->insert([
            'song_id' => 1,
            'user_id' => rand(1, 10),
            'main' =>
            'title' => 'Oasis - Wonderwal VO',
            'type' => 1,
            'url' => 'https://www.youtube.com/watch?v=bx1Bh8ZvH84',
            'comments' => '',
        ]);
        DB::table('songsubs')->insert([
            'song_id' => 1,
            'user_id' => 1,
            'title' => 'Frank Zappa - Willie The Pimp',
            'type' => 1,
            'url' => 'https://www.youtube.com/watch?v=KHiclrHm-ig',
            'comments' => '',
        ]);
        DB::table('songsubs')->insert([
            'song_id' => 2,
            'user_id' => 2,
            'title' => 'Is It You - Lee Ritenour',
            'type' => 1,
            'url' => 'https://www.youtube.com/watch?v=oHXv_qTGAms',
            'comments' => '',
        ]);
        DB::table('songsubs')->insert([
            'song_id' => 2,
            'user_id' => 2,
            'title' => 'Mornin',
            'type' => 1,
            'url' => 'https://www.youtube.com/watch?v=WJ3JyC-QQKY',
            'comments' => '',
        ]);
    
        

        $faker = Faker::create();
        
        foreach (range(1,5) as $index) {
            DB::table('songs')->insert([
                'band_id' => 2,
                'user_id' => rand(1, 10),
                'title' => $faker->Company,
                'url' => $faker->url,
                'order' => $index,
                'list' => 1,
                'comments' => 'This is a note'
            ]);
        }
        
        foreach (range(1,5) as $index) {
            DB::table('songs')->insert([
                'band_id' => 2,
                'user_id' => rand(1, 10),
                'title' => $faker->Company,
                'url' => $faker->url,
                'order' => $index,
                'list' => 0,
                'comments' => 'This is a note'
            ]);
        }

        foreach (range(1,5) as $index) {
            DB::table('songs')->insert([
                'band_id' => 3,
                'user_id' => rand(1, 10),
                'title' => $faker->Company,
                'url' => $faker->url,
                'order' => $index,
                'list' => 1,
                'comments' => 'This is a note'
            ]);
        }
        foreach (range(1,5) as $index) {
            DB::table('songs')->insert([
                'band_id' => 3,
                'user_id' => rand(1, 10),
                'title' => $faker->Company,
                'url' => $faker->url,
                'order' => $index,
                'list' => 0,
                'comments' => 'This is a note'
            ]);
        }

        foreach (range(1,5) as $index) {
            DB::table('songs')->insert([
                'band_id' => 4,
                'user_id' => rand(1, 10),
                'title' => $faker->Company,
                'url' => $faker->url,
                'order' => $index,
                'list' => 1,
                'comments' => 'This is a note'
            ]);
        }
        foreach (range(1,5) as $index) {
            DB::table('songs')->insert([
                'band_id' => 4,
                'user_id' => rand(1, 10),
                'title' => $faker->Company,
                'url' => $faker->url,
                'order' => $index,
                'list' => 0,
                'comments' => 'This is a note'
            ]);
        }


        

/*         $ids = range(1, 10);
        factory(App\Song::class, 40)->create()->each(function ($song) use($ids) {
            shuffle($ids);
        });
        */

    }
}
