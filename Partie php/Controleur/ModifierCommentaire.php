<?php
namespace Controleur;
use DAO\CommentaireDAO;
class ModifierCommentaire {

    private $commentaireDAO;  // L'objet CommentaireDAO, utilisé pour interagir avec la base de données des commentaires
    private $n_licence;       // Le numéro de licence du joueur qui a écrit le commentaire
    private $date_com;        // La date du commentaire
    private $commentaire;     // Le contenu du commentaire

    /**
     * Constructeur de la classe ModifierCommentaire.
     * Ce constructeur initialise les propriétés avec les valeurs du commentaire à modifier.
     *
     * @param CommentaireDAO $commentaireDAO L'objet CommentaireDAO utilisé pour effectuer des opérations sur la base de données des commentaires
     * @param Commentaire $commentaire L'objet Commentaire contenant les informations du commentaire à modifier
     */
    public function __construct(CommentaireDAO $commentaireDAO, Commentaire $commentaire) {
        $this->commentaireDAO = $commentaireDAO;
        $this->n_licence = $commentaire->getN_licence();
        $this->date_com = $commentaire->getDate_com();
        $this->commentaire = $commentaire->getCommentaire();
    }

     /**
     * Méthode pour exécuter la mise à jour du commentaire dans la base de données.
     * Elle appelle la méthode `update` de l'objet CommentaireDAO pour effectuer la mise à jour du commentaire.
     */
    public function executer() {
        $this->commentaireDAO->update(
            $this->n_licence,
            $this->date_com,
            $this->commentaire
        );
    }
}
?>
