<?php

class AvaliacoesController
{
    public function list(){

        $avaliacoes_listar = new AvaliacoesModel();
        return $avaliacoes_listar->listarAvaliacoes();

    }
}