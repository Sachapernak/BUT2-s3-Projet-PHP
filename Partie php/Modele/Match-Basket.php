<?php 
	class Match_Basket { 
        
        private $id_match;
		private $date_et_heure;
		private $adversaire;
		private $lieu;
		private $resultat;


		public function __construct($date_et_heure, $adversaire, $lieu, $resultat=null) { 
            $this->date_et_heure = $date_et_heure;
            $this->adversaire = $adversaire;
            $this->lieu = $lieu;
            $this->resultat = $resultat;
		} 

        public function getIdMatch() {
            return $this->id_match;
        }

        public function getDate_et_heure(): DateTime {
            return $this->date_et_heure;
        }

        public function getAdversaire(): string {
            return $this->adversaire;
        }

        public function getlieu(): string {
            return $this->lieu;
        }

        public function getResultat(): string {
            return $this->resultat;
        }


        public function setResultat($resultat): void  {
            $this->resultat = $resultat;
        }

        public function setDate_et_heure(DateTime $date_et_heure): void {
            $this->date_et_heure = $date_et_heure;
        }
        public function setAdversaire(string $adversaire): void {
            $this->adversaire = $adversaire;
        }
        public function setlieu(string $lieu): void {
            $this->lieu = $lieu;
        }
        

	} 
?>