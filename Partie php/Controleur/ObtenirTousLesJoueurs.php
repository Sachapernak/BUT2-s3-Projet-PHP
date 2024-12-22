<?php 
	class ObtenirTousLesJoueurs{ 

		// définition des attributs 
		private $pdo;
		  
		// définition des méthodes 
		public function __construct($pdo) { 
			$this->pdo = $pdo;
		} 
		
		public function executer(): array {
            $requete = $this->pdo->prepare('SELECT * FROM joueur');
            $requete->execute();
            return $requete->fetchAll(PDO::FETCH_ASSOC);
        }
	} 
?>