<?php


namespace App\DataFixtures;


use App\Entity\Discussion;
use App\Entity\Figure;
use App\Entity\GroupFigure;
use App\Entity\Image;
use App\Entity\Message;
use App\Entity\User;
use App\Entity\Video;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    public const USER_REFERENCE = 'page';
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
        $faker->addProvider(new \Faker\Provider\Youtube($faker));
        $defaultUser = new User();
        $passHash = $this->_encoder->encodePassword($defaultUser, self::DEFAULT_USER['password']);

        $defaultUser->setEmail(self::DEFAULT_USER['email'])
            ->setPassword($passHash)
            ->setFirstname(self::DEFAULT_USER['firstname'])
            ->setLastname(self::DEFAULT_USER['lastname']);

        $manager->persist($defaultUser);

        for ($group_figure = 1; $group_figure <= 5; $group_figure++) {
            $groupFigure = (new GroupFigure())->setTitle($faker->words(2, true));

            $manager->persist($groupFigure);
        }

        for ($user = 0; $user <= 10; ++$user) {
            $users = new User();
            $passHash = $this->_encoder->encodePassword($users, 'Password34');


            $users->setAvatar($faker->imageUrl(90, 90))
                ->setEmail($faker->freeEmail)
                ->setPassword($passHash)
                ->setFirstname($faker->firstName)
                ->setLastname($faker->lastName)
                ->setCreatedAt($faker->dateTimeBetween('-1 years'));

            $manager->persist($users);


                for ($figs = 0; $figs <= random_int(1, 3); ++$figs) {
                    $figures = new Figure();
                    $days = (new \DateTime())->diff($users->getCreatedAt())->days;
                    $figures->setAuthor($users)
                            ->setTitle($faker->word)
                            ->setDescription($faker->realText(800, 2))
                            ->setCreatedAt($faker->dateTimeBetween('-' . $days . ' days'));

                    $discussions = (new Discussion())
                        ->setArticles($figures);

                    $manager->persist($figures);
                    $manager->persist($discussions);

                    for ($msg = 1; $msg <= 3; $msg++) {
                        $message = new Message();
                        $message->setContenu($faker->realText(300, 3))
                                ->setAuthorMsg($users)
                                ->setDiscussion($discussions)
                                ->setCreatedAt($faker->dateTimeBetween('-3 months'));

                        $manager->persist($message);
                    }

                    for ($img = 1; $img <= 5; $img++) {
                        $images = (new Image())->setTitle($faker->sentence(3))
                                               ->setLink($faker->image(null, 500, 350))
                                               ->setFigures($figures)
                                               ->setCreatedAt($figures->getCreatedAt());

                        $manager->persist($images);
                    }

                    for ($video = 1; $video <= 3; $video++) {
                        $videos = (new Video())->setTitle($faker->sentence(3))
                                               ->setLink($faker->youtubeEmbedUri())
                                               ->setFigures($figures);

                        $manager->persist($videos);
                    }
                }
        }
        $manager->flush();
    }
}