<?php
class ModifierCommentaire {

    private $commentaireDAO;
    private $n_licence;
    private $date_com;
    private $commentaire;

    public function __construct(CommentaireDAO $commentaireDAO, Commentaire $commentaire) {
        $this->commentaireDAO = $commentaireDAO;
        $this->n_licence = $commentaire->getN_licence();
        $this->date_com = $commentaire->getDate_com();
        $this->commentaire = $commentaire->getCommentaire();
    }

    public function executer() {
        $this->commentaireDAO->update(
            $this->n_licence,
            $this->date_com,
            $this->commentaire
        );
    }
}
?>
