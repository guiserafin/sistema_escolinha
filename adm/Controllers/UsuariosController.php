<?php

class UsuariosController
{
    public function login($email, $senha){

        $login = new UsuarioModel();
        return $login->logar($email, $senha);

    }

    public function create($prTipo){

        if ($prTipo == 'aluno'){
            include_once DIR_VIEW . "/aluno_criar.php";
        } else {
            include_once DIR_VIEW . "/professor_criar.php";
        }

    }

    public function store(){

        if ($_POST['tipo'] == '3') {

            $criar_professor = new UsuarioModel();
            $criar_professor->cadastrarProfessor($_POST);
            header('Location: ' . $_SERVER['HTTP_REFERER']);

        } else if ($_POST['tipo'] == '2') {

            $criar_aluno = new UsuarioModel();
            $criar_aluno->cadastrarAluno($_POST);
            header('Location: ' . $_SERVER['HTTP_REFERER']);

        }

    }

    public function list($prTipo){
        $user = new UsuarioModel();
        return $user->list($prTipo);
    }

    public function edit($id) {

        $_GET['id'] = $id;
        include_once DIR_VIEW . "/aluno_editar.php";

    }

    public function update(){
        $usuario = new UsuarioModel();
        $usuario->editarDadosUser($_POST);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    public function delete($id){

        $user_delete = new UsuarioModel();
        $user_delete->excluirUsuario($id);

        header('Location: ' . $_SERVER['HTTP_REFERER']);

    }
}