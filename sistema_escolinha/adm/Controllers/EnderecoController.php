<?php

class EnderecoController
{

    public function edit($dados){
        $dados_endereco = new EnderecoModel();
        return $dados_endereco->editarDadosEndereco($dados);
    }

}