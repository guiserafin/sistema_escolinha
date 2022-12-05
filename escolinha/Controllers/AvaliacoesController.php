<?php

class AvaliacoesController
{
    public function list($turma_id){

        $avaliacoes_list = new AvaliacoesModel();
        return $avaliacoes_list->listarAvaliacoes($turma_id);

    }

}