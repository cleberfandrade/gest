<?php
namespace App\Controllers;

use App\Models\Auth;
use Configs\Sessao;
use Configs\Check;
use Core\View;


class login extends View
{
    private $auth;
    private $dados = [];
    private $view = null;
    private $Check;

    public function __construct()
    {
        Sessao::logado();
        $this->Check = new Check();
        $this->auth = new Auth();
    }

    public function index()
    {
        $this->dados['title'] = 'FAÇA LOGIN NO SISTEMA | GEST/ESTOQUE';
        $this->render('site/login', $this->dados);
    }
    public function auth()
    {
        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (isset($_POST) && isset($dados['acesso'])) {
            
            $username = $dados['username'] ?? '';
            $password = $dados['password'] ?? '';

            if (!empty($username) && !empty($password)) {
                //Validar Dados
                $username = $this->Check->checarString($username);
                $password = $this->Check->checarString($password);
                if($this->Check->checarEmail($username)){
                   
                    // Exemplo simples de autenticação (substitua pela sua lógica)
                    $this->auth->setEmail($username);
                    $this->auth->setPassword($password);
                    
                    if ($loginUser = $this->auth->authenticate($this->view)) {
                        // Autenticação bem-sucedida
                        $_SESSION['user'] = $loginUser;
                        header('Location: ' . DIRPAGE . 'dashboard'); // Redireciona para o dashboard ou página protegida
                        exit();
                    } else {
                        // Falha na autenticação
                        $dados = ['error' => '4- Nome de usuário ou senha inválidos.'];
                        $this->render('site/login', $dados);
                    }
                } else {
                    // Falha na autenticação
                    $dados = ['error' => '3- Nome de usuário inválido.'];
                    $this->render('site/login', $dados);
                }
            } else {
                // Falha na autenticação
                $dados = ['error' => '2- Informe um nome de usuário e/ou senha'];
                $this->render('site/login', $dados);
            }
        } else {
            //Falha na autenticação
            $dados = ['error' => '1- Acesso inválido.'];
            $this->render('site/login', $dados);
        }
    }
    public function novo_cadastro()
    {
        $this->dados['title'] = 'CADASTRE-SE | GEST/ESTOQUE ';
        //Recupera os dados enviados
        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (isset($_POST) && isset($dados['cadastro'])) {
            //Verifica se os campos foram todos preenchidos
            unset($dados['cadastro']);
        
        } else {
            //Falha na autenticação
            $dados = ['error' => '1- Acesso inválido.'];
            $this->render('site/login', $dados);
        }
    }
}