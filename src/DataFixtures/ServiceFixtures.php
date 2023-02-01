<?php

namespace App\DataFixtures;

use App\Entity\Service;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ServiceFixtures extends Fixture
{
    public const SERVICE = [
        [
            'name' => 'Enregistrement demi journée (4h)',
            'price' => '230',
            'details' => 'Formule d\'enregistrement sur une demi journée, ingénieur son inclus. Parfait pour peaufiner un projet ou faire un enregistrement voix seule.',
            'picture' => 'asses'
        ],
        [
            'name' => 'Enregistrement journée entière (8h)',
            'price' => '450',
            'details' => 'Formule d\'enregistrement sur une journée entière. Idéal pour le record d\'un instrument pour un EP, par exemple',
        ],
        [
            'name' => 'Enregistrement à l\'heure',
            'price' => '60',
            'details' => 'Enregistrement au détail, qui pourrait permettre des rectifications lorsque c\'est nécessaire, ou pour un ajustement du temps adapté selon les besoins.',
        ],
        [
            'name' => 'Mixage d\'un titre',
            'price' => '90',
            'details' => 'Mixage pour un seul titre. Le prix reste soumis à certaines conditions, établies avec l\'ingénieur son lors du devis.',
        ],
        [
            'name' => 'Mastering d\'un titre',
            'price' => '80',
            'details' => 'Mastering pour un seul titre. Le prix reste soumis à certaines conditions, établies avec l\'ingénieur son lors du devis.',
        ],
    ];

    public static int $serviceIndex = 0;

    public function load(ObjectManager $manager): void
    {
        foreach (self::SERVICE as $services) {
            $service = new Service();
            $service->setName($services['name']);
            $service->setPrice($services['price']);
            $service->setDetails($services['details']);
            $service->setPicture('assets/images/console-studio.webp');

            $manager->persist($service);
            $this->addReference('service_' . self::$serviceIndex, $service);
            self::$serviceIndex++;
        }

        $manager->flush();
    }
}
