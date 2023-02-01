<?php

namespace App\DataFixtures;

use App\Entity\Equipment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class EquipmentFixtures extends Fixture implements DependentFixtureInterface
{
    public const EQUIPMENT = [
        [
            'category' => 'category_Guitare',
            'brand' => 'brand_Gibson',
            'model' => 'LesPaul 2010',
            'type' => 'type_électrique',
            'description' => 'Une vraie guitare pour envoyer des riffs de rock !',
            'picture' => 'assets/images/gibson-lespaul.jpeg',
        ],
        [
            'category' => 'category_Guitare',
            'brand' => 'brand_Fender',
            'model' => '70’s Pawn Shop Stratocaster Deluxe',
            'type' => 'type_électrique',
            'description' => 'Un son clean d\'une clarté exceptionnelle !',
            'picture' => 'assets/images/fender-strat.jpeg',
        ]
    ];

    public static int $equipmentIndex = 0;

    public function load(ObjectManager $manager): void
    {
        foreach (self::EQUIPMENT as $equip) {
            $equipment = new Equipment();
            $equipment->setCategory($this->getReference($equip['category']));
            $equipment->setBrand($this->getReference($equip['brand']));
            $equipment->setModel($equip['model']);
            $equipment->setType($this->getReference($equip['type']));
            $equipment->setDescription($equip['description']);
            $equipment->setPicture($equip['picture']);

            $manager->persist($equipment);
            $this->addReference('equipment_' . self::$equipmentIndex, $equipment);
            self::$equipmentIndex++;
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            CategoryFixtures::class,
            BrandFixtures::class,
            TypeFixtures::class,
        ];
    }
}
