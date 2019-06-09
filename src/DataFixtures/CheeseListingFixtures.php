<?php

namespace App\DataFixtures;

use App\Entity\CheeseListing;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class CheeseListingFixtures extends Fixture
{
    /**
     * @var Generator
     */
    private $faker;

    public function __construct()
    {
        $this->faker = Factory::create();
    }

    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 10000; $i++) {
            $cheese = (new CheeseListing($this->faker->sentence(3)))
                ->setDescription($this->faker->paragraph)
                ->setPrice($this->faker->numberBetween(100, 5000));

            $manager->persist($cheese);
        }

        $manager->flush();
    }
}
