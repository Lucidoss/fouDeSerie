<?php

namespace App\Controller;

use App\Entity\Serie;
use App\Service\PdoFouDeSerie;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig');
    }

    #[Route('/news', name: 'app_news')]
    public function news(): Response
    {
        return $this->render('news/news.html.twig');
    }

    

    #[Route('/lesSeries', name: 'app_series')]
    public function series(ManagerRegistry $doctrine){
        $repository = $doctrine->getRepository(Serie::class);
        $lesSeries = $repository->findBy(
            [],
            ['titre' => 'ASC']
        );
        // $lesSeries = $repository->findBy(
        //     [],
        //     ['premiereDiffusion' => 'DESC'],
        //     2
        // );
        $nombreSeries = count($lesSeries);
        return $this->render('lesSeries/lesseries.html.twig', ['lesSeries'=> $lesSeries, 'nombreSeries' => $nombreSeries]);
    }

    #[Route('/lesSeries/{id}/like', name: 'app_serieslikes')]
    public function getLikeOneSerie(ManagerRegistry $doctrine, $id, EntityManagerInterface $entityManager): Response
    {
        $repository = $doctrine->getRepository(Serie::class);
        $laSerie = $repository->find($id);
        $likes = $laSerie->getLikes();
        $laSerie = $laSerie->setLikes($likes + 1);
        $likes = $laSerie->getLikes();
        $entityManager->persist($laSerie);
        $entityManager->flush();
        return new JsonResponse(['likes' => $likes]);
    }

    #[Route('/lesSeries/detail/{id}', name: 'app_detail')]
    public function detail(ManagerRegistry $doctrine, $id): Response
    {$repository = $doctrine->getRepository(Serie::class);
        $laSerie = $repository->find($id);
        return $this->render('lesSeries/detail/detail.html.twig', ['laSerie'=> $laSerie]);
    }

    // public function series(PdoFouDeSerie $pdoFouDeSerie): Response
    // {
    //     $truc = $pdoFouDeSerie->getLesSeries();
    //     $nombreSeries = $pdoFouDeSerie->getNbSeries();
    //     return $this->render('lesSeries/lesseries.html.twig', ['lesSeries' => $truc, 'nombreSeries' => $nombreSeries]);
    // }

    // #[Route('/testEntity', name: 'app_testentity')]
    // public function testEntity(ManagerRegistry $doctrine): Response
    // {
        // $serie = new Serie();
        // $serie->setTitre('ok');
        // $serie->setResume('ok');
        // $serie->setDuree('00:30:00');
        // $serie->setPremiereDiffusion(new \DateTime('01-09-2022'));
        // $serie->setImage('');
        // $entityManager = $doctrine->getManager();
        // $entityManager->persist($serie);
        // $entityManager->flush();

        // return $this->render('home/testEntity.html.twig', ['serie' => $serie]);
    // }
}
