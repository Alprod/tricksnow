<?php

namespace App\DataFixtures;

use App\Entity\Discussion;
use App\Entity\Figure;
use App\Entity\FigureGroup;
use App\Entity\Image;
use App\Entity\User;
use App\Entity\Video;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class FigureFixtures extends BaseFixtures implements DependentFixtureInterface
{

    protected function loadData(ObjectManager $manager)
    {
        $this->createMany(Figure::class, 20, function(Figure $figure) use ($manager){
            $figure
                ->setTitle($this->faker->words(2, true))
                ->setDescription($this->faker->realText(900, 3))
                ->setAuthor($this->getRandomReference(User::class))
                ->setFigureGroup($this->getRandomReference(FigureGroup::class))
                ->setCreatedAt($this->faker->dateTimeBetween('-2 years'));

            $discussion = new Discussion();

            $discussion->setArticles($figure);

            $manager->persist($discussion);

            for($img = 1; $img <= random_int(2, 7); ++$img) {

                $image = (new Image())->setCreatedAt($figure->getCreatedAt())
                                      ->setTitle($this->faker->words(3, true))
                                      ->setLink($this->faker->imageUrl(350, 150, 'animals'))
                                      ->setFigures($figure);

                $manager->persist($image);
            }

            for($vdeo = 1; $vdeo <= random_int(2, 7); ++$vdeo) {

                $video = (new Video())->setCreatedAt($figure->getCreatedAt())
                                      ->setTitle($this->faker->words(3, true))
                                      ->setLink($this->faker->youtubeUri())
                                      ->setFigures($figure);

                $manager->persist($video);
            }
        });

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
            GroupFigureFixtures::class
        ];
    }
}
