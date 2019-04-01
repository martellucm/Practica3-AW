<?php
require_once __DIR__ . '/comun/Aplicacion.php';

class Usuario
{

    public static function login($nombreUsuario, $password)
    {
        $user = self::buscaUsuario($nombreUsuario);
        if ($user && $user->compruebaPassword($password)) {
            return $user;
        }
        return false;
    }

    public static function buscaUsuario($nombreUsuario)
    {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT * FROM usuarios U WHERE U.nombreUsuario = '%s'", $conn->real_escape_string($nombreUsuario));
        $rs = $conn->query($query);
        $result = false;
        if ($rs) {
            if ( $rs->num_rows == 1) {
                $fila = $rs->fetch_assoc();
                $user = new Usuario($fila['nombreUsuario'], $fila['nombre'], $fila['password'], $fila['email'],
							$fila['ptosForum'], $fila['ptosProd'], $fila['ptosTourn'],
							$fila['avatar'], $fila['rol'], $fila['descrip'],
							$fila['cumple']);
                $user->id = $fila['id'];
                $result = $user;
            }
            $rs->free();
        } else {
            echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $result;
    }

    public static function buscaUsuarioID($id)
    {
      $app = Aplicacion::getSingleton();
      $conn = $app->conexionBd();
      $query = sprintf("SELECT * FROM usuarios U WHERE id = '%s'", $conn->real_escape_string($id));
      $rs = $conn->query($query);
      $result = false;
      if ($rs) {
          if ( $rs->num_rows == 1) {
              $fila = $rs->fetch_assoc();
              $user = new Usuario($fila['nombreUsuario'], $fila['nombre'], $fila['password'], $fila['email'],
            $fila['ptosForum'], $fila['ptosProd'], $fila['ptosTourn'],
            $fila['avatar'], $fila['rol'], $fila['descrip'],
            $fila['cumple']);
              $user->id = $fila['id'];
              $result = $user;
          }
          $rs->free();
      } else {
          echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
          exit();
      }
      return $result;
    }

    public static function getWW(){
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT * FROM usuarios ORDER BY ptosTourn DESC");
        $rs = $conn->query($query);
        $result = false;
        if ($rs) {
            if ( $rs->num_rows > 0) {
                $fila = $rs->fetch_assoc();
                $user = new Usuario($fila['nombreUsuario'], $fila['nombre'], $fila['password'], $fila['email'],
              $fila['ptosForum'], $fila['ptosProd'], $fila['ptosTourn'],
              $fila['avatar'], $fila['rol'], $fila['descrip'],
              $fila['cumple']);
                $user->id = $fila['id'];
                $result = $user;
            }
            $rs->free();
        } else {
            echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $result;
    }

    public static function crea($nombreUsuario, $nombre, $password, $email, $ptosForum, $ptosProd, $ptosTourn, $avatar, $rol, $descrip, $cumple)
    {
        $user = self::buscaUsuario($nombreUsuario);
        if ($user) {
            return false;
        }
        $user = new Usuario($nombreUsuario, $nombre, self::hashPassword($password), $email, $ptosForum, $ptosProd, $ptosTourn, $avatar, $rol, $descrip, $cumple);
        return self::guarda($user);
    }

    private static function hashPassword($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public static function guarda($usuario)
    {
        if ($usuario->id !== null) {
            return self::actualiza($usuario);
        }
        return self::inserta($usuario);
    }

    private static function inserta($usuario)
    {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query=sprintf("INSERT INTO usuarios(nombreUsuario, nombre, password, email, ptosForum, ptosProd, ptosTourn, avatar, rol, descrip, cumple)
						VALUES('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')"
            , $conn->real_escape_string($usuario->nombreUsuario)
            , $conn->real_escape_string($usuario->nombre)
            , $conn->real_escape_string($usuario->password)
            , $conn->real_escape_string($usuario->email)
            , $conn->real_escape_string($usuario->ptosForum)
            , $conn->real_escape_string($usuario->ptosProd)
            , $conn->real_escape_string($usuario->ptosTourn)
            , $conn->real_escape_string($usuario->avatar)
            , $conn->real_escape_string($usuario->rol)
            , $conn->real_escape_string($usuario->descrip)
            , $conn->real_escape_string($usuario->cumple));
        if ( $conn->query($query) ) {
            $usuario->id = $conn->insert_id;
        } else {
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $usuario;
    }

    private static function actualiza($usuario)
    {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query=sprintf("UPDATE usuarios U SET nombreUsuario = '%s', nombre='%s', password='%s', email='%s', ptosForum='%s',
						ptosProd='%s', ptosTourn='%s', avatar='%s', rol='%s', descrip='%s', cumple='%s', WHERE U.id=%i"
            , $conn->real_escape_string($usuario->nombreUsuario)
            , $conn->real_escape_string($usuario->nombre)
            , $conn->real_escape_string($usuario->password)
            , $conn->real_escape_string($usuario->email)
            , $conn->real_escape_string($usuario->ptosForum)
            , $conn->real_escape_string($usuario->ptosProd)
            , $conn->real_escape_string($usuario->ptosTourn)
            , $conn->real_escape_string($usuario->avatar)
            , $conn->real_escape_string($usuario->rol)
            , $conn->real_escape_string($usuario->descrip)
            , $conn->real_escape_string($usuario->cumple)
            , $usuario->id);
        if ( $conn->query($query) ) {
            if ( $conn->affected_rows != 1) {
                echo "No se ha podido actualizar el usuario: " . $usuario->id;
                exit();
            }
        } else {
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }

        return $usuario;
    }

    private $id;

    private $nombreUsuario;

    private $nombre;

    private $password;

	private $email;

	private $ptosForum;

	private $ptosProd;

	private $ptosTourn;

	private $avatar;

    private $rol;

	private $descrip;

	private $cumple;

	public static function actualizaUsu($id, $nombre, $email, $descrip, $cumple){
             $app = Aplicacion::getSingleton();
            $conn = $app->conexionBd();
            $query=sprintf("UPDATE usuarios SET nombre = '%s', email='%s', descrip='%s', cumple= '%s' WHERE id= '$id'"
                , $conn->real_escape_string($nombre)
                , $conn->real_escape_string($email)
                , $conn->real_escape_string($descrip)
                , $conn->real_escape_string($cumple));
             $conn->query($query);
        }

    public static function eliminarUsuario($id)
    {
         $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("DELETE FROM usuarios WHERE id = '%s'", $conn->real_escape_string($id));
        $rs = $conn->query($query);
    }

    private function __construct($nombreUsuario, $nombre, $password, $email, $ptosForum, $ptosProd, $ptosTourn, $avatar, $rol, $descrip, $cumple)
    {
        $this->nombreUsuario= $nombreUsuario;
        $this->nombre = $nombre;
        $this->password = $password;
		$this->email = $email;
		$this->ptosForum = $ptosForum;
		$this->ptosProd = $ptosProd;
		$this->ptosTourn = $ptosTourn;
		$this->avatar = $avatar;
        $this->rol = $rol;
		$this->descrip = $descrip;
		$this->cumple = $cumple;
    }

    public function id()
    {
        return $this->id;
    }

    public function rol()
    {
        return $this->rol;
    }

    public function nombreUsuario()
    {
        return $this->nombreUsuario;
    }

	public function nombre()
    {
        return $this->nombre;
    }

	public function email()
    {
        return $this->email;
    }

	public function cumple()
    {
        return $this->cumple;
    }

    public function ptosTourn(){
        return $this->ptosTourn;
    }

	public function ptosForum(){
        return $this->ptosForum;
    }

	public function ptosProd(){
        return $this->ptosProd;
    }

	public function descrip(){
        return $this->descrip;
    }

    public function compruebaPassword($password)
    {
       return password_verify($password, $this->password);
    }

    public function cambiaPassword($nuevoPassword)
    {
        $this->password = self::hashPassword($nuevoPassword);
    }
}
