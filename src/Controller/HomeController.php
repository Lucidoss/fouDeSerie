<?php

namespace App\Controller;

use App\Entity\Serie;
use App\Service\PdoFouDeSerie;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
    public function series(PdoFouDeSerie $pdoFouDeSerie): Response
    {
        $truc = $pdoFouDeSerie -> getLesSeries();
        $nombreSeries = $pdoFouDeSerie->getNbSeries();
        return $this->render('lesSeries/lesseries.html.twig', ['lesSeries' => $truc , 'nombreSeries' => $nombreSeries]);
    }

    // #[Route('/testEntity', name: 'app_testentity')]
    // public function testEntity(ManagerRegistry $doctrine): Response
    // {
    //     $serie = new Serie();
    //     $serie->setTitre('ok');
    //     $serie->setResume('ok');
    //     $serie->setDuree(new \DateTime('00:30:00'));
    //     $serie->setPremiereDiffusion(new \DateTime('01-09-2022'));
    //     $serie->setImage('');
    //     $entityManager=$doctrine->getManager();
    //     $entityManager->persist($serie);
    //     $entityManager->flush();

    //     return $this->render('home/testEntity.html.twig', ['serie' => $serie]);
    // }
}
