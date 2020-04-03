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
            'bandname' => 'The Demo Band',
            'slug' => 'demo-band',
            'city' => '30000',
        ]);

        DB::table('bands')->insert([
            'bandname' => 'The Rolling Fools',
            'slug' => 'rolling_fools',
            'city' => '15000',
        ]);

        DB::table('bands')->insert([
            'bandname' => 'Mothers if Invasion',
            'slug' => 'mothers_invasion',
            'city' => '9200',
        ]);

        DB::table('bands')->insert([
            'bandname' => 'Justicks',
            'slug' => 'justicks',
            'city' => '28546',
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
            'band_id' => 2,
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
            'email' => 'clarency@avg.org',
            'password' => Hash::make('password'),
            'image' => 'userId2-1585124056.jpg'
        ]);

        DB::table('users')->insert([
            'band_id' => 1,
            'name' => 'Franck',
            'admin' => false,
            'leader' => true,
            'email' => 'fcobin330@gmail.com',
            'password' => Hash::make('password'),
            'image' => 'userId3-1585124091.jpg'
        ]);

        DB::table('users')->insert([
            'band_id' => 1,
            'name' => 'Bob',
            'admin' => false,
            'leader' => false,
            'email' => 'bobam9940@aol.uk',
            'password' => Hash::make('password'),
            'image' => 'userId4-1585124122.jpg'
        ]);

        DB::table('users')->insert([
            'band_id' => 1,
            'name' => 'Janice',
            'admin' => false,
            'leader' => false,
            'email' => 'jbass2356@zoho.org',
            'password' => Hash::make('password'),
            'image' => 'userId5-1585124166.jpg'
        ]);

        DB::table('users')->insert([
            'band_id' => 1,
            'name' => 'Pat',
            'admin' => false,
            'leader' => false,
            'email' => 'patsax47@mail.com',
            'password' => Hash::make('password'),
            'image' => 'userId6-1585124199.jpg'
        ]);

        DB::table('users')->insert([
            'band_id' => 2,
            'name' => 'Héloise',
            'admin' => false,
            'leader' => true,
            'email' => 'hdou@trybe.de',
            'password' => Hash::make('password'),
        ]);

        factory(App\User::class, 3)->create(); //mettre 10 users pour être raccord avec le nombre de songs sinon erreur sur song.show


//SONGS & SONGSUBS
// Life on Mars
        DB::table('songs')->insert([
            'id' => 1,
            'band_id' => 1,
            'user_id' => 3,
            'title' => 'Life On Mars (cover)',
            'order' => 1,
            'list' => 1,
            'comments' => 'Franck : Hi Are yu ok with that intro?.',
        ]);
        DB::table('songsubs')->insert([
            'song_id' => 1,
            'user_id' => 3,
            'main' => 0,
            'title' => 'Cover R.Coleman',
            'type' => 1,
            'url' => 'https://www.youtube.com/watch?v=3GrnljG9fyM&start_radio=1&list=RD3GrnljG9fyM',
        ]);
        DB::table('songsubs')->insert([
            'song_id' => 1,
            'user_id' => 3,
            'main' => 0,
            'title' => 'NYLiveLifeOnMars.jpg',
            'type' => 3,
            'file' => 'demo-band/NYLiveLifeOnMars-1585125456.jpg',
        ]);
        DB::table('songsubs')->insert([
            'song_id' => 1,
            'user_id' => 3,
            'main' => 1,
            'title' => 'Life on Mars Intro',
            'type' => 2,
            'file' => 'demo-band/LifeonMarsintro-1585843256.mp3',
        ]);

//Wonderwall        
        DB::table('songs')->insert([
            'id' => 2,
            'band_id' => 1,
            'user_id' => 6,
            'title' => 'Wonderwall',
            'order' => 2,
            'list' => 1,
            'comments' => 'Pat : We start with it for next live, itwldbnice',
        ]);
        DB::table('songsubs')->insert([
            'song_id' => 2,
            'user_id' => 6,
            'main' => 1,
            'title' => 'Original clip',
            'type' => 1,
            'url' => 'https://www.youtube.com/watch?v=bx1Bh8ZvH84',
        ]);

