<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Repository\EvenementRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\SerializerInterface;

class EvenementController extends AbstractController
{
    public function __construct(
        private EvenementRepository $evenementRepository,
        private SerializerInterface $serializer
    ) {
    }


    #[Route('/evenement/create', name: 'evenement_create', methods: 'POST')]
    public function index(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $evenement = $this->serializer->deserialize(
            $data,
            Evenement::class,
            'json',
            ['groups' => 'evenement:write']
        );

        $this->evenementRepository->save($evenement);

        return $this->json($evenement, 201, [], ['groups' => 'evenement:read']);
    }

    #[Route('/evenement/all', name: 'evenement_list', methods: 'GET')]
    public function list(): JsonResponse
    {
        $evenements = $this->evenementRepository->findAll();

        return $this->json($evenements, 200, [], ['groups' => 'evenement:read']);
    }

    #[Route('/evenement/{id}', name: 'evenement_one', methods: 'GET')]
    public function one(int $id): JsonResponse
    {
        $evenement = $this->evenementRepository->findOneBy(['id' => $id]);

        return $this->json($evenement, 200, [], ['groups' => 'evenement:read']);
    }

    #[Route('/evenement/{id}', name: 'evenement_update', methods: 'PUT')]
    public function update(int $id, Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $evenement = $this->evenementRepository->findOneBy(['id' => $id]);

        $evenement->setNom($data['nom']);
        $evenement->setDateDebut(new \DateTime($data['dateDebut']));
        $evenement->setDateFin(new \DateTime($data['dateFin']));
        $evenement->setDescription($data['description']);
        $evenement->setLieu($data['lieu']);

        $this->evenementRepository->save($evenement);

        return $this->json($evenement, 200, [], ['groups' => 'evenement:read']);
    }

    #[Route('/evenement/{id}', name: 'evenement_delete', methods: 'DELETE')]
    public function delete(int $id): JsonResponse
    {
        $evenement = $this->evenementRepository->findOneBy(['id' => $id]);

        $this->evenementRepository->remove($evenement);

        return $this->json(null, 204);
    }
}
