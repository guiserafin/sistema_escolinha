<?php

class DashboardController
{

    public function index(){
        include_once DIR_VIEW . '/dashboard.php';
    }

    public function aluno_editar($id){

        $aluno_edit = new UsuarioModel();
        return $aluno_edit->listarUserUnico($id);

    }

    public function aluno_excluir($id){

        $aluno_del = new UsuarioModel();
        $aluno_del->excluirUsuario($id);

    }

    public function aluno_show_excluir($id){

        $aluno_show_del = new UsuarioModel();
        return $aluno_show_del->listarUserExcluir($id);

    }
}