//No surprises
        DB::table('songs')->insert([            
            'id' => 3,
            'band_id' => 1,
            'user_id' => 2,
            'title' => 'Radiohead - No Surprises',
            'order' => 3,
            'list' => 1,
            'comments' => 'Clarence : I would like to change the tonality in Am.',
        ]);

        DB::table('songsubs')->insert([
            'song_id' => 3,
            'user_id' => 2,
            'main' => 1,
            'title' => 'Original Clip',
            'type' => 1,
            'url' => 'https://www.youtube.com/watch?v=u5CVsCnxyXg',
        ]);

//Cleopatra
        DB::table('songs')->insert([
            'id' => 4,
            'band_id' => 1,
            'user_id' => 6,
            'title' => 'Cleopatra\'s cat - Spin Doctors',
            'order' => 4,
            'list' => 1,
            'comments' => 'Pat : my bloody favorit song ever.. 20 years ago,  but still sexy indeed',
        ]);
        DB::table('songsubs')->insert([
            'song_id' => 4,
            'user_id' => 6,
            'main' => 1,
            'title' => 'Original Vidéo ytb',
            'type' => 1,
            'url' => 'https://www.youtube.com/watch?v=GuDgvbpVQD4',
        ]);
    
//U2
        DB::table('songs')->insert([
            'id' => 5,
            'band_id' => 1,
            'user_id' => 5,
            'title' => 'U2 - I Still Haven\'t Found',
            'order' => 5,
            'list' => 1,
            'comments' => 'Jany : If someone says that Bono is a bad vocalist send them this song',
        ]); 
        DB::table('songsubs')->insert([
            'song_id' => 5,
            'user_id' => 5,
            'main' => 0,
            'title' => 'Original Clip',
            'type' => 1,
            'url' => 'https://www.youtube.com/watch?v=e3-5YC_oHjE',
        ]); 
        DB::table('songsubs')->insert([
            'song_id' => 5,
            'user_id' => 2,
            'main' => 1,
            'title' => 'IStillhaventfoundU2.docx',
            'type' => 3,
            'file' => 'demo-band/IStillhaventfoundU2-1585124881.txt',
        ]);   
        
//The White Stripes-Jolene    

        DB::table('songs')->insert([
            'id' => 6,
            'band_id' => 1,
            'user_id' => 4,
            'title' => 'The White Stripes-Jolene',
            'order' => 5,
            'list' => 1,
            'comments' => 'Thanks Bob but I prefer the M.Cyrus vs. Clarence',
        ]); 
        DB::table('songsubs')->insert([
            'song_id' => 6,
            'user_id' => 4,
            'main' => 0,
            'title' => 'Original Clip',
            'type' => 1,
            'url' => 'https://www.youtube.com/watch?v=yXlULkwhgrc',
        ]); 
        DB::table('songsubs')->insert([
            'song_id' => 6,
            'user_id' => 3,
            'main' => 0,
            'title' => 'Miley C version',
            'type' => 1,
            'url' => 'https://www.youtube.com/watch?v=wOwblaKmyVw',
        ]);
        DB::table('songsubs')->insert([
            'song_id' => 6,
            'user_id' => 1,
            'main' => 1,
            'title' => 'Demo acoustic',
            'type' => 2,
            'file' => 'demo-band/JoleneTest-1585845075.mp3',
        ]);

//Liste Projets
//Coldplay - Yellow
        DB::table('songs')->insert([
            'id' => 7,
            'band_id' => 1,
            'user_id' => 4,
            'title' => 'Coldplay - Yellow',
            'order' => 1,
            'list' => 0,
            'comments' => 'Use your chimes for that Bob please Franck!',
        ]);
        DB::table('songsubs')->insert([
            'song_id' => 7,
            'user_id' => 4,
            'main' => 1,
            'title' => 'Yellow - Original',
            'type' => 1,
            'url' => 'https://www.youtube.com/watch?v=yKNxeF4KMsY',
        ]);

