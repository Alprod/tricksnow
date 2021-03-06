<?php

namespace App\DataFixtures;

use App\Entity\Discussion;
use App\Entity\Figure;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class DiscussionFixtures extends BaseFixtures implements DependentFixtureInterface
{

    /**
     * @param ObjectManager $manager
     * @return mixed
     * @throws \Exception
     */
    protected function loadData(ObjectManager $manager)
    {
        $this->createMany(Discussion::class, 4, function(Discussion $discussion, $index){
            $discussion->setFigures($this->getReference('figure_'.$index));
        });

        $manager->flush();
    }

    /**
     * @return mixed
     */
    public function getDependencies(): array
    {
        return [
            FigureFixtures::class
        ];
    }
}
