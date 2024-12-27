<?php 
    class CreerUnMatch { 

        private $matchDAO;
        private $date_et_heure;
        private $adversaire;
        private $lieu;
        private $resultat;

        public function __construct(MatchDAO $matchDAO, $match) { 
            $this->matchDAO = $matchDAO;
            $this->date_et_heure = $match->getDate_et_heure();
            $this->adversaire = $match->getAdversaire();
            $this->lieu = $match->getLieu();
            $this->resultat = $match->getResultat();
        } 

        public function executer():int {
            return $this->matchDAO->insert(
                $this->date_et_heure,
                $this->adversaire,
                $this->lieu,
                $this->resultat
            );
        }
    } 
?>
