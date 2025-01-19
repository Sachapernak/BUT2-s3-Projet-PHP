<?php 

	namespace Controleur;

	use DAO\MatchDAO;
	class SupprimerUnMatch { 
 
		private $matchDAO;
        private $id_matchs;

		  
		/**
		 * Constructeur de la classe. Initialise les attributs avec les valeurs passées en paramètre.
		 *
		 * @param MatchDAO $matchDAO Instance de MatchDAO pour effectuer des requêtes sur la base de données des matchs
		 * @param int $id_matchs L'identifiant du match à supprimer
		 */
		public function __construct(MatchDAO $matchDAO, $id_matchs) { 
			$this->matchDAO = $matchDAO;
            $this->id_matchs = $id_matchs; 
        }    

		/**
		 * Exécute la suppression d'un match à partir de son identifiant.
		 *
		 * @return bool Retourne true si la suppression a réussi, false sinon
		 */
		public function executer(): bool{
            return $this->matchDAO->delete($this->id_matchs);
            
        }
	} 
?>