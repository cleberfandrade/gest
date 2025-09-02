<?php

namespace App\Controllers;

use Configs\Sessao;
use Configs\Check;
use Core\View;

class dashboard extends View
{
    private $dados = [];
    private $view = null;
    private $Check;
    public function __construct()
    {
        Sessao::logado();
        $this->Check = new Check();
    }
    public function index()
    {
        // Logic for dashboard view
        $this->dados['title'] = 'BEM VINDO(A) DASHBBOARD | GEST/ESTOQUE';
        $this->render('admin/dashboard', $this->dados);
        echo "Welcome to the Dashboard!";
    }
}