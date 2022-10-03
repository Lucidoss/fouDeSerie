<?php

namespace App\Controller;

use App\Service\PdoFouDeSerie;
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
}
