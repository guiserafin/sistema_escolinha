<?php

class EnderecoController
{

    public function edit($dados)
    {
        $endereco_edit = new EnderecoModel();
        $endereco_edit->editarEndereco($dados);
    }

}