<?php


namespace App\DataFixtures;



use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture implements OrderedFixtureInterface
{
    public const USER_REFERENCE = 'author';
    public const DEFAULT_USER = [
                        'email'=>'alain@orange.fr',
                        'password'=>'Password43',
                        'firstname'=>'Alain',
                        'lastname'=>'Default User'
    ];

    private UserPasswordEncoderInterface $_encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->_encoder = $encoder;
    }

    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        $defaultUser = new User();
        $passHash = $this->_encoder->encodePassword($defaultUser, self::DEFAULT_USER['password']);

        $defaultUser->setEmail(self::DEFAULT_USER['email'])
            ->setPassword($passHash)
            ->setFirstname(self::DEFAULT_USER['firstname'])
            ->setLastname(self::DEFAULT_USER['lastname']);

        $manager->persist($defaultUser);

        for ($user = 0; $user <= 10; ++$user) {
            $users = new User();
            $passHash = $this->_encoder->encodePassword($users, 'Password34');

            $users->setAvatar($faker->imageUrl(90, 90))
                ->setEmail($faker->freeEmail)
                ->setPassword($passHash)
                ->setFirstname($faker->firstName)
                ->setLastname($faker->lastName)
                ->setCreatedAt($faker->dateTimeBetween('-1 years'));

            $this->setReference(self::USER_REFERENCE, $users);

            $manager->persist($users);

        }
        $manager->flush();
    }

    public function getOrder(): int
    {
        return 1;
    }
}