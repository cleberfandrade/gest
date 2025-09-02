<?php
namespace App\Models;

use Core\Model;

use PDO;
use Exception;

class Auth extends Model
{
    private $database, $codigo, $email, $password;
    public function __construct()
    {
        $this->database = new Model();
        $this->database->setTabela('usuarios');
    }
    public function setEmail($email)
    {
        $this->email = $email;
    }
    public function setPassword($password)
    {
        $this->password = $password;
    }
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;
    }
    public function authenticate($view = null)
    {
        $parametros = "email='{$this->email}'";
        $campos = "*";
        $user = [];
        $user = $this->database->read($parametros, $campos, $view, $id = false);
        if ($user && password_verify($this->password, $user[0]['senha'])) {
            //Remove senha do retorno
            unset($user[0]['senha']);
            return $user[0];
        }
        return false;
    }
    public function listar($view = 0)
    {
        $parametros = " U WHERE U.id='{$this->codigo}' ORDER BY U.nome ASC";
        $campos = "*";
        $user = $this->database->read($parametros, $campos, $view, $id = false);
        if ($user) {
            return $user[0];
        } else {
            return false;
        }
    }

}