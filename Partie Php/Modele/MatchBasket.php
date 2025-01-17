<?php 
    namespace Modele;
    use DateTime;
	class MatchBasket { 
        
        private $id_match;
		private $date_et_heure;
		private $adversaire;
		private $lieu;
		private $resultat;


		public function __construct($date_et_heure , $adversaire, $lieu, $id_match= null, $resultat=null) { 
            $this->id_match = $id_match;
            $this->date_et_heure = $date_et_heure;
            $this->adversaire = $adversaire;
            $this->lieu = $lieu;
            $this->resultat = $resultat;
		} 
         public function getIdMatch(): int {
            return $this->id_match;
        }

        public function getDate_et_heure(){
            return $this->date_et_heure;
        }

        public function getDate(): string {
            $dateTime = new DateTime($this->date_et_heure);
            return $dateTime->format('Y-m-d'); 
        }
    
        // Getter pour récupérer uniquement l'heure
        public function getHeure(): string {
            $dateTime = new DateTime($this->date_et_heure);
            return $dateTime->format('H:i'); 
        }

        public function getAdversaire(): string {
            return $this->adversaire;
        }

        public function getLieu(): string {
            return $this->lieu;
        }

        public function getResultat(): string|null {
            return $this->resultat;
        }


        public function setResultat($resultat): void  {
            $this->resultat = $resultat;
        }

        public function setDate_et_heure($date_et_heure): void {
            $this->date_et_heure = $date_et_heure;
        }
        public function setAdversaire(string $adversaire): void {
            $this->adversaire = $adversaire;
        }
        public function setlieu(string $lieu): void {
            $this->lieu = $lieu;
        }

        public function setIdMatch(int $id_match): void {
            $this->id_match = $id_match;
        }
        

	} 
?>