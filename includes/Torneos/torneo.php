<?php
require_once __DIR__ . '/../comun/Aplicacion.php';
class Torneo{
	private $id;
	private $idJuego;
	private $fecha;

	private function __construct($idJuego, $fecha)
    {
        $this->idJuego= $idJuego;
        $this->fecha = $fecha;

    }

	public static function guarda($torneo)
    {
        if ($torneo->id !== null) {
            return self::actualiza($torneo);
        }
        return self::inserta($torneo);
    }
	public static function crea($idJuego,$fecha)
    {
        $torneo = self::busarTorneo($idJuego);
        if ($product instanceof Product) {
            return false;
        }
        $torneo = new Torneo($idJuego,$fecha);
        return self::guarda($torneo);
    }

    private static function inserta($torneo)
    {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query=sprintf("INSERT INTO torneos_disp(idJuego, fecha) VALUES('%s','%s')"
            , $conn->real_escape_string($torneo->idJuego)
            , $conn->real_escape_string($torneo->fecha));
        if ( $conn->query($query) ) {
            $torneo->id = $conn->insert_id;
        } else {
            echo "Error al insertar en la BD: (" . $conn->errno() . ") " . utf8_encode($conn->error);
            exit();
        }
        return $torneo;
    }

    public static function busarTorneo($idJuego)
    {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT * FROM torneos_disp P WHERE P.idJuego = '$idJuego' ");
        $rs = $conn->query($query);
        $result = false;
        if ($rs) {
            if ( $rs->num_rows == 1) {
                $fila = $rs->fetch_assoc();
                $torneo = new Torneo($fila['idJuego'], $fila['fecha']);
                $torneo->idJuego = $idJuego;
                $result = $torneo;
            }
            $rs->free();
        } else {
            echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $result;
    }

    public function id()
    {
        return $this->id;
    }

    public function idJuego()
    {
        return $this->idJuego;
    }

    public function fecha()
    {
        return $this->fecha;
    }

}
?>