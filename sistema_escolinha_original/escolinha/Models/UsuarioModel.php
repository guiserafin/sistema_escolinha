<?php
session_start();
class UsuarioModel extends ConnectionController
{
    public object $conn;

    function logar($email, $senha){

        $this->conn = $this->connectDb();

        $sql = "SELECT * FROM `usuarios` WHERE `email` = '$email' AND `senha` = md5('$senha') AND `situacao_id` = 1 LIMIT 1";
        $sql_query = $this->conn->prepare($sql);
        $sql_query->execute();
        $sql_dados = $sql_query->fetchAll();

        $_SESSION['id']             = $sql_dados[0]['id'];
        $_SESSION['nome']           = $sql_dados[0]['nome'];
        $_SESSION['cpf']            = $sql_dados[0]['cpf'];
        $_SESSION['nivelAcesso_id'] = $sql_dados[0]['nivelAcesso_id'];
        $_SESSION['situacao_id']    = $sql_dados[0]['situacao_id'];

        $rowCount = count($sql_dados);

        return $rowCount;

    }
}