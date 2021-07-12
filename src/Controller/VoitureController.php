<?php

namespace App\Controller;

use App\Repository\VoitureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
        //$voitures = $repository->findAll();

        return $this->render('voiture/index.html.twig', [
            'nosVoitures' => '$voitures',
        ]);
    }
}
