<?php

class HistoricoController
{

    public function create($curso_id,$nome_disciplina){

        $historico_create = new HistoricoModel();
        $historico_create->criarHistorico($curso_id,$nome_disciplina);

    }
    
    public function delete($curso_id, $disciplina_id){

        $historico_delete = new HistoricoModel();
        $historico_delete->deletarHistorico($curso_id, $disciplina_id);

    }

}