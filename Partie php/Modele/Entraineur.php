<?php

namespace Modele;
class Entraineur {

    private String $id;
    private String $nom;
    private String $prenom;
    private String $password;
    private AuthentifierUtilisateur $authentifierUtilisateur;


    public function __construct($id, $nom, $prenom) {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function getPrenom(): string
    {
        return $this->prenom;
    }

}
?>