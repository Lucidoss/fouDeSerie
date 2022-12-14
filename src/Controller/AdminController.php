<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Serie;
use App\Form\SerieType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends AbstractController
{
    #[Route('/admin/series', name: 'app_admin_addSerie')]
    public function addSerie(Request $request, ManagerRegistry $doctrine): Response
    {
        $serie = new Serie();
        $form = $this->createForm(SerieType::class, $serie,['method'=> 'PUT']);
        $form->handleRequest($request);
        if( $form->isSubmitted() && $form->isValid()){
            $em = $doctrine->getManager();
            $em -> persist($serie);
            $em -> flush();
            return $this->redirectToRoute('app_series');
        }
        
        return $this->render('admin/addSerie.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/admin/series/{id}', name: 'app_admin_editSerie')]
    public function editSerie(Request $request, ManagerRegistry $doctrine, $id): Response
    {
        $repository = $doctrine->getRepository(Serie::class);
        $laSerie = $repository->find($id);
        $form = $this->createForm(SerieType::class, $laSerie,['method'=> 'PUT']);
        $form->handleRequest($request);
        if( $form->isSubmitted() && $form->isValid()){
            $em = $doctrine->getManager();
            $em -> persist($laSerie);
            $em -> flush();
            return $this->redirectToRoute('app_series');
        }
        
        return $this->render('admin/addSerie.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
