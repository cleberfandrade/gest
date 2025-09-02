<?php
namespace Core;

class View
{
    
    private $pagina = 'home';
    private $dados = [];
    
    public function render($pagina, array $dados)
    {
        $this->dados = $dados;
        $this->pagina = $pagina;

        if (file_exists('app/views/' . $this->pagina . '.phtml')) {
            include_once 'app/views/' . $this->pagina . '.phtml';
        } else {
            if (file_exists('app/views/' . $this->pagina . '.php')) {
                include_once 'app/views/' . $this->pagina . '.php';
            } else {
                $this->pagina = explode('/', $this->pagina);
                if (isset($this->pagina[2])) {
                    $texto = $this->pagina[2];
                } else {
                    $texto = '';
                }
                $this->dados['mensagemErro'] =  "ERRO 404, PÁGINA {$texto} NÃO ENCONTRADA!";
                $this->pagina = (string) 'erro';
                include_once 'app/views/site/' . $this->pagina . '.phtml';
            }
        }
    }
    public function pages()
    {
        include_once 'app/views/adm/storage/pages/' . $pagina . '.phtml';
    }
}