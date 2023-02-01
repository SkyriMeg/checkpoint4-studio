<?php

namespace App\Controller;

use App\Repository\ServiceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(ServiceRepository $serviceRepository): Response
    {
        $services = $serviceRepository->findAll();

        if (!$services) {
            throw $this->createNotFoundException(
                'Aucune prestation trouvée.'
            );
        }

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'website' => 'Meg Studio',
            'services' => $services,
        ]);
    }

    #[Route('/legalmentions', name: 'app_legal_mentions')]
    public function legalMentions(): Response
    {
        return $this->render('home/legal_mentions.html.twig', [
            'website' => 'Meg Studio',
        ]);
    }
}
