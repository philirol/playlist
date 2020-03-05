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
            'bandname' => 'Démo Band',
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
            'bandname' => 'Arthur et le Minigirls',
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
            'band_id' => 2,
            'name' => 'leader1',
            'admin' => false,
            'leader' => true,
            'email' => 'leader1@free.fr',
            'password' => Hash::make('password'),
        ]);

        DB::table('users')->insert([
            'band_id' => 3,
            'name' => 'leader2',
            'admin' => false,
            'leader' => true,
            'email' => 'leader2@outlook.fr',
            'password' => Hash::make('password'),
        ]);

        factory(App\User::class, 5)->create();


        DB::table('songs')->insert([
            'band_id' => 1,
            'user_id' => rand(1, 10),
            'title' => 'How Do You Think -The Brand New Heavies',
            'reference' => 'https://www.youtube.com/watch?v=S9Wn6AvAg5s',
            'order' => 1,
            'list' => 1,
            'note' => 'This is a note about you can modify or delete.',
        ]);
        DB::table('songs')->insert([
            'band_id' => 1,
            'user_id' => rand(1, 10),
            'title' => 'Greyboy allstars - Soul dream',
            'reference' => 'https://www.youtube.com/watch?v=0acjErtoqOs',
            'order' => 2,
            'list' => 1,
            'note' => 'This is a note about you can delete or modify.',
        ]);
        DB::table('songs')->insert([
            'band_id' => 1,
            'user_id' => rand(1, 10),
            'title' => 'Cleopatra\'s cat - Spin Doctors',
            'reference' => 'https://www.youtube.com/watch?v=GuDgvbpVQD4',
            'order' => 3,
            'list' => 1,
            'note' => 'This is a note about the song.',
        ]);
        DB::table('songs')->insert([
            'band_id' => 1,
            'user_id' => rand(1, 10),
            'title' => 'Just Kissed My Baby - Jon Cleary',
            'reference' => 'https://www.youtube.com/watch?v=Jvj6xA251eg',
            'order' => 4,
            'list' => 1,
            'note' => 'Break à 1:49.',
        ]);
        DB::table('songs')->insert([
            'band_id' => 1,
            'user_id' => rand(1, 10),
            'title' => 'Use me - Raw Stylus',
            'reference' => 'https://www.youtube.com/watch?v=Q1WPVBVfoL8',
            'order' => 5,
            'list' => 1,
            'note' => 'Couplets - rth funk/overdr/wah',
        ]);
        DB::table('songs')->insert([
            'band_id' => 1,
            'user_id' => rand(1, 10),
            'title' => 'Solsonics - Ascension',
            'reference' => 'https://www.youtube.com/watch?v=p_E625gOito',
            'order' => 1,
            'list' => 0,
            'note' => 'Couplets - rth funk/overdr/wah',
        ]);
        DB::table('songs')->insert([
            'band_id' => 1,
            'user_id' => rand(1, 10),
            'title' => 'Dark End Street - Spice',
            'reference' => 'https://www.youtube.com/watch?v=VmnDIcabkBU',
            'order' => 2,
            'list' => 0,
            'note' => 'cocotte en C (7 mesures)',
        ]);
        DB::table('songs')->insert([
            'band_id' => 1,
            'user_id' => rand(1, 10),
            'title' => 'Yellow Jackets - Sittin\' in It',
            'reference' => 'https://www.youtube.com/watch?v=PPAUdqhjsXk',
            'order' => 3,
            'list' => 0,
            'note' => 'too good',
        ]);
    
        

        $faker = Faker::create();
        
        foreach (range(1,5) as $index) {
            DB::table('songs')->insert([
                'band_id' => 2,
                'user_id' => rand(1, 10),
                'title' => $faker->Company,
                'reference' => $faker->url,
                'order' => $index,
                'list' => 1,
                'note' => 'This is a note'
            ]);
        }
        
        foreach (range(1,5) as $index) {
            DB::table('songs')->insert([
                'band_id' => 2,
                'user_id' => rand(1, 10),
                'title' => $faker->Company,
                'reference' => $faker->url,
                'order' => $index,
                'list' => 0,
                'note' => 'This is a note'
            ]);
        }

        foreach (range(1,5) as $index) {
            DB::table('songs')->insert([
                'band_id' => 3,
                'user_id' => rand(1, 10),
                'title' => $faker->Company,
                'reference' => $faker->url,
                'order' => $index,
                'list' => 1,
                'note' => 'This is a note'
            ]);
        }
        foreach (range(1,5) as $index) {
            DB::table('songs')->insert([
                'band_id' => 3,
                'user_id' => rand(1, 10),
                'title' => $faker->Company,
                'reference' => $faker->url,
                'order' => $index,
                'list' => 0,
                'note' => 'This is a note'
            ]);
        }

        foreach (range(1,5) as $index) {
            DB::table('songs')->insert([
                'band_id' => 4,
                'user_id' => rand(1, 10),
                'title' => $faker->Company,
                'reference' => $faker->url,
                'order' => $index,
                'list' => 1,
                'note' => 'This is a note'
            ]);
        }
        foreach (range(1,5) as $index) {
            DB::table('songs')->insert([
                'band_id' => 4,
                'user_id' => rand(1, 10),
                'title' => $faker->Company,
                'reference' => $faker->url,
                'order' => $index,
                'list' => 0,
                'note' => 'This is a note'
            ]);
        }


        

/*         $ids = range(1, 10);
        factory(App\Song::class, 40)->create()->each(function ($song) use($ids) {
            shuffle($ids);
        });
        */

    }
}
