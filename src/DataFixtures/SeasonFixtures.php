<?php
//
//namespace App\DataFixtures;
//
//use App\Entity\Program;
//use App\Entity\Season;
//use Doctrine\Bundle\FixturesBundle\Fixture;
//use Doctrine\Common\DataFixtures\DependentFixtureInterface;
//use Doctrine\Persistence\ObjectManager;
//
//use Faker\Factory;
//
//class SeasonFixtures extends Fixture implements DependentFixtureInterface
//{
//    public function load(ObjectManager $manager)
//    {
//        $faker = Factory::create('fr_FR');
//        $usedNumbers = [];
//
//        for ($i = 0; $i < 2; $i++) {
//            $number = $faker->unique(true)->numberBetween(0, 2);
//
//            while (in_array($number, $usedNumbers)) {
//                $number = $faker->unique(true)->numberBetween(0, 2);
//            }
//            $season = new Season();
//            $season
//                ->setNumber($number)
//                ->setYear($faker->year(2023))
//                ->setDescription($faker->paragraph(3))
//
//                ->setProgram($this->getReference('program_'. ProgramFixtures::PROGRAMS[$i]['title']));
//
//            $manager->persist($season);
//            $this->setReference('season_' . $season->getNumber(), $season);
//            $usedNumbers[] = $number;
//        }
//        $manager->flush();
//    }
//
//    public function getDependencies()
//    {
//        // Tu retournes ici toutes les classes de fixtures dont ProgramFixtures dépend
//        return [
//            ProgramFixtures::class,
//        ];
//    }
//}