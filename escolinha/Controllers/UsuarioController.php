<?php

class UsuarioController
{
    public function login($email, $senha){

        $login = new UsuarioModel();
        return $login->logar($email, $senha);

    }


    public function listProf($turma_id){

        $professores_list = new UsuarioModel();
        return $professores_list->listarProfessores($turma_id);

    }

    public function listAlunos($turma_id){

        $alunos_list = new UsuarioModel();
        return $alunos_list->listarAlunos($turma_id);

    }

    public function list_unico($id){

        $aluno_list = new UsuarioModel();
        return $aluno_list->listUmAluno($id);

    }

    public function edit($dados){
        
        $usuario_edit = new UsuarioModel();
        $usuario_edit->editarUsuario($dados);

    }
}