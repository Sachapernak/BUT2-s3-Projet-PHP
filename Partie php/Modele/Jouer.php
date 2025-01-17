<?php
namespace Modele;
class Jouer {

    private $n_licence;
    private $id_match;
    private $est_remplacant;
    private $note;
    private $role;

    public function __construct($n_licence, $id_match, $est_remplacant, $note, $role) {
        $this->n_licence = $n_licence;
        $this->id_match = $id_match;
        $this->est_remplacant = $est_remplacant;
        $this->note = $note;
        $this->role = $role;
    }

    public function getN_licence() {
        return $this->n_licence;
    }

    public function getId_match() {
        return $this->id_match;
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

    public function setid_match($id_match) {
        $this->id_match = $id_match;
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
