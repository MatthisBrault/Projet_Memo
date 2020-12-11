<?php

namespace App\DataFixtures;

use App\Entity\Project;
use App\Entity\ProjectManager;
use App\Entity\Task;
use App\Entity\Worker;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    const NBPROJECT = 5;
    const NBCP = 2;
    const NBWORKER = 5;

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('FR-fr');

        for($m = 1; $m <= self::NBCP; $m++) {                                       // fill CP
            $cp = new ProjectManager();

            $nameC = $faker->word();

            $cp->setName($nameC);

            for ($u = 1; $u <= random_int(1,(self::NBPROJECT/self::NBCP)); $u++) {                                  // fill project

                $project = new Project();

                $nameP = $faker->sentence();
                $description = $faker->paragraph(3);

                $ranW = random_int(1,(self::NBWORKER));
                for($w = 1; $w < $ranW; $w++){

                    $worker = new Worker();

                    $nameW = $faker->word();
                    $job = $faker->word();

                    $worker->setName($nameW)
                            ->setJob($job);


                    $project->setName($nameP)
                            ->setCreationDate(date_create("2020-12-08 09:00:00"))
                            ->setCreator($cp)
                            ->addWorker($worker)
                            ->setStatus(0)
                            ->setDescription($description);


                    for ($i = 1; $i <= random_int(3, 10); $i++) {              // fill task
                        $task = new Task();

                        $nameT = $faker->sentence();
                        $content = $faker->paragraph(2);

                        $colors = ["#ffffa5",
                                   "#7afcff",
                                   "#c7ea46",
                                   "#f59fb7",
                                   "#ffaA500"];

                        $color = $colors[random_int(0, 4)];

                        $task->setName($nameT)
                             ->setCreationDate(date_create("2020-12-".random_int(9, 22)." 09:00:00"))
                             ->setExpirationDate(date_create("2020-12-".random_int(22, 31)." 17:00:00"))
                             ->setStatus(random_int(1, 3))
                             ->setCreator($cp)
                             ->setContent($content)
                             ->setProject($project)
                             ->addWorker($worker)
                             ->setColor($color);



                        $manager->persist($task);
                    }

                    $manager->persist($worker);
                    $manager->persist($project);
                }



            }

            $manager->persist($cp);
        }



        $manager->flush();
    }
}
