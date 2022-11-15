<?php

class DashboardController
{
    public function aluno_editar($id){

        $aluno_edit = new UsuarioModel();
        return $aluno_edit->listarUserUnico($id);

    }

    public function aluno_excluir($id){

        $aluno_del = new UsuarioModel();
        $aluno_del->excluirUsuario($id);

    }
}