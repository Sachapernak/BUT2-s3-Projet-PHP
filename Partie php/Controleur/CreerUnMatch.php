<?php 
    namespace Controleur;
    use DAO\MatchDAO;
    use Modele\MatchBasket;
    class CreerUnMatch { 

        private $matchDAO;            // Objet MatchDAO utilisé pour interagir avec la base de données des matchs
        private $date_et_heure;       // La date et l'heure du match
        private $adversaire;          // L'adversaire contre lequel l'équipe joue
        private $lieu;                // Le lieu où se déroule le match
        private $resultat;            // Le résultat du match (par exemple, victoire, défaite, nul)

        /**
         * Constructeur de la classe CreerUnMatch.
         * Ce constructeur initialise les propriétés de l'objet en fonction des informations contenues dans l'objet Match passé en paramètre.
         *
         * @param MatchDAO $matchDAO L'objet MatchDAO utilisé pour effectuer des opérations sur la base de données des matchs
         * @param Match $match L'objet Match contenant les informations nécessaires à la création du match
         */
        public function __construct(MatchDAO $matchDAO, MatchBasket $match) { 
            $this->matchDAO = $matchDAO;
            $this->date_et_heure = $match->getDate_et_heure();
            $this->adversaire = $match->getAdversaire();
            $this->lieu = $match->getLieu();
            $this->resultat = $match->getResultat();
        } 

         /**
         * Exécute l'insertion d'un match dans la base de données en utilisant le MatchDAO.
         * 
         * @return int Retourne l'identifiant du match inséré (ID généré par la base de données)
         */
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
