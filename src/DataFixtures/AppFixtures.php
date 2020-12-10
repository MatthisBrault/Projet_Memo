<?php

namespace App\DataFixtures;

use App\Entity\Project;
use App\Entity\Task;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('FR-fr');

        for($u = 1;$u <= 3; $u++){

            $project = new Project();

            $name = $faker->sentence();
            $creator = random_int(1, 4);
            $description = $faker->paragraph(3);

            $project->setName($name)
                ->setCreationDate(date_create("2020-12-08 09:00:00"))
                ->setCreator($creator)
                ->setStatus(0)
                ->setDescription($description);

            for ($i = 1; $i <= random_int(3, 10); $i++) {
                $task = new Task();

                $name = $faker->sentence();
                $content = $faker->paragraph(2);

                $task->setName($name)
                     ->setCreationDate(date_create("2020-12-".random_int(9, 22)." 09:00:00"))
                     ->setExpirationDate(date_create("2020-12-".random_int(22, 31)." 17:00:00"))
                     ->setCreator($creator)
                     ->setStatus(random_int(1, 3))
                     ->setContent($content)
                     ->setProject($project);

                    $manager->persist($task);
                }

                $manager->persist($project);
            }

        $manager->flush();
    }
}
