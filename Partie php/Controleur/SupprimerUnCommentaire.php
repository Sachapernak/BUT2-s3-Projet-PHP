<?php
namespace Controleur;

use DAO\CommentaireDAO;
class SupprimerUnCommentaire
{

    private $commentaireDAO;
    private $n_licence;
    private $date_com;

    /**
     * Constructeur de la classe. Initialise les attributs avec les valeurs passées en paramètre.
     *
     * @param CommentaireDAO $commentaireDAO Instance de CommentaireDAO pour effectuer des requêtes sur la base de données des commentaires
     * @param string $n_licence Le numéro de licence du joueur auquel le commentaire est associé
     * @param string $date_com La date du commentaire à supprimer
     */
    public function __construct(CommentaireDAO $commentaireDAO, $n_licence, $date_com)
    {
        $this->commentaireDAO = $commentaireDAO;
        $this->n_licence = $n_licence;
        $this->date_com = $date_com;
    }

    /**
     * Exécute la suppression du commentaire du joueur pour une date donnée.
     *
     * @return bool Retourne true si la suppression du commentaire a réussi, false sinon
     */
    public function executer(): bool
    {
        return $this->commentaireDAO->delete($this->n_licence, $this->date_com);
    }
}
?>