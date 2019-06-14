<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixture extends BaseFixture
{

    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function loadData(ObjectManager $manager)
    {
        $this->createMany(10, function () {
            $user = (new User)
                ->setEmail($this->faker->email)
                ->setUsername($this->faker->userName);

            $user->setPassword($this->encoder->encodePassword(
                $user,
                'secret'
            ));

            return $user;
        });

        $manager->flush();
    }
}
