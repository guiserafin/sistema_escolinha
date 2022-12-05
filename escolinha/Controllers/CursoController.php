<?php

class CursoController
{
    public function list($turma_id){
        $curso_list = new CursoModel();
        return $curso_list->listarCurso($turma_id);
    }
}