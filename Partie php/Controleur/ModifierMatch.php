<?php
namespace Controleur;
use DAO\MatchDAO;
class ModifierMatch
{

    // définition des attributs 
    private $matchDAO;          // L'objet MatchDAO, utilisé pour interagir avec la base de données des matchs
    private $id_match;          // L'identifiant du match
    private $date_et_heure;     // La date et l'heure du match
    private $adversaire;        // L'adversaire contre lequel le match est joué
    private $lieu;              // Le lieu où le match se déroule
    private $resultat;          // Le résultat du match (victoire, défaite, nul)


    /**
     * Constructeur de la classe ModifierMatch.
     * Ce constructeur initialise les propriétés avec les valeurs d'un objet Match
     * afin de pouvoir effectuer la mise à jour des informations du match dans la base de données.
     *
     * @param MatchDAO $matchDAO L'objet MatchDAO utilisé pour effectuer des opérations sur la base de données des matchs
     * @param $match L'objet Match contenant les informations du match à modifier
     */
    public function __construct(MatchDAO $matchDAO, $match)
    {
        $this->matchDAO = $matchDAO;
        $this->id_match = $match->getIdMatch();
        $this->date_et_heure = $match->getDate_et_heure();
        $this->adversaire = $match->getAdversaire();
        $this->lieu = $match->getLieu();
        $this->resultat = $match->getResultat();
    }

    /**
     * Méthode pour exécuter la mise à jour des informations du match dans la base de données.
     * Cette méthode appelle la méthode `update` de l'objet MatchDAO pour effectuer la mise à jour.
     */
    public function executer()
    {
        $this->matchDAO->update($this->id_match, $this->date_et_heure, $this->adversaire, $this->lieu, $this->resultat);
    }
}
?>