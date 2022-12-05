<?php

class AvaliacoesController
{

    public function create($dados){

        $avaliacao_create = new AvaliacoesModel();
        $avaliacao_create->criarAvaliacao($dados);

    }

    public function list(){

        $avaliacoes_listar = new AvaliacoesModel();
        return $avaliacoes_listar->listarAvaliacoes();

    }

    public function list_unico($id){

        $avaliacao_listar = new AvaliacoesModel();
        return $avaliacao_listar->listarUmaAvaliacao($id);

    }

    public function edit($dados){
        
        $avaliacao_edit = new AvaliacoesModel();
        return $avaliacao_edit->editarAvaliacao($dados);

    }

    public function delete($id){
        
        $avaliacao_delete = new AvaliacoesModel();
        $avaliacao_delete->deletarAvaliacao($id);
    }

}