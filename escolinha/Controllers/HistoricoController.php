<?php

class HistoricoController
{
    public function list($id_curso){

        $historico_list = new HistoricoModel();
        return $historico_list->listarHistorico($id_curso);

    }
}