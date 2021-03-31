<?php


namespace App\DataFixtures;



use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends BaseFixtures
{
    public const DEFAULT_USER = [
                        'email'=>'alain@gmail.com',
                        'password'=>'Password43',
                        'firstname'=>'Alain',
                        'lastname'=>'Default User'
    ];

    private UserPasswordEncoderInterface $_encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->_encoder = $encoder;
    }

    protected function loadData(ObjectManager $manager)
    {
        $defaultUser = new User();
        $passHash = $this->_encoder->encodePassword($defaultUser, self::DEFAULT_USER['password']);

        $defaultUser->setEmail(self::DEFAULT_USER['email'])
            ->setPassword($passHash)
            ->setFirstname(self::DEFAULT_USER['firstname'])
            ->setRoles(['ROLE_ADMIN'])
            ->setLastname(self::DEFAULT_USER['lastname']);

        $manager->persist($defaultUser);

        $this->createMany(User::class, 4, function(User $users) {
            $passHash = $this->_encoder->encodePassword($users, 'password');
            $users->setAvatar($this->faker->imageUrl(90, 90))
                ->setEmail($this->faker->freeEmail)
                ->setPassword($passHash)
                ->setFirstname($this->faker->firstName)
                ->setLastname($this->faker->lastName)
                ->setRoles(['ROLE_USER'])
                ->setCreatedAt($this->faker->dateTimeBetween('-1 years'));


        });
        $manager->flush();
    }
}