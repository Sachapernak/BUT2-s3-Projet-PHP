<?php
namespace Controleur;
use DAO\JoueurDAO;
use Modele\Joueur;
class ModifierJoueur
{

    // définition des attributs 
    private $joueurDAO;       // L'objet JoueurDAO, utilisé pour interagir avec la base de données des joueurs
    private $n_licence;       // Le numéro de licence du joueur
    private $nom;             // Le nom du joueur
    private $prenom;          // Le prénom du joueur
    private $taille;          // La taille du joueur
    private $poids;           // Le poids du joueur
    private $statut;          // Le statut du joueur (par exemple, actif ou inactif)
    private $date_naissance;  // La date de naissance du joueur

    /**
     * Constructeur de la classe ModifierJoueur.
     * Ce constructeur initialise les propriétés avec les valeurs d'un objet Joueur
     * afin de pouvoir effectuer la mise à jour des informations du joueur dans la base de données.
     *
     * @param JoueurDAO $joueurDAO L'objet JoueurDAO utilisé pour effectuer des opérations sur la base de données des joueurs
     * @param Joueur $joueur L'objet Joueur contenant les informations du joueur à modifier
     */
    public function __construct(JoueurDAO $joueurDAO, Joueur $joueur)
    {
        $this->joueurDAO = $joueurDAO;
        $this->n_licence = $joueur->getN_licence();
        $this->nom = $joueur->getNom();
        $this->prenom = $joueur->getPrenom();
        $this->date_naissance = $joueur->getDate_de_naissance();
        $this->taille = $joueur->getTaille();
        $this->poids = $joueur->getPoids();
        $this->statut = $joueur->getStatut();

    }

    /**
     * Méthode pour exécuter la mise à jour des informations du joueur dans la base de données.
     * Cette méthode appelle la méthode `update` de l'objet JoueurDAO pour effectuer la mise à jour.
     */
    public function executer()
    {
        $this->joueurDAO->update($this->n_licence, $this->nom, $this->prenom, $this->taille, $this->poids, $this->statut, $this->date_naissance);
    }
}
?>