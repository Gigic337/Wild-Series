<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Episode;
use App\Entity\Program;
use App\Entity\Season;
use App\Entity\Actor;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    // Category
    public const CATEGORIES = [
        'Action',
        'Aventure',
        'Animation',
        'Comédie',
        'Drame',
        'Fantastique',
        'Horreur',
        'Policier',
        'Romance',
        'Science-fiction',
        'Thriller',
    ];

    // Program
    public const PROGRAMS = [
        [
            'title' => 'The Night Agent',
            'synopsis' => ' While monitoring a secret emergency line that rarely rings, vigilant FBI agent
            Peter Sutherland answers a call from a young woman named Rose whose relatives were just killed and who is
             on the run from the murderer.',
            'country' => 'United-States',
            'year' => 2022,
            'category' => 'Thriller',
            'poster' => 'https://picsum.photos/',
        ],

        [
            'title' => '24',
            'synopsis' => ' Counter Terrorism Agent Jack Bauer races against the clock to subvert terrorist plots
             and save his nation from ultimate disaster.',
            'country' => 'United States',
            'year' => 1999,
            'category' => 'Policier',
            'poster' => 'https://picsum.photos/',
        ],

        [
            'title' => 'Two and a half men',
            'synopsis' => ' A hedonistic jingle writer\'s free-wheeling life comes to an abrupt halt when his brother
            and 10-year-old nephew move into his beach-front house.',
            'country' => 'United States',
            'year' => 2002,
            'category' => 'Comédie',
            'poster' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSRWXm18S0ymVL5-ioJme84jAez0aSmiiUyzw&usqp=CAU',
        ],
        [
            'title' => 'One Piece',
            'synopsis' => 'The One Piece is the driving goal of Monkey D. Luffy and his crew, as well other pirates,
             who all seek to claim the treasure in order to become the next Pirate King.',
            'country' => 'Japan',
            'year' => 1990,
            'category' => 'Animation',
            'poster' => 'https://picsum.photos/',
        ],
        [
            'title' => 'Walking Dead',
            'synopsis' => 'Sheriff Deputy Rick Grimes wakes up from a coma to learn the world is in ruins and
            must lead a group of survivors to stay alive.',
            'country' => 'United States',
            'year' => 2000,
            'category' => 'Horreur',
            'poster' => 'https://picsum.photos/',
        ],
    ];

    public const ACTORS = [
        'Gabriel Basso',
        'Luciane Buchanan',
        'Andre Anthony',
        'Kiefer Sutherland',
        'Mary Lynn Rajskub',
        'Carlos Bernard',
        'Charlie Sheen',
        'Jon Cryer',
        'Angus T. Jones',
        'Luffy',
        'Nami',
        'Zoro',
        'Eleanor Matsuura',
        'Norman Reedus',
        'Andrew Lincoln',
    ];


    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        //Category
        $categories = [];

        foreach (self::CATEGORIES as $data) {
            $category = new Category();
            $category->setName($data);
            $manager->persist($category);

            $categories[] = $category;
        }

        // Program
        $programs = [];
        foreach (self::PROGRAMS as $data) {
            $program = new Program();
            $program->setTitle($data['title']);
            $program->setSynopsis($data['synopsis']);
            $program->setPoster($data['poster']);
            $program->setCountry($data['country']);
            $program->setYear($data['year']);
            $program->setCategory($categories[rand(0, count($categories) - 1)]);

            $manager->persist($program);

            $programs[] = $program;
        }


        // Season
        $seasons = [];

        foreach ($programs as $program) {
            for ($i = 1; $i < 5; $i++) {
                $season = new Season();
                $season->setNumber($i);
                $season->setDescription($faker->paragraph(2));
                $season->setYear($faker->numberBetween(1989, 2023));
                // This step is before multiple season by program
                // There's no foreach around season before this step
                // $season->setProgram($programs[rand(0, count($programs) - 1)]);
                $season->setProgram($program);

                $manager->persist($season);

                $seasons[] = $season;
            }
        }

        //Episode
        foreach ($seasons as $season) {
            for ($i = 1; $i < 11; $i++) {
                $episode = new Episode();
                $episode->setTitle($faker->name);
                $episode->setSynopsis($faker->paragraph(2));
                $episode->setNumber($i);
                $episode->setSeason($season);

                $manager->persist($episode);
            }
        }

        //Actor

        $actors = [];
        foreach (self::ACTORS as $data) {
            $actor = new Actor();
            $actor->setName($data);

            $randomPrograms = array_rand($programs, 3); // Sélectionne trois index de programmes aléatoires

            foreach ($randomPrograms as $index) {
                $actor->addProgram($programs[$index]);
            }

            $manager->persist($actor);
        }

        $manager->flush();

    }


}




