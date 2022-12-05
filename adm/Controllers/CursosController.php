<?php

class CursosController{
    
    public function list(){ //lista todos os cursos

        $cursos_list = new CursosModel();
        return $cursos_list->listarCursos();

    }
    
    public function list_unico($id){ //lista um curso

        $curso_dados = new CursosModel();
        return $curso_dados-> listarDisciplinasDoCurso($id);

    }
    
    public function listUmCurso($id){
        
        $curso_dados = new CursosModel();
        return $curso_dados->listCursoUnico($id);

    }

    public function edit($dados){

        $curso_edit = new CursosModel();
        $curso_edit -> editarCurso($dados);

    }

    public function create($dados){

        $curso_create = new CursosModel();
        $curso_create->criarCurso($dados);

    }

    public function delete($id){

        $curso_delete = new CursosModel();
        $curso_delete->deletarCurso($id);

    }

}