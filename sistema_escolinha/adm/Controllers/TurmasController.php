<?php

class TurmasController{
    
    public function list(){

        $turmas_list = new TurmasModel();
        return $turmas_list->listarTurmas();

    }

    public function list_unico($id){

        $turmas_listUnico = new TurmasModel();
        return $turmas_listUnico->listarTurmaUnica($id);

    }
    
    public function delete($id){

        $turma_delete = new TurmasModel();
        return $turma_delete->deletarTurma($id);

    }

    public function create($nome_turma,$nome_curso){
        
        $turma_create = new TurmasModel();
        return $turma_create->criarTurma($nome_turma,$nome_curso);
    }

    public function edit($id_turma, $nome_curso,$nome_turma){

        $turma_edit = new TurmasModel();
        return $turma_edit->editarTurma($id_turma, $nome_curso,$nome_turma);

    }
}