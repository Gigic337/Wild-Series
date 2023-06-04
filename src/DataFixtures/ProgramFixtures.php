//<?php
//
//namespace App\DataFixtures;
//
//use App\Entity\Program;
//use Doctrine\Bundle\FixturesBundle\Fixture;
//use Doctrine\Common\DataFixtures\DependentFixtureInterface;
//use Doctrine\Persistence\ObjectManager;
//use phpDocumentor\Reflection\Types\Integer;
//
//class ProgramFixtures extends Fixture implements DependentFixtureInterface
//{
//    const PROGRAMS = [
//        [
//            'title' => 'The Night Agent',
//            'synopsis' => ' While monitoring a secret emergency line that rarely rings, vigilant FBI agent
//            Peter Sutherland answers a call from a young woman named Rose whose relatives were just killed and who is
//             on the run from the murderer.',
//            'country' => 'United-States',
//            'year' => 2022,
//            'category' => 'Thriller',
//            'poster' => 'https://picsum.photos/',
//        ],
//
//        [
//            'title' => '24',
//            'synopsis' => ' Counter Terrorism Agent Jack Bauer races against the clock to subvert terrorist plots
//             and save his nation from ultimate disaster.',
//            'country' => 'United States',
//            'year' => 1999,
//            'category' => 'Policier',
//            'poster' => 'https://picsum.photos/',
//        ],
//
//        [
//            'title' => 'Two and a half men',
//            'synopsis' => ' A hedonistic jingle writer\'s free-wheeling life comes to an abrupt halt when his brother
//            and 10-year-old nephew move into his beach-front house.',
//            'country' => 'United States',
//            'year' => 2002,
//            'category' => 'Comédie',
//            'poster' => ''https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSRWXm18S0ymVL5-ioJme84jAez0aSmiiUyzw&usqp=CAU'',
//        ],
//        [
//            'title' => 'One Piece',
//            'synopsis' => 'The One Piece is the driving goal of Monkey D. Luffy and his crew, as well other pirates,
//             who all seek to claim the treasure in order to become the next Pirate King, following Roger\'s dying
//             words at his execution.',
//            'country' => 'Japan',
//            'year' => 1990,
//            'category' => 'Animation',
//            'poster' => 'https://picsum.photos/',
//        ],
//        [
//            'title' => 'Walking Dead',
//            'synopsis' => 'Sheriff Deputy Rick Grimes wakes up from a coma to learn the world is in ruins and
//            must lead a group of survivors to stay alive.',
//            'country' => 'United States',
//            'year' => 2000,
//            'category' => 'Horreur',
//            'poster' => 'https://picsum.photos/',
//        ],
//    ];
//
//
//    public function load(ObjectManager $manager)
//    {
//        foreach (self::PROGRAMS as $program) {
//            $programForFixture = new Program();
//            $programForFixture
//                ->setTitle($program ['title'])
//                ->setSynopsis($program ['synopsis'])
//                ->setCountry($program ['country'])
//                ->setYear($program ['year'])
//                ->setPoster($program ['poster'])
//                ->setCategory($this->getReference('category_' . $program['category']));
//
//            $manager->persist($programForFixture);
//
//            $this->addReference('program_'.$program['title'], $programForFixture);
//        }
//        $manager->flush();
//    }
//
//    public function getDependencies()
//    {
//        // Tu retournes ici toutes les classes de fixtures dont ProgramFixtures dépend
//        return [
//            CategoryFixtures::class,
//        ];
//    }
//
//
//
//// Exemple pour écrire fixture pour un program
////    {
////        $program = new Program();
////        $program->setTitle('Walking dead');
////        $program->setSynopsis('Des zombies envahissent la terre');
////        $program->setCategory($this->getReference('category_Action'));
////        $manager->persist($program);
////        $manager->flush();
////    }
////
////
//// Autre façon d'écrire la fonction:
////    const PROGRAM_TITLES = [
////        'The Walking Dead',
////        'The Night Agent',
////        '24',
////        'Two and a half man',
////        'One Piece'
////        ];
////    const PROGRAM_SYNOPSIS = [
////        'Sheriff Deputy Rick Grimes wakes up from a coma to learn the world is in ruins and must lead a group of survivors to stay alive.',
////
////        'While monitoring a secret emergency line that rarely rings, vigilant FBI agent Peter Sutherland (Gabriel Basso) answers a call from a young woman named Rose (Luciane Buchanan) whose relatives were just killed and who is on the run from the murderer',
////
////        'Counter Terrorism Agent Jack Bauer races against the clock to subvert terrorist plots and save his nation from ultimate disaster',
////
////        ' A hedonistic jingle writer\'s free-wheeling life comes to an abrupt halt when his brother and 10-year-old nephew move into his beach-front house.',
////
////        'The One Piece is the driving goal of Monkey D. Luffy and his crew, as well as that of multiple other pirates, who all seek to claim the treasure in order to become the next Pirate King, following
////        Roger\'s dying words at his execution.'
////        ];
////
////    const PROGRAM_CATEGORIES = [
////        'Horreur',
////        'Thriller',
////        'Policier',
////        'Comédie',
////        'Animation'
////        ];
////    public function load(ObjectManager $manager)
////    {
////        foreach (self::PROGRAM_TITLES as $key => $programTitle) {
////            $program = new Program();
////            $program->setTitle($programTitle);
////            $program->setSynopsis(self::PROGRAM_SYNOPSIS[$key]);
////            $program->setCategory($this->getReference('category_' . self::PROGRAM_CATEGORIES[$key]));
////            $manager->persist($program);
////        }
////        $manager->flush();
////    }
//
//}