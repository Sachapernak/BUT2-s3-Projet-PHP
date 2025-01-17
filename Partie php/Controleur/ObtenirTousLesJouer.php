<?php
namespace Controleur;
use DAO\JouerDAO;
class ObtenirTousLesJouer
{

    private $jouerDAO;

    /**
     * Constructeur de la classe ObtenirTousLesJouer.
     * Ce constructeur initialise la propriété $jouerDAO avec l'objet JouerDAO
     * qui permet d'effectuer des opérations sur la table ou entité 'Jouer'.
     *
     * @param JouerDAO $jouerDAO L'objet JouerDAO permettant d'interagir avec les données de la table 'Jouer'
     */
    public function __construct(JouerDAO $jouerDAO)
    {
        $this->jouerDAO = $jouerDAO;
    }

    /**
     * Méthode pour exécuter l'obtention de tous les enregistrements de la table 'Jouer'.
     * Cette méthode appelle la méthode `findAll` du JouerDAO pour récupérer tous les enregistrements.
     *
     * @return array Un tableau contenant tous les enregistrements de la table 'Jouer'
     */
    public function executer(): array
    {
        return $this->jouerDAO->findAll();
    }
}
?>