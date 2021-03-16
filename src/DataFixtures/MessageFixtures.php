<?php

namespace App\DataFixtures;

use App\Entity\Discussion;
use App\Entity\Message;
use App\Entity\User;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class MessageFixtures extends BaseFixtures implements DependentFixtureInterface
{

    /**
     * @param ObjectManager $manager
     * @return mixed
     * @throws \Exception
     */
    protected function loadData(ObjectManager $manager)
    {
        $this->createMany(Message::class, 20, function(Message $message){

            $message->setContenu($this->faker->paragraph(4, true))
                ->setAuthorMsg($this->getRandomReference(User::class))
                ->setDiscussion($this->getRandomReference(Discussion::class))
                ->setCreatedAt($this->faker->dateTimeBetween("-9 months"));
        });

        $manager->flush();
    }

    /**
     * @return mixed
     */
    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
            DiscussionFixtures::class
        ];
    }
}
