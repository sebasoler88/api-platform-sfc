<?php

namespace App\DataFixtures;

use App\Entity\CheeseListing;
use App\Entity\User;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class CheeseListingFixture extends BaseFixture implements DependentFixtureInterface
{

    public function loadData(ObjectManager $manager)
    {
        $this->createMany(1000, function () {
            $cheese = (new CheeseListing($this->faker->sentence(3)))
                ->setDescription($this->faker->paragraph)
                ->setPrice($this->faker->numberBetween(100, 5000));

            /** @var User $owner */
            $owner = $this->getReference(User::class . '_' . random_int(0, 9));

            return $cheese->setOwner($owner);
        });

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixture::class,
        ];
    }
}
