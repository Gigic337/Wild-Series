//<?php
//
//namespace App\DataFixtures;
//
//use App\Entity\Episode;
//use Doctrine\Bundle\FixturesBundle\Fixture;
//use Doctrine\Common\DataFixtures\DependentFixtureInterface;
//use Doctrine\Persistence\ObjectManager;
//use Faker\Factory;
//
//class EpisodeFixtures extends Fixture implements DependentFixtureInterface
//{
//    public function load(ObjectManager $manager): void
//    {
//        $faker = Factory::create('fr_FR');
//        $usedNumbers = [];
//
//        foreach(ProgramFixtures::PROGRAMS as $program) {
//
//                for ($i = 1; $i < 11; $i++) {
//                    $number = $faker->unique(true)->numberBetween(1, 10);
//
//                    while (in_array($number, $usedNumbers)) {
//                        $number = $faker->unique(true)->numberBetween(1, 10);
//                    }
//                $episode = new Episode();
//                $episode
//                    ->setTitle($faker->title())
//                    ->setNumber($number)
//                    ->setSynopsis($faker->paragraph(2))
//                    ->setSeason($this->getReference('season_'. $faker->numberBetween(0, 4)));
//
//                $manager->persist($episode);
//                $usedNumbers[] = $number;
//            }
//        }
//
//        $manager->flush();
//    }
//
//    public function getDependencies()
//    {
//        return [
//            SeasonFixtures::class,
//        ];
//    }
//}