<?php 
	namespace Modele;
	class Joueur { 
        
        private $n_licence;
		private $nom;
		private $prenom;
		private $date_de_naissance;
		private $taille;
		private $poids;
		private $statut;

		public function __construct($n_licence, $nom, $prenom, $date_de_naissance, $taille, $poids, $statut) { 
			$this->n_licence = $n_licence;
            $this->nom = $nom; 
			$this->prenom = $prenom; 
			$this->date_de_naissance = $date_de_naissance; 
			$this->taille = $taille; 
			$this->poids = $poids; 
			$this->statut = $statut;
		} 

		public function getN_licence() {
			return $this->n_licence;
        }
		public function getNom() {
			return $this->nom;
		}

		public function getPrenom() {
			return $this->prenom;
        }

		public function getDate_de_naissance() {
			return $this->date_de_naissance;
        }

		public function getTaille() {
			return $this->taille;
        }

		public function getPoids() {
			return $this->poids;
        }

		public function getStatut() {
			$intituleStatut = "";
			switch($this->statut){
				case "Act":
					$intituleStatut = "Actif";
				    break;
				case "Ble":
					$intituleStatut = "Blessé";
                    break;
                case "Abs":
					$intituleStatut = "Absent";
					break;
				case "Sus":
					$intituleStatut = "Suspendu";
                    break;
			}
			return $intituleStatut;
		}

		public function setNom($nom) {
			$this->nom = $nom;
        }

		public function setPrenom($prenom) {
			$this->prenom = $prenom;
        }

		public function setDate_de_naissance($date_de_naissance) {
            $this->date_de_naissance = $date_de_naissance;
        }
		public function setTaille($taille) {
            $this->taille = $taille;
        }

		public function setPoids($poids) {
			$this->poids = $poids;
        }

		public function setStatut($statut) {
			$this->statut = $statut;			
        }

	} 
?>