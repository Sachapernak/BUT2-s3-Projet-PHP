<?php 
	class RechercherUnJoueur { 

		// définition des attributs 
		private $pdo;
		private $n_licence;
		  
		// définition des méthodes 
		public function __construct($pdo, $n_licence) { 
			$this->pdo = $pdo;
			$this->n_licence = $n_licence; 
		} 
		
		public function executer():Joueur{
            $requete = $this->pdo->prepare("SELECT * FROM joueurs WHERE n_licence = :n_licence");
            $requete->execute([':n_licence' => $this->n_licence]);
            $res = $requete->fetch(PDO::FETCH_ASSOC);
            if ($res) {
                return new Joueur($res['n_licence'], $res['nom'], $res['prenom'], $res['date_de_naissance'], $res['taille'], $res['poids'],  $res['statut']);
            }
            return null; 
        }
	} 
?>