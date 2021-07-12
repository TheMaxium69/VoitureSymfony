<?php

namespace App\Controller;

use App\DataFixtures\VoitureFixture;
use App\Repository\VoitureRepository;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use http\Url;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Voiture;

class VoitureController extends AbstractController
{
    /**
     * @Route("/voiture", name="indexVoiture")
     */
    public function index(VoitureRepository $repository): Response
    {
        $voitures = $repository->findAll();

        return $this->render('voiture/index.html.twig', [
            'nosVoitures' => $voitures
        ]);
    }


    /**
     * @Route("/voiture/{id}", name="showVoiture", requirements={"id":"\d+"})
     */
    public function show(Voiture $voiture, $id): Response
    {

        return $this->render('voiture/show.html.twig', [
            'uneVoiture' => $voiture
        ]);
    }

    /**
     * @Route("/voiture/new/", name="newVoiture")
     */
    public function new(Request $laRequete, EntityManagerInterface $manager) : Response
    {
        if ($laRequete->request->count() > 0) {
            $newVoiture = new Voiture();
            $newVoiture->setName($laRequete->request->get('name'));
            $newVoiture->setBrand($laRequete->request->get('brand'));
            $newVoiture->setPrice($laRequete->request->get('price'));
            $newVoiture->setCreatedAt(new \DateTime());
            $manager->persist($newVoiture);
            $manager->flush();

            return $this->redirect('http://localhost:8000/voiture');
        } else {
            return $this->render('voiture/new.html.twig');
        }
    }
}


