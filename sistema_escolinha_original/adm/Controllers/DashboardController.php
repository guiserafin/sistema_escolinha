<?php

class DashboardController
{
    public function aluno_editar($id){

        $aluno_edit = new UsuarioModel();
        return $aluno_edit->listarAlunoUnico($id);

    }
}