<?php

class NotasController
{
    public function list($aluno_id){

        $notas_list = new NotasModel();
        return $notas_list->listarNotas($aluno_id);

    }
}