<?php
class RechercherJouerParJoueur {

    // Définition des attributs
    private $jouerDAO;
    private $n_licence;

    // Définition du constructeur
    public function __construct(JouerDAO $jouerDAO, $n_licence) {
        $this->jouerDAO = $jouerDAO;
        $this->n_licence = $n_licence;
    }

    // Exécution de la recherche par N_Licence
    public function executer(): array {
        return $this->jouerDAO->findByIdJoueur($this->n_licence);
    }
}
?>
