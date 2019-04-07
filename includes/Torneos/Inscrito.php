<?php 
	require_once __DIR__ . '/../comun/Aplicacion.php';

	class Inscristo{

	    private $id;

	    private $idUsuario;

	    private $jug_tot;

	    private $idJuego;

	    private $esViernes;

		private $esMensual;

		private $dia_jugado;

		private $puntos;

		private $ronda;

		private function __construct($idUsuario, $idJuego, $jug_tot, $esViernes, $esMensual, $dia_jugado, $puntos, $ronda){
			$this->idUsuario= $idUsuario;
			$this->idJuego= $idJuego;
			$this->jug_tot= $jug_tot;
			$this->esViernes= $esViernes;
			$this->esMensual= $esMensual;
			$this->dia_jugado= $dia_jugado;
			$this->puntos= $puntos;
			$this->ronda= $ronda;
		}

		public function id(){
			return $this->id;
		}
			
		public function idUsuario(){
			return $this->idUsuario;
		}

		public function idJuego(){
			return $this->idJuego;
		}

		public function jug_tot(){
			return $this->jug_tot;
		}

		public function esViernes(){
			return $this->esViernes;
		}

		public function esMensual(){
			return $this->esMensual;
		}

		public function dia_jugado(){
			return $this->dia_jugado;
		}

		public function puntos(){
			return $this->puntos;
		}

		public function ronda(){
			return $this->ronda;
		}

	    public static function buscarInscrito($idUsu, $fecha)
	    {
	        $app = Aplicacion::getSingleton();
	        $conn = $app->conexionBd();
	        $query = sprintf("SELECT * FROM torneo_jugando T WHERE T.id_jugad_jugan = '%s' AND T.dia_jugado = '%s'"
	        		, $conn->real_escape_string($idUsu)
	        		, $conn->real_escape_string($fecha));
	        $rs = $conn->query($query);
	        $result = false;
	        if ($rs) {
	            if ( $rs->num_rows == 1) {
	                $fila = $rs->fetch_assoc();
	                //	construct($idUsuario, $idJuego, $jug_tot, $esViernes, $esMensual, $dia_jugado, $puntos, $ronda)
	                $inscri = new Inscristo($fila['id_jugad_jugan'], $fila['idJuego'], $fila['jugadores_total'], 
	                					$fila['esViernes'], $fila['esMensual'], $fila['dia_jugado'], 
	                					$fila['puntos'], $fila['ronda']);
	                $inscri->id = $fila['id'];
	                $result = $inscri;
	            }
	            $rs->free();
	        } else {
	            echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
	            exit();
	        }
	        return $result;
	    }   // buscarUsuario con idJuego y fecha-- no puede ser el mismo dia



	    public static function inscribe($idUsuario, $idJuego, $jug_tot, $esViernes, $esMensual, $dia_jugado, $puntos, $ronda)
	    {
	        $inscri = self::buscarInscrito($idUsuario, $dia_jugado);
	        if ($inscri) {
	            return false;
	        }
	        $inscri = new Inscristo($idUsuario, $idJuego, $jug_tot, $esViernes, $esMensual, $dia_jugado, $puntos, $ronda);
	        return self::inserta($inscri);
	    }

	    private static function inserta($jug)
	    {
	        $app = Aplicacion::getSingleton();
	        $conn = $app->conexionBd();
	        $query=sprintf("INSERT INTO torneo_jugando(jugadores_total, id_jugad_jugan, idJuego, esViernes, esMensual, dia_jugado, puntos, ronda)
							VALUES('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')"
	            , $conn->real_escape_string($jug->jug_tot)
	            , $conn->real_escape_string($jug->idUsuario)
                , $conn->real_escape_string($jug->idJuego)
	            , $conn->real_escape_string($jug->esViernes)
	            , $conn->real_escape_string($jug->esMensual)
	            , $conn->real_escape_string($jug->dia_jugado)
	            , $conn->real_escape_string($jug->puntos)
	            , $conn->real_escape_string($jug->ronda));
	        if ( $conn->query($query) ) {
	            $jug->id = $conn->insert_id;
	        } else {
	            echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
	            exit();
	        }
	        return $jug;
	    }

	    public static function generaRandom(){
	    	/*
				usando function y un método que te devuelve cuántos paquetes hay (posible recursión)
	    	*/
	    }//Genera un número random entre todos los productos y devuelve uno

	    public static function eliminarInscrip($id)
	    {
	    	/*
	        $app = Aplicacion::getSingleton();
	        $conn = $app->conexionBd();
	        $query = sprintf("DELETE FROM usuarios WHERE id = '%s'", $conn->real_escape_string($id));
	        $rs = $conn->query($query);
	        */
	    }

	}

?>