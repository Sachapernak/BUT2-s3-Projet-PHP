<?php
namespace Controleur;
use DAO\JouerDAO;

class RechercherJouerParMatch {

    // Définition des attributs
    private $jouerDAO;
    private $id_matchs;

    // Définition du constructeur
    public function __construct(JouerDAO $jouerDAO, $id_matchs) {
        $this->jouerDAO = $jouerDAO;
        $this->id_matchs = $id_matchs;
    }

    // Exécution de la recherche par Id_Matchs
    public function executer(): array {
        return $this->jouerDAO->findByIdMatch($this->id_matchs); // Appel de la méthode du DAO
    }
}
?>
