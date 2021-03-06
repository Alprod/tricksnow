<?php

namespace App\DataFixtures;

use App\Entity\FigureGroup;
use Doctrine\Persistence\ObjectManager;

class GroupFigureFixtures extends BaseFixtures
{
    public const GROUP_FIGURE = [
        'Grabs',
        'Rotations',
        'Flips',
        'Rotations Désaxées',
        'Slides',
        'One Foot Tricks',
        'Old School'
    ];
    /**
     * @param ObjectManager $manager
     * @return mixed
     */
    protected function loadData(ObjectManager $manager)
    {
        $this->createMany(FigureGroup::class, 5, function(FigureGroup $figureGroup){
            $figureGroup->setTitle($this->faker->words(2, true));
        });

        $manager->flush();
    }

}
