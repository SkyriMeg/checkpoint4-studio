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
            'picture' => 'gibson-lespaul.jpg',
        ],
        [
            'category' => 'category_Guitare',
            'brand' => 'brand_Fender',
            'model' => '70’s Pawn Shop Stratocaster Deluxe',
            'type' => 'type_électrique',
            'description' => 'Un son clean d\'une clarté exceptionnelle !',
            'picture' => 'fender-strat.jpeg',
        ],
        [
            'category' => 'category_Microphone',
            'brand' => 'brand_Shure',
            'model' => 'SM58',
            'type' => 'type_dynamique',
            'description' => 'Le micro indestructible le plus polyvalent pour tout type de prise de son.',
            'picture' => 'SM58.jpg',
        ],
        [
        'category' => 'category_Batterie',
        'brand' => 'brand_Roland',
        'model' => 'TD17-KVX V-Drums',
        'type' => 'type_dynamique',
        'description' => 'Une batterie électronique fidèle au ressenti d\'une acoustique, améliorée avec de multiple fonctionnalités !',
        'picture' => 'td17-kvx.jpeg',
    ],
        [
            'category' => 'category_Logiciel',
            'brand' => 'brand_Avid',
            'model' => 'ProTools 12',
            'type' => 'type_numérique',
            'description' => 'Le top des logiciels pour les enregistrements studios professionnels.',
            'picture' => 'protools.jpeg',
        ],
        [
            'category' => 'category_Piano',
            'brand' => 'brand_Yamaha',
            'model' => 'Arius YDP-52',
            'type' => 'type_numérique',
            'description' => 'L’alliance parfaite entre une sonorité remarquable et des lignes épurées, pour une expérience unique.',
            'picture' => 'arius-ydp-s52.jpeg',
        ],
        [
            'category' => 'category_Basse',
            'brand' => 'brand_Aria Pro II',
            'model' => 'Magna Series',
            'type' => 'type_électrique',
            'description' => 'L\'Aria Pro II Series Magna a une précision intense dans les basses tout en gardant une attaque punchy dans les mediums. Assez polyvalente, elle se prêtera à la plupart de vos projets.',
            'picture' => 'magna-series.jpeg',
        ],
        [
            'category' => 'category_Amplificateur',
            'brand' => 'brand_Marshall',
            'model' => 'AS50D',
            'type' => 'type_électro-acoustique',
            'description' => 'L\'ampli Marshall AS50D est une des meilleures références en terme d\'ampli pour guitare électro-acoustique. Il délivre 50 watts de son pur et précis, et possède des réglages pour affiner le rendu selon les goûts.',
            'picture' => 'AS50D.jpeg',
        ],
        [
            'category' => 'category_Batterie',
            'brand' => 'brand_Pearl',
            'model' => 'Vision Export',
            'type' => 'type_acoustique',
            'description' => 'Superbe batterie acoustique pour un son polyvalent et puissant.',
            'picture' => 'pearl-vision-export.jpeg',
        ],
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
