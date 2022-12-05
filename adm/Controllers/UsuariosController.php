<?php

class UsuariosController
{
    public function login($email, $senha){

        $login = new UsuarioModel();
        return $login->logar($email, $senha);

    }


    public function listAlunos(){

        $lista_de_alunos = new UsuarioModel();
        return $lista_de_alunos->listarAlunos();

    }

    public function listProfessores(){

        $lista_de_professores = new UsuarioModel();
        return $lista_de_professores->listarProfessores();

    }

    public function createAluno($dados){

        $criar_aluno = new UsuarioModel();
        return $criar_aluno->cadastrarAluno($dados);

    }

    public function createProfessor($dados){

        $criar_professor = new UsuarioModel();
        return $criar_professor->cadastrarProfessor($dados);

    }

    public function delete($id){

        $user_delete = new UsuarioModel();
        return $user_delete->excluirUsuario($id);

    }

    public function edit($dados){
       
        $dados_editar = new UsuarioModel();
        return $dados_editar->editarDadosUser($dados);

    }
}