<?php
namespace Modele;
class Jouer {

    private $n_licence;
    private $id_matchs;
    private $est_remplacant;
    private $note;
    private $role;

    public function __construct($n_licence, $id_matchs, $est_remplacant, $note, $role) {
        $this->n_licence = $n_licence;
        $this->id_matchs = $id_matchs;
        $this->est_remplacant = $est_remplacant;
        $this->note = $note;
        $this->role = $role;
    }

    public function getN_licence() {
        return $this->n_licence;
    }

    public function getId_matchs() {
        return $this->id_matchs;
    }

    public function getEst_remplacant() {
        return $this->est_remplacant;
    }

    public function getNote() {
        return $this->note;
    }

    public function getRole() {
        return $this->role;
    }

    public function setN_licence($n_licence) {
        $this->n_licence = $n_licence;
    }

    public function setId_matchs($id_matchs) {
        $this->id_matchs = $id_matchs;
    }

    public function setEst_remplacant($est_remplacant) {
        $this->est_remplacant = $est_remplacant;
    }

    public function setNote($note) {
        $this->note = $note;
    }

    public function setRole($role) {
        $this->role = $role;
    }

}
?>
