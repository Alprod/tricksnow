<?php

namespace App\DataFixtures;

use App\Entity\Discussion;
use App\Entity\Figure;
use App\Entity\Image;
use App\Entity\Video;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class FigureFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        $faker->addProvider(new \Faker\Provider\Youtube($faker));

        for ($figs = 1; $figs <= mt_rand(2, 5); $figs++) {
            $figures = new Figure();
            $figures->setTitle($faker->words(2, true))
                ->setDescription($faker->realText(1500, 3))
                ->setCreatedAt($faker->dateTimeBetween('-2 years', '-11 months'));

            $manager->persist($figures);

            for ($img = 1; $img <= mt_rand(3, 6); $img++) {
                $images = (new Image())->setTitle($faker->realText(2, 3))
                    ->setLink($faker->imageUrl(350, 150, 'animals'))
                    ->setFigures($figures)
                    ->setCreatedAt($figures->getCreatedAt());

                $manager->persist($images);
            }

            for ($vdo = 1; $vdo <= mt_rand(3, 5); $vdo++) {
                $videos = (new Video())->setTitle($faker->realText(3, 3))
                    ->setLink($faker->youtubeUri())
                    ->setFigures($figures)
                    ->setCreatedAt($figures->getCreatedAt());

                $manager->persist($videos);
            }

            $discussion = (new Discussion())->setArticles($figures);
            $manager->persist($discussion);

        }

        $manager->flush();
    }
}
