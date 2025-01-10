<?php 
	class Commentaire{ 
        
        private $id_joueur;
		private $date;
		private $commentaire;


		public function __construct($id_joueur, $date, $commentaire) { 
            $this->id_joueur = $id_joueur;
            $this->date = $date;
            $this->commentaire = $commentaire;
		} 

        public function getIdJoueur() {
            return $this->id_joueur;
        }

        public function getDate(){
            return $this->date;
        }

        public function getCommentaire(): string {
            return $this->commentaire;
        }


        public function setIdJoueur($id_joueur) {
            $this->id_joueur = $id_joueur;
        }
        public function setDate($date) {
            $this->date = $date;
        }
        public function setCommentaire($commentaire) {
            $this->commentaire = $commentaire;
        }

        

	} 
?>