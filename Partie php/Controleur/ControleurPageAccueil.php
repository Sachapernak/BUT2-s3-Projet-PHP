<?php

namespace Controleur;

use DAO\DaoEntraineur;

class ControleurPageAccueil
{
    public function __construct(){

    }

    public function infoPageAccueil($idManager) : string {
        $dao = new DaoEntraineur();

        $entraineur = $dao ->getById($idManager);

        if ($entraineur == null){
            $res = "";
        } else {
            $res =  $entraineur->getPrenom() ." ". $entraineur->getNom() ;
        }
        return $res;
    }
}