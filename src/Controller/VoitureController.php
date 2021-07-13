<?php

namespace App\Controller;

use App\DataFixtures\VoitureFixture;
use App\Form\VoitureType;
use App\Repository\VoitureRepository;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
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
                'uneVoiture' => $voiture,
            ]);

    }
    /**
     * @Route("/voiture/new/", name="newVoiture")
     * @Route ("/voiture/edit/{id}", name="editVoiture")
     */
    public function new(Request $laRequete, EntityManagerInterface $manager,Voiture $voiture = null) : Response
    {

        $modeCreate = false;

        if(!$voiture) {
            $voiture = new Voiture();
            $modeCreate = true;
        }
            $form = $this->createForm(VoitureType::class, $voiture);

            $form->handleRequest($laRequete);
            if ($form->isSubmitted())
            {
                if ($modeCreate){
                    $voiture->setCreatedAt(new \DateTime());
                }

                $manager->persist($voiture);
                $manager->flush();

                return $this->redirectToRoute('showVoiture', [
                    "id" => $voiture->getId()
                ]);

            }else {
                return $this->render('voiture/new.html.twig', [
                    'formVoiture' => $form->createView(),
                    'isCreate' => $modeCreate
                ]);
            }
    }
}


