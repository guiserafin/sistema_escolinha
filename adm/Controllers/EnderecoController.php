<?php

class EnderecoController
{

    public function edit($dados){
        $dados_endereco = new EnderecoModel();
        return $dados_endereco->editarDadosEndereco($dados);
    }

    public function list(){

        $dados_endereco = new EnderecoModel();
        return $dados_endereco->listarEnderecos();

    }

    public function list_unico($id){

        $dados_endereco = new EnderecoModel();
        return $dados_endereco->listarEnderecoUnico($id);

    }

    public function delete($id){

        $endereco_del = new EnderecoModel();
        return $endereco_del-> excluirEndereco($id);

    }

}