//Beat it  
        DB::table('songs')->insert([
            'id' => 8,
            'band_id' => 1,
            'user_id' => 3,
            'title' => 'Beat it',
            'order' => 2,
            'list' => 0,
            'comments' => 'Back track attached',
        ]);
        DB::table('songsubs')->insert([
            'song_id' => 8,
            'user_id' => 3,
            'main' => 1,
            'title' => 'Beatitbacktr.mp3',
            'type' => 2,
            'file' => 'demo-band/Beatitbacktr-1585126956.mp3',
        ]); 

//Tracy Chapman - Fast car
        DB::table('songs')->insert([
            'id' => 9,
            'band_id' => 1,
            'user_id' => 5,
            'title' => 'Tracy Chapman - Fast car',
            'order' => 3,
            'list' => 0,
            'comments' => 'Jany : doesn\'t even sound like an 80s song I like it',
        ]);
        DB::table('songsubs')->insert([
            'song_id' => 9,
            'user_id' => 5,
            'main' => 1,
            'title' => 'Youtube link',
            'type' => 1,
            'url' => 'https://www.youtube.com/watch?v=DwrHwZyFN7M',
        ]);

//Nina Simone - Backlash Blues
        DB::table('songs')->insert([
            'id' => 10,
            'band_id' => 1,
            'user_id' => 3,
            'title' => 'Nina Simone - Backlash Blues',
            'order' => 4,
            'list' => 0,
            'comments' => 'Clarence, let it in Bb',
        ]);
        DB::table('songsubs')->insert([
            'song_id' => 10,
            'user_id' => 3,
            'main' => 1,
            'title' => 'N.Simone Ytb',
            'type' => 1,
            'url' => 'https://www.youtube.com/watch?v=2Pj9AucSc9Y',
        ]);

//Dream on
        DB::table('songs')->insert([
            'id' => 11,
            'band_id' => 1,
            'user_id' => 2,
            'title' => 'Dream on',
            'order' => 5,
            'list' => 0,
            'comments' => 'Should be better with a 12 strings guitar',
        ]);
        DB::table('songsubs')->insert([
            'song_id' => 11,
            'user_id' => 2,
            'main' => 1,
            'title' => 'Dream On Acoustic',
            'type' => 2,
            'file' => 'demo-band/Dreamonintro-1585844017.mp3',
        ]);
     

        //30 autre morceaux pour les autres groupes et user SANS SONGSUBS

        $faker = Faker::create();
        
        foreach (range(1,5) as $index) {
            DB::table('songs')->insert([
                'band_id' => 2,
                'user_id' => 8,
                'title' => $faker->Company,
                'order' => $index,
                'list' => 1,
                'comments' => 'This is a note'
            ]);
        }
        
        foreach (range(1,5) as $index) {
            DB::table('songs')->insert([
                'band_id' => 2,
                'user_id' => 8,
                'title' => $faker->Company,
                'order' => $index,
                'list' => 0,
                'comments' => 'This is a note'
            ]);
        }

        foreach (range(1,5) as $index) {
            DB::table('songs')->insert([
                'band_id' => 3,
                'user_id' => 9,
                'title' => $faker->Company,
                'order' => $index,
                'list' => 1,
                'comments' => 'This is a note'
            ]);
        }
        foreach (range(1,5) as $index) {
            DB::table('songs')->insert([
                'band_id' => 3,
                'user_id' => 9,
                'title' => $faker->Company,
                'order' => $index,
                'list' => 0,
                'comments' => 'This is a note'
            ]);
        }

        foreach (range(1,5) as $index) {
            DB::table('songs')->insert([
                'band_id' => 4,
                'user_id' => 10,
                'title' => $faker->Company,
                'order' => $index,
                'list' => 1,
                'comments' => 'This is a note'
            ]);
        }
        foreach (range(1,5) as $index) {
            DB::table('songs')->insert([
                'band_id' => 4,
                'user_id' => 10,
                'title' => $faker->Company,
                'order' => $index,
                'list' => 0,
                'comments' => 'This is a note'
            ]);
        }

        
        // for print test
        foreach (range(1,50) as $index) {
            DB::table('songs')->insert([
                'band_id' => 4, //justicks
                'user_id' => 7, //Heloise
                'title' => $faker->citySuffix,
                'order' => $index,
                'list' => 1,
                'comments' => $faker->realText($maxNbChars = 50, $indexSize = 2), 
            ]);
        }
    }
}
