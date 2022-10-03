<?php

namespace App\Service;

use PDO;

class PdoFouDeSerie
{
    private static $monPdo;
    public function __construct($serveur, $bdd, $user, $mdp)
    {
        PdoFouDeSerie::$monPdo = new PDO($serveur . ';' . $bdd, $user, $mdp);
        PdoFouDeSerie::$monPdo->query("SET CHARACTER SET utf8");
    }
    
    public function getLesSeries() {
        $req = PdoFouDeSerie::$monPdo->prepare('SELECT upper(titre) as titre,resume,duree,DATE_FORMAT(premiereDiffusion,"%d/%m/%Y") as premiereDiffusion,image from serie');
		$req->execute();
		$lesSeries = $req->fetchAll();
		return $lesSeries;
    }

    public function getNbSeries() {
        $req = PdoFouDeSerie::$monPdo->prepare('SELECT COUNT(id) as nombre FROM serie');
		$req->execute();
		$lesSeries = $req->fetch();
		return $lesSeries;
    }
}
