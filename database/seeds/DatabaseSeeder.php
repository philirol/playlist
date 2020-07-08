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
            'freeupload' => '0',
        ]);

        DB::table('bands')->insert([
            'bandname' => 'The Rolling Fools',
            'slug' => 'rolling-fools',
            'freeupload' => '1',
        ]);

        DB::table('bands')->insert([
            'bandname' => 'Mothers if Invasion',
            'slug' => 'mothers-invasion',
            'freeupload' => '0',
        ]);

        DB::table('bands')->insert([
            'bandname' => 'Justicks',
            'slug' => 'justicks',
            'freeupload' => '0',
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
        $faker = Faker::create();
        
        DB::table('users')->insert([
            'band_id' => 1,
            'name' => 'Clarence',
            'admin' => false,
            'leader' => false,
            'email' => 'clarency@avg.org',
            'email_verified_at' => $faker->dateTimeBetween('-6 months'),
            'password' => Hash::make('password'),
            'created_at' => $faker->dateTimeBetween('-4 years', '-6 months'),
            'image' => 'userId2-1585124056.jpg',
            'story' => 'I\'m an English singer, songwriter who defined the singer-songwriter movement of the 1990s. Among my experiences, I grew up in an upper-middle-class North London family, were voluntary stays in mental institutions—once as a teenager. Having played in several bands, I traveled to America, where I released my unnoticed debut album in 1992 on the Kings’ Northway label..'
        ]);

        DB::table('users')->insert([
            'band_id' => 1,
            'name' => 'Franck',
            'admin' => false,
            'leader' => true,
            'email' => 'fcobin330@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'image' => 'userId3-1585124091.jpg',
            'story' => 'Franck discovered his love for booze and electric guitar in college. Read on to find more about his family: parents, siblings, wife and kids.'
        ]);

        DB::table('users')->insert([
            'band_id' => 1,
            'name' => 'Bob',
            'admin' => false,
            'leader' => false,
            'email' => 'bobam9940@aol.uk',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'image' => 'userId4-1585124122.jpg',
            'story' => 'I was always obsessed by drums when I was younger. Even now I always look backwards to go forwards – I want to find the parts of a musical genre that have been lost...'
        ]);

        DB::table('users')->insert([
            'band_id' => 1,
            'name' => 'Janice',
            'admin' => false,
            'leader' => false,
            'email' => 'jbass2356@zoho.org',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'image' => 'userId5-1585124166.jpg',
            'story' => 'Janice’s career on bass is legendary. She could, and did, play almost anything. As a member of Manchester’s top session group, she has literally played on over 3000 songs since the 1980s.'
        ]);

        DB::table('users')->insert([
            'band_id' => 1,
            'name' => 'Pat',
            'admin' => false,
            'leader' => false,
            'email' => 'patsax47@mail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'image' => 'userId6-1585124199.jpg',
            'story' => 'Pat, a saxophonist who frequently plays gigs at weddings, restaurants and other venues, stepped outside his home in Manchester’s Kingwood neighborhood on a sunny day about three weeks ago and decided he’d play a tune on his sax.'
        ]);

        DB::table('users')->insert([
            'band_id' => 2,
            'name' => 'Phil',
            'admin' => true,
            'leader' => true,
            'email' => 'philirol@hotmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
        ]);

        DB::table('users')->insert([
            'band_id' => 3,
            'name' => 'Simone',
            'admin' => 0,
            'leader' => 1,
            'email' => 'mothers1@ijdi.co',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
        ]);
        
        DB::table('users')->insert([
            'band_id' => 4,
            'name' => 'Héloise',
            'admin' => false,
            'leader' => true,
            'email' => 'hdou@trybe.de',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
        ]);

        
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
            'band_id' => 1,
            'main' => 0,
            'title' => 'Cover R.Coleman',
            'type' => 1,
            'url' => 'https://www.youtube.com/watch?v=3GrnljG9fyM&start_radio=1&list=RD3GrnljG9fyM',
        ]);
        DB::table('songsubs')->insert([
            'song_id' => 1,
            'user_id' => 3,
            'band_id' => 1,
            'main' => 0,
            'title' => 'NYLiveLifeOnMars.jpg',
            'type' => 3,
            'file' => 'demo-band/NYLiveLifeOnMars-1585125456.jpg',
            'filesize' => '4815'
        ]);
        DB::table('songsubs')->insert([
            'song_id' => 1,
            'user_id' => 3,
            'band_id' => 1,
            'main' => 1,
            'title' => 'Life on Mars Intro',
            'type' => 2,
            'file' => 'demo-band/LifeonMarsintro-1585843256.mp3',
            'filesize' => '663575'
        ]);

        //Wonderwall        
        DB::table('songs')->insert([
            'id' => 2,
            'band_id' => 1,
            'user_id' => 5,
            'title' => 'Wonderwall',
            'order' => 2,
            'list' => 1,
            'comments' => 'Pat : We start with it for next live, itwldbnice',
        ]);
        DB::table('songsubs')->insert([
            'song_id' => 2,
            'user_id' => 5,
            'band_id' => 1,
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
            'band_id' => 1,
            'main' => 1,
            'title' => 'Original Clip',
            'type' => 1,
            'url' => 'https://www.youtube.com/watch?v=u5CVsCnxyXg',
        ]);

        //Cleopatra
        DB::table('songs')->insert([
            'id' => 4,
            'band_id' => 1,
            'user_id' => 1,
            'title' => 'Cleopatra\'s cat - Spin Doctors',
            'order' => 4,
            'list' => 1,
            'comments' => 'Pat : my bloody favorit song ever.. 20 years ago,  but still sexy indeed',
        ]);
        DB::table('songsubs')->insert([
            'song_id' => 4,
            'user_id' => 1,
            'band_id' => 1,
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
            'band_id' => 1,
            'main' => 0,
            'title' => 'Original Clip',
            'type' => 1,
            'url' => 'https://www.youtube.com/watch?v=e3-5YC_oHjE',
        ]); 
        DB::table('songsubs')->insert([
            'song_id' => 5,
            'user_id' => 2,
            'band_id' => 1,
            'main' => 1,
            'title' => 'IStillhaventfoundU2.docx',
            'type' => 3,
            'file' => 'demo-band/IStillhaventfoundU2-1585124881.txt',
            'filesize' => '1056'
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
            'band_id' => 1,
            'main' => 0,
            'title' => 'Original Clip',
            'type' => 1,
            'url' => 'https://www.youtube.com/watch?v=yXlULkwhgrc',
        ]); 
        DB::table('songsubs')->insert([
            'song_id' => 6,
            'user_id' => 3,
            'band_id' => 1,
            'main' => 0,
            'title' => 'Miley C version',
            'type' => 1,
            'url' => 'https://www.youtube.com/watch?v=wOwblaKmyVw',
        ]);
        DB::table('songsubs')->insert([
            'song_id' => 6,
            'user_id' => 1,
            'band_id' => 1,
            'main' => 1,
            'title' => 'Demo acoustic',
            'type' => 2,
            'file' => 'demo-band/JoleneTest-1585845075.mp3',
            'filesize' => '497439'
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
            'band_id' => 1,
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
            'band_id' => 1,
            'main' => 1,
            'title' => 'Beatitbacktr.mp3',
            'type' => 2,
            'file' => 'demo-band/Beatitbacktr-1585126956.mp3',
            'filesize' => '631758',
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
            'band_id' => 1,
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
            'band_id' => 1,
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
            'band_id' => 1,
            'main' => 1,
            'title' => 'Dream On Acoustic',
            'type' => 2,
            'file' => 'demo-band/Dreamonintro-1585844017.mp3',
            'filesize' => '750172'
        ]);





        


        
        factory(App\User::class, 3)->create(); //mettre 10 users pour être raccord avec le nombre de songs sinon erreur sur song.show


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

        DB::table('plans')->insert([
            'name' => 'Free',
            'slug' => 'free',
            'datavol' => '500Mo',
            'bitval' => '5000000',
        ]);

        DB::table('plans')->insert([
            'name' => 'Basic',
            'slug' => 'basic',
            'datavol' => '1Go',
            'stripe_plan' => 'plan_H57guQCYMdY92N',
            'cost' => '5',
            'bitval' => '10000000',
        ]);

        DB::table('plans')->insert([
            'name' => 'Stage',
            'slug' => 'stage',
            'datavol' => '2Go',
            'stripe_plan' => 'plan_P12MfgYtEZ45RE',
            'cost' => '10',
            'bitval' => '20000000',
        ]);

        DB::table('plans')->insert([
            'name' => 'Expand',
            'slug' => 'expand',
            'datavol' => '5Go',
            'stripe_plan' => 'plan_H4Oq0K9DGJLYZu',
            'cost' => '50',
            'bitval' => '50000000',
        ]);




        //medias PHOTOS

        DB::table('medias')->insert([
            'band_id' => 1,
            'name' => 'demo-band/User2-1589798781.jpg',
            'type' => 1,
            'description' => "Janice in darkness bassmoon"
        ]);

        DB::table('medias')->insert([
            'band_id' => 1,
            'name' => 'demo-band/User2-1589798700.jpg',
            'type' => 1,
            'description' => "Live in Montreal 2018"
        ]);

        DB::table('medias')->insert([
            'band_id' => 1,
            'name' => 'demo-band/User2-1589798660.jpg',
            'type' => 1,
            'description' => "Franck with his Flying V"
        ]);

        DB::table('medias')->insert([
            'band_id' => 1,
            'name' => 'demo-band/User2-1589798597.jpg',
            'type' => 1,
            'description' => "A major happening"
        ]);

        DB::table('medias')->insert([
            'band_id' => 1,
            'name' => 'demo-band/User2-1589798548.jpg',
            'type' => 1,
            'description' => "Clarence's wanna sing after Ched's drum solo"
        ]);

        DB::table('medias')->insert([
            'band_id' => 1,
            'name' => 'demo-band/User2-1589798470.jpg',
            'type' => 1,
            'description' => "An idea of Flyer disco night"
        ]);

        DB::table('medias')->insert([
            'band_id' => 1,
            'name' => 'demo-band/User2-1589798373.jpg',
            'type' => 1,
            'description' => "Bob's sometimes talkin"
        ]);

        DB::table('medias')->insert([
            'band_id' => 1,
            'name' => 'demo-band/User2-1589798238.jpg',
            'type' => 1,
            'description' => 'He brandishes his guitar like an ax'
        ]);

        DB::table('medias')->insert([
            'band_id' => 1,
            'name' => 'demo-band/User2-1589798144.jpg',
            'type' => 1,
            'description' => 'One guest with a beautiful Std Les Paul'
        ]);



        //medias VIDEOS

        DB::table('medias')->insert([
            'band_id' => 1,
            'name' => 'demo-band/User2-1589803155.mp4',
            'type' => 2,
            'description' => "Once upon a night in a great place"
        ]);

        DB::table('medias')->insert([
            'band_id' => 1,
            'name' => 'demo-band/User2-1589803128.mp4',
            'type' => 2,
            'description' => "Lift to heaven"
        ]);

        DB::table('medias')->insert([
            'band_id' => 1,
            'name' => 'demo-band/User2-1589803080.mp4',
            'type' => 2,
            'description' => "A great gift in the sky"
        ]);

        DB::table('medias')->insert([
            'band_id' => 1,
            'name' => 'demo-band/User2-1589803048.mp4',
            'type' => 2,
            'description' => "This is not as toxic it could be"
        ]);

        DB::table('medias')->insert([
            'band_id' => 1,
            'name' => 'demo-band/User2-1589803015.mp4',
            'type' => 2,
            'description' => "A short moment of a great drum solo."
        ]);




        //medias STORY
        //fix pb : turn story to text for the name of the field

        DB::table('story')->insert([
            'band_id' => 1,
            'text' => 'In late 2015, Janice started posting rock covers of popular songs on YouTube. By 2016, she begans posting original songs under the name Outland. She operated as a solo act until 2017, when she began adding additional band members. The fleshed out Outbar included Clarence as singer and second-hand guitarist, Arthur Burrows as lead guitarist and co-vocalist, Pat as the saxophone, and Dan Witter as drummer. The group was initially promoted as a full band through their music videos posted on the LA YouTube channel. The five were influenced heavily by punk rock and pop punk bands such as Blink-182, Simple Plan, and Green Day. In 2016 they signed to Easy Records and started touring under a new name, Story Ponama. Artur and Dan left the band by 2016 to focus on music school, and the band soon hired two news band members. Franck as a Guitarist and Bob as a drummer, so Clarence could focus more on singing.'
        ]);

    }
}
