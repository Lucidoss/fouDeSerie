<?php

namespace App\Controller;

use App\Entity\Genre;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\GenreType;

class AdminGenreController extends AbstractController
{
    #[Route('/admin/genre', name: 'app_admin_genre')]
    public function addGenre(Request $request, ManagerRegistry $doctrine): Response
    {
        
        $genre = new Genre();
        $form = $this->createForm(GenreType::class, $genre,['method'=> 'PUT']);
        $form->handleRequest($request);
        if( $form->isSubmitted() && $form->isValid()){
            $em = $doctrine->getManager();
            $em -> persist($genre);
            $em -> flush();
            return $this->redirectToRoute('app_series');
        }
        
        return $this->render('admin_genre/addGenre.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    #[Route('/admin/genre/{id}', name: 'app_admin_editGenre')]
    public function editGenre(Request $request, ManagerRegistry $doctrine, $id): Response
    {
        $repository = $doctrine->getRepository(Genre::class);
        $leGenre = $repository->find($id);
        $form = $this->createForm(GenreType::class, $leGenre,['method'=> 'PUT']);
        $form->handleRequest($request);
        if( $form->isSubmitted() && $form->isValid()){
            $em = $doctrine->getManager();
            $em -> persist($leGenre);
            $em -> flush();
            return $this->redirectToRoute('app_series');
        }
        
        return $this->render('admin_genre/addGenre.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
