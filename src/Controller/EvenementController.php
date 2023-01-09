<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Repository\EvenementRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EvenementController extends AbstractController
{
    public function __construct(
        private EvenementRepository $evenementRepository,
        private SerializerInterface $serializer,
        private  $errors = [],
    ) {
    }


    #[Route('/evenement/create', name: 'evenement_create', methods: 'POST')]
    public function index(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        // vérification des données reçues
        if (!$data) {
            $errors[] = "Aucune donnée reçue";
        }

        if (!isset($data['nom'])) {
            $errors[] = "Le nom de l'événement est obligatoire";
        }

        if (!isset($data['dateDebut'])) {
            $errors[] = "La date de début de l'événement est obligatoire";
        }

        if (!isset($data['dateFin'])) {
            $errors[] = "La date de fin de l'événement est obligatoire";
        }

        if (!isset($data['description'])) {
            $errors[] = "La description de l'événement est obligatoire";
        }

        if (!isset($data['lieu'])) {
            $errors[] = "Le lieu de l'événement est obligatoire";
        }

        // s'il y a une erreur, on retourne un code 400
        if (count($errors) > 0) {
            return $this->json($errors, Response::HTTP_BAD_REQUEST);
        }

        $evenement = $this->serializer->deserialize(
            $data,
            Evenement::class,
            'json',
            ['groups' => 'evenement:write']
        );

        $this->evenementRepository->save($evenement);

        return $this->json($evenement, Response::HTTP_CREATED, [], ['groups' => 'evenement:read']);
    }

    #[Route('/evenement/all', name: 'evenement_list', methods: 'GET')]
    public function list(): JsonResponse
    {
        $evenements = $this->evenementRepository->findAll();

        if (!$evenements) {
            $errors[] = "Aucun evenement trouvé";
        }

        if (count($errors) > 0) {
            return $this->json($errors, Response::HTTP_BAD_REQUEST);
        }

        return $this->json($evenements, Response::HTTP_OK, [], ['groups' => 'evenement:read']);
    }

    #[Route('/evenement/{id}', name: 'evenement_one', methods: 'GET')]
    public function one(int $id): JsonResponse
    {
        $evenement = $this->evenementRepository->findOneBy(['id' => $id]);
        if (!$evenement) {
            $errors[] = "Aucun evenement trouvé pour l'id $id";
        }

        if (count($errors) > 0) {
            return $this->json($errors, Response::HTTP_NOT_FOUND);
        }

        return $this->json($evenement, Response::HTTP_OK, [], ['groups' => 'evenement:read']);
    }

    #[Route('/evenement/{id}', name: 'evenement_update', methods: 'PUT')]
    public function update(int $id, Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        // vérification des données reçues
        if (!$data) {
            $errors[] = "Aucune donnée reçue";
        }

        $evenement = $this->evenementRepository->findOneBy(['id' => $id]);

        if (!$evenement) {
            $errors[] = "Aucun evenement trouvé pour l'id $id";
        }

        if (count($errors) > 0) {
            return $this->json($errors, Response::HTTP_BAD_REQUEST);
        }

        $evenement->setNom($data['nom']);
        $evenement->setDateDebut(new \DateTime($data['dateDebut']));
        $evenement->setDateFin(new \DateTime($data['dateFin']));
        $evenement->setDescription($data['description']);
        $evenement->setLieu($data['lieu']);

        $this->evenementRepository->save($evenement);

        return $this->json($evenement, Response::HTTP_OK, [], ['groups' => 'evenement:read']);
    }

    #[Route('/evenement/{id}', name: 'evenement_delete', methods: 'DELETE')]
    public function delete(int $id): JsonResponse
    {
        $evenement = $this->evenementRepository->findOneBy(['id' => $id]);

        if (!$evenement) {
            $errors[] = "Aucun evenement trouvé pour l'id $id";
        }

        if (count($errors) > 0) {
            return $this->json($errors, Response::HTTP_BAD_REQUEST);
        }

        $this->evenementRepository->remove($evenement);

        return $this->json(null, Response::HTTP_NO_CONTENT);
    }
}
