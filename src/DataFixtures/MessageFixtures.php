<?php

namespace App\DataFixtures;

use App\Entity\Message;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\DataFixtures\UserFixtures as Users;

class MessageFixtures extends Fixture implements DependentFixtureInterface
{
    public const MESSAGE_REFERENCE = 'message';

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        for ($msg = 1; $msg <= 3; $msg++) {
            $message = new Message();
            $authors = $this->getReference(Users::USER_REFERENCE);
            $message->setContenu(
                $faker->boolean ? $faker->realText(500, 3) : $faker->realText(10, 3))
                ->setAuthorMsg($authors)
                ->setCreatedAt($faker->dateTimeBetween('-10 months'));

            $this->setReference(self::MESSAGE_REFERENCE, $message);

            $manager->persist($message);
        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            Users::class
        ];
    }
}
