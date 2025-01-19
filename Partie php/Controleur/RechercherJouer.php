<?php

namespace Controleur;
use DAO\JouerDAO;
use Modele\Jouer;
class RechercherJouer {

    private $jouerDAO;
    private $n_licence;
    private $id_match;

    /**
     * Le constructeur permet d'initialiser la classe avec les données nécessaires : l'objet DAO, le n° de licence du joueur et l'ID du match.
     *
     * @param JouerDAO $jouerDAO L'objet JouerDAO qui permettra d'effectuer des opérations sur la base de données des joueurs.
     * @param int $n_licence Le numéro de licence du joueur recherché.
     * @param int $id_match L'ID du match recherché.
     */
    public function __construct(JouerDAO $jouerDAO, $n_licence, $id_match) {
        $this->jouerDAO = $jouerDAO;
        $this->n_licence = $n_licence;
        $this->id_match = $id_match;
    }

     // Méthode exécutant la recherche d'un enregistrement 'Jouer'
    /**
     * Cette méthode recherche un enregistrement 'Jouer' dans la base de données en fonction du n° de licence du joueur et de l'ID du match.
     * Si l'enregistrement est trouvé, un objet Jouer est retourné ; sinon, la méthode retourne null.
     *
     * @return Jouer|null Retourne l'objet 'Jouer' si trouvé, ou null si aucun enregistrement n'est trouvé.
     */
    public function executer(): ?Jouer {
        return $this->jouerDAO->findById($this->n_licence, $this->id_match);
    }
}
?>
