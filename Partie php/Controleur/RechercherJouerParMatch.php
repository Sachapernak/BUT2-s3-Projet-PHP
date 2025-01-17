<?php
namespace Controleur;
use DAO\JouerDAO;

class RechercherJouerParMatch {

    // Définition des attributs
    private $jouerDAO;
    private $id_match;

    // Définition du constructeur
    public function __construct(JouerDAO $jouerDAO, $id_match) {
        $this->jouerDAO = $jouerDAO;
        $this->id_match = $id_match;
    }

    // Exécution de la recherche par Id_Matchs
    public function executer(): array {
        return $this->jouerDAO->findByIdMatch($this->id_match); 
    }
}
?>
