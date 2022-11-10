<?php

class UsuarioController
{
    public function login($email, $senha){

        $login = new UsuarioModel();
        return $login->logar($email, $senha);

    }


    public function list(){

    }

    public function create(){


    }

    public function delete(){


    }

    public function edit(){
        

    }
}