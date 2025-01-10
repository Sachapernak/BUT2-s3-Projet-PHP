<?

namespace Controleur;

use DAO\DaoJoueurs;
use Controleur\ObtenirTousLesJoueurs;

class ControleurPageJoueurs
{

    private $joueurDAO;

    public function __construct(){
        $this->joueurDAO = new DaoJoueur();
    }

    public function getJoueurs() : array {
        $obtenirTousLesJoueurs = new ObtenirTousLesJoueurs($this->joueurDAO);
        return $obtenirTousLesJoueurs->executer();

    }
}

?>