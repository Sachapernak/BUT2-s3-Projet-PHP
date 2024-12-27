<?php 
	class JoueurDAO{ 

		// définition des attributs 
		private $pdo;
		  
		// définition des méthodes 
		public function __construct() { 
            try {
                $this->pdo = new PDO('mysql:host=localhost;dbname=ma_base', 'user', 'password');
            }
            catch (Exception $e) {
                die('Erreur de connexion a la BD : ' . $e->getMessage());
            }
        } 
		
		public function insert($n_licence, $nom, $prenom, $date_de_naissance, $taille, $poids, $statut) {
            $requete = $this->pdo->prepare('
                INSERT INTO joueur (n_licence, nom, prenom, date_de_naissance, taille, poids, statut)
                VALUES (:n_licence, :nom, :prenom, STR_TO_DATE(:date_de_naissance, "%d/%m/%Y"), :taille, :poids, :statut)'
            );
            $requete->execute([
                ':n_licence' => $n_licence,
                ':nom' => $nom,
                ':prenom' => $prenom,
                ':date_de_naissance' => $date_de_naissance,
                ':taille' => $taille,
                ':poids' => $poids,
                ':statut' => $statut
            ]);        
        }
        
        public function update($n_licence, $nom, $prenom, $taille, $poids, $statut, $date_de_naissance) {
            $requete = $this->pdo->prepare('UPDATE joueur SET nom = :nvnom , 
                                            prenom = :nvprenom , 
                                            taille = :nvtaille , 
                                            poids = :nvpoids , 
                                            statut = :nvstatut, 
                                            date_de_naissance = STR_TO_DATE(:nvdate_naissance, "%d/%m/%Y")
                                            WHERE n_licence = :n_licence');
            
            $requete->execute(array('nvnom' => $nom, 'nvprenom' => $prenom, 'nvtaille' => $taille, 'nvpoids' => $poids, 
                            'nvstatut' => $statut,'nvdate_de_naissance' => $date_de_naissance, 'n_licence' => $n_licence));
        }

        public function delete($n_licence) {
            $requete = $this->pdo->prepare('DELETE FROM joueur WHERE n_licence = :n_licence');
            $requete->execute(array('n_licence' => $n_licence));
        }

        public function findById($n_licence): Joueur  {
            $joueur= null;
            $requete = $this->pdo->prepare('SELECT * FROM joueur WHERE n_licence = :n_licence');
            $requete->execute(array('n_licence' => $n_licence));
            $res = $requete->fetch(PDO::FETCH_ASSOC);
            if ($res) {
                $joueur = new Joueur($res['n_licence'], $res['nom'], $res['prenom'], $res['date_de_naissance'], $res['taille'], $res['poids'],  $res['statut']);
            }
            return $joueur; 
        }

        public function findAll() : array {
            $requete = $this->pdo->query('SELECT * FROM joueur');
            $joueurs = [];
            while ($res = $requete->fetch(PDO::FETCH_ASSOC)) {
                $joueurs[] = new Joueur($res['n_licence'], $res['nom'], $res['prenom'], $res['date_de_naissance'], $res['taille'], $res['poids'],  $res['statut']);
            }
            return $joueurs;
        }
	} 
?>