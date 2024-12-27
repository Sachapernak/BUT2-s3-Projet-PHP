<?php
class SupprimerUnCommentaire {

    private $commentaireDAO;
    private $n_licence;
    private $date_com;

    public function __construct(CommentaireDAO $commentaireDAO, $n_licence, $date_com) {
        $this->commentaireDAO = $commentaireDAO;
        $this->n_licence = $n_licence;
        $this->date_com = $date_com;
    }

    public function executer(): bool {
        return $this->commentaireDAO->delete($this->n_licence, $this->date_com);
    }
}
?>
