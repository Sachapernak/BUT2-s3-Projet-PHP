<?php
namespace Controleur;
use DAO\JouerDAO;
use Modele\Jouer;
class ModifierAttributsJouer {

    private $jouerDAO;           // L'objet JouerDAO, utilisé pour interagir avec la base de données des joueurs
    private $n_licence;          // Le numéro de licence du joueur
    private $id_matchs;          // L'ID du match auquel le joueur a participé
    private $est_remplacant;     // Statut indiquant si le joueur est remplaçant ou titulaire
    private $note;               // La note attribuée au joueur après le match
    private $role;               // Le rôle du joueur durant le match (par exemple, défenseur, attaquant)


    /**
     * Constructeur de la classe ModifierAttributsJouer.
     * Ce constructeur initialise les propriétés avec les valeurs du joueur et de la participation au match.
     *
     * @param JouerDAO $jouerDAO L'objet JouerDAO utilisé pour effectuer des opérations sur la base de données des joueurs
     * @param Jouer $jouer L'objet Jouer contenant les informations de la participation d'un joueur à un match
     */
    public function __construct(JouerDAO $jouerDAO, Jouer $jouer) {
        $this->jouerDAO = $jouerDAO;
        $this->n_licence = $jouer->getN_licence();
        $this->id_matchs = $jouer->getId_match();
        $this->est_remplacant = $jouer->getEst_remplacant();
        $this->note = $jouer->getNote();
        $this->role = $jouer->getRole();
    }

      /**
     * Méthode pour exécuter la mise à jour des informations du joueur dans la base de données.
     * Elle appelle la méthode `update` de l'objet JouerDAO pour effectuer la mise à jour des attributs du joueur.
     */
    public function executer() {
        $this->jouerDAO->update(
            $this->n_licence,
            $this->id_matchs,
            $this->est_remplacant,
            $this->note,
            $this->role
        );
    }
}
?>
