<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
class ProgramFixtures extends Fixture
{
    const PROGRAM_TITLES = [
        'The Walking Dead',
        'The Night Agent',
        '24',
        'Two and a half man',
        'One Piece'
        ];
    const PROGRAM_SYNOPSIS = [
        'Sheriff Deputy Rick Grimes wakes up from a coma to learn the world is in ruins and must lead a group of survivors to stay alive.',

        'While monitoring a secret emergency line that rarely rings, vigilant FBI agent Peter Sutherland (Gabriel Basso) answers a call from a young woman named Rose (Luciane Buchanan) whose relatives were just killed and who is on the run from the murderer',

        'Counter Terrorism Agent Jack Bauer races against the clock to subvert terrorist plots and save his nation from ultimate disaster',

        ' A hedonistic jingle writer\'s free-wheeling life comes to an abrupt halt when his brother and 10-year-old nephew move into his beach-front house.',

        'The One Piece is the driving goal of Monkey D. Luffy and his crew, as well as that of multiple other pirates, who all seek to claim the treasure in order to become the next Pirate King, following 
        Roger\'s dying words at his execution.'
        ];

    const PROGRAM_CATEGORIES = [
        'Horreur',
        'Thriller',
        'Policier',
        'Comédie',
        'Animation'
        ];


//            'title'=> 'The Night Agent',
//            'synopsis' => ' While monitoring a secret emergency line that rarely rings, vigilant FBI agent Peter Sutherland (Gabriel Basso) answers a call from a young woman named Rose (Luciane Buchanan) whose relatives were just killed and who is on the run from the murderer.',
//            'category' => 'Thriller',
//        ],
//        [
//        'title'=> '24',
//        'synopsis' => ' Counter Terrorism Agent Jack Bauer races against the clock to subvert terrorist plots and save his nation from ultimate disaster.',
//        'category' => 'Policier',
//        ],
//        [
//            'title'=> 'Two and a half men',
//            'synopsis' => ' A hedonistic jingle writer\'s free-wheeling life comes to an abrupt halt when his brother and 10-year-old nephew move into his beach-front house.',
//            'category' => 'Comédie',
//        ],
//        [
//            'title'=> 'One Piece',
//            'synopsis' => 'The One Piece is the name the world gave to all the treasure gained by the Pirate King Gol D. Roger.[2] At least a portion of it once belonged to Joy Boy during the Void Century.[3] The treasure is said to be of unimaginable value, and is currently located on the final island of the Grand Line: Laugh Tale.
//
//            The One Piece is the driving goal of Monkey D. Luffy and his crew, as well as that of multiple other pirates, who all seek to claim the treasure in order to become the next Pirate King, following Roger\'s dying words at his execution.',
//            'category' => 'Animation',
//        ],
//        [
//            'title'=> 'Walking Dead',
//            'synopsis' => 'Sheriff Deputy Rick Grimes wakes up from a coma to learn the world is in ruins and must lead a group of survivors to stay alive.',
//            'category' => 'Horreur',
//        ],
//    ];
    public function load(ObjectManager $manager)
    {
        foreach (self::PROGRAM_TITLES as $key => $programTitle) {
            $program = new Program();
            $program->setTitle($programTitle);
            $program->setSynopsis(self::PROGRAM_SYNOPSIS[$key]);
            $program->setCategory($this->getReference('category_' . self::PROGRAM_CATEGORIES[$key]));
            $manager->persist($program);
        }
        $manager->flush();
    }
//    {
//        $program = new Program();
//        $program->setTitle('Walking dead');
//        $program->setSynopsis('Des zombies envahissent la terre');
//        $program->setCategory($this->getReference('category_Action'));
//        $manager->persist($program);
//        $manager->flush();
//    }

    public function getDependencies(): array
    {
        return [
            CategoryFixtures::class,
        ];
    }


}