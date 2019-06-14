<?php

namespace App\DataFixtures;

use App\Entity\CheeseListing;
use Doctrine\Common\Persistence\ObjectManager;

class CheeseListingFixture extends BaseFixture
{

    public function loadData(ObjectManager $manager)
    {
        $this->createMany(1000, function () {
            return (new CheeseListing($this->faker->sentence(3)))
                ->setDescription($this->faker->paragraph)
                ->setPrice($this->faker->numberBetween(100, 5000));
        });

        $manager->flush();
    }
}
