<?php 
    namespace Controleur;
    use DAO\MatchDAO;
	class ModifierMatch { 

		// définition des attributs 
		private $matchDAO;
        private $id_match;
        private $date_et_heure;
        private $adversaire;
        private $lieu;
        private $resultat;

		  
		// définition des méthodes 
		public function __construct(MatchDAO $matchDAO, $match) { 
			$this->matchDAO = $matchDAO;
            $this->id_match = $match->getIdMatch();
            $this->date_et_heure = $match->getDate_et_heure();
            $this->adversaire = $match->getAdversaire();
            $this->lieu = $match->getLieu();
            $this->resultat = $match->getResultat();
		} 
		
		public function executer(){
           $this->matchDAO->update($this->id_match, $this->date_et_heure, $this->adversaire, $this->lieu, $this->resultat);
        }
	} 
?>