<?php

namespace App\DataFixtures;

use App\Entity\Brand;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BrandFixtures extends Fixture
{
    public const BRAND = [
        'Avid',
        'Steinberg',
        'Apple',
        'Shure',
        'Neumann',
        'Rode',
        'Gibson',
        'Fender',
        'Lâg',
        'Aria Pro II',
        'Ibanez',
        'Squier',
        'Epiphone',
        'Roland',
        'Yamaha',
        'DW',
        'Premier',
        'Nord',
        'Steinways & sons',
        'Kawai',
        'Marshall',
        'Blackstar',
        'Ampeg',
        'Orange',
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::BRAND as $brandName) {
            $brand = new Brand();
            $brand->setName($brandName);

            $manager->persist($brand);
            $this->addReference('brand_' . $brandName, $brand);
        }

        $manager->flush();
    }
}
