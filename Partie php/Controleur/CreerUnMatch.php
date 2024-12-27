<?php 
    class CreerUnMatch { 

        private $matchDAO;
        private $date_et_heure;
        private $adversaire;
        private $lieu;
        private $resultat;

        public function __construct($match) { 
            $this->matchDAO = new MatchDAO();
            $this->date_et_heure = $match->getDate_et_heure();
            $this->adversaire = $match->getAdversaire();
            $this->lieu = $match->getlieu();
            $this->resultat = $match->getResultat();
        } 

        public function executer() {
            $this->matchDAO->insert(
                $this->date_et_heure,
                $this->adversaire,
                $this->lieu,
                $this->resultat
            );
        }
    } 
?>
