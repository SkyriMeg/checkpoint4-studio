<?php

namespace App\Controller;

use App\Entity\Equipment;
use App\Form\EquipmentType;
use App\Repository\EquipmentRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/equipment')]
class EquipmentController extends AbstractController
{
    #[Route('/', name: 'app_equipment_presentation', methods: ['GET'])]
    public function presentation(EquipmentRepository $equipmentRepository): Response
    {
        $equipments = $equipmentRepository->findAll();
        //@TODO RECUPERER LES IMAGES DE LA BDD POUR LES AFFICHER
        // Récupération de l'entité contenant l'image à partir de la base de données
        //$image = $this->getDoctrine()
        //    ->getRepository(Equipment::class)
        //    ->findAll();

        // Stockage des données de l'image dans une variable
        //$imageData = base64_encode($image->getData());


        return $this->render('equipment/presentation.html.twig', [
            'website' => 'Meg Studio',
            'equipments' => $equipments,
            //'image' => $imageData,
        ]);
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/index', name: 'app_equipment_index', methods: ['GET'])]
    public function index(EquipmentRepository $equipmentRepository): Response
    {
        $equipments = $equipmentRepository->findAll();

        return $this->render('admin/equipment/index.html.twig', [
            'website' => 'Meg Studio',
            'equipments' => $equipments,
        ]);
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/new', name: 'app_equipment_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EquipmentRepository $equipmentRepository): Response
    {
        $equipment = new Equipment();
        $form = $this->createForm(EquipmentType::class, $equipment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $equipmentRepository->save($equipment, true);
            $this->addFlash('success', 'L\'équipement a bien été ajouté !');

            return $this->redirectToRoute('app_equipment_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/equipment/new.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/{equipmentId}', name: 'app_equipment_show', methods: ['GET'])]
    public function show(Equipment $equipmentId): Response
    {
        return $this->render('equipment/show.html.twig', [
            'equipment' => $equipmentId,
        ]);
    }

    //@TODO Créer les pages par catégorie
    //#[Route('/softwares', name: 'app_equipment_show_softwares', methods: ['GET'])]
    //public function softwares_pres(EquipmentRepository $equipmentRepository): Response
    //{
    //    $equipments = $equipmentRepository->findAll();
    //    return $this->render('equipment/softwares_pres.html.twig', [
    //        'equipments' => $equipments,
    //    ]);
    //}

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/{id}/edit', name: 'app_equipment_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Equipment $equipment, EquipmentRepository $equipmentRepository): Response
    {
        $form = $this->createForm(EquipmentType::class, $equipment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $equipmentRepository->save($equipment, true);

            return $this->redirectToRoute('app_equipment_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/equipment/edit.html.twig', [
            'equipment' => $equipment,
            'form' => $form,
        ]);
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/{id}', name: 'app_equipment_delete', methods: ['POST'])]
    public function delete(Request $request, Equipment $equipment, EquipmentRepository $equipmentRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $equipment->getId(), $request->request->get('_token'))) {
            $equipmentRepository->remove($equipment, true);
        }

        return $this->redirectToRoute('app_equipment_index', [], Response::HTTP_SEE_OTHER);
    }
}
