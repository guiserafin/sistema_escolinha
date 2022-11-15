<?php

class ProfessoresController{
    
    public function professor_editar($id){
        
        $professor_edit = new UsuarioModel();
        return $professor_edit-> listarUserUnico($id);

    }

    public function professor_excluir($id){

        $professor_del = new UsuarioModel();
        $professor_del->excluirUsuario($id);

    }
}