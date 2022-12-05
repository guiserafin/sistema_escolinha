<?php

class DisciplinasController{

    public function list(){ //listar as disciplinas

        $disciplinas_list = new DisciplinasModel();
        return $disciplinas_list->listarDisciplinas();

    }

    public function list_unico($id){
        $disciplina_list = new DisciplinasModel();
        return $disciplina_list->listarUmaDisciplina($id);
    }
    
    public function create($nome){

        $disciplina_create = new DisciplinasModel();
        $disciplina_create->criarDisciplina($nome);
    
    }

    public function edit($nome, $id){

        $disciplina_edit = new DisciplinasModel();
        $disciplina_edit->editarDisciplina($nome, $id);
    }

    public function delete($id){
        
        $disciplina_delete = new DisciplinasModel();
        $disciplina_delete->excluirDisciplina($id);

    }

}