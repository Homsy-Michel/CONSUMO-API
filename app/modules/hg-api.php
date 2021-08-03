<?php
require_once 'conexao.php';
class HG_API extends Conexao {
    private $key = null;
    private $error = false;

    function __construct($key = null){
        if(!empty($key)) $this->key = $key;
    }

    function request ($endpoint = '', $params = array()){
        $uri = "https://api.hgbrasil.com/". $endpoint ."?key=". $this->key ."&format=json";

        if(is_array($params)){
            foreach($params as $key => $value) {
                if(empty($value)) continue;
                $uri .= $key . '=' . urlencode ($value) . '&';
            }
            $uri = substr($uri, 0, -1);
            $response = @file_get_contents ($uri);
            $this->error = false;
            return json_decode($response, true);
        }else {
            $this->error = true;
            return false;
        }
    }

    function is_error(){
        return $this->error;
    }

    function dolar_quotation () {
        $data = $this->request('finance/quotations');

        if(!empty($data) && is_array($data['results']['currencies']['USD'])){
            $this->error = false;
            return $data['results']['currencies']['USD'];
        }else{
            $this->error = true;
            return false;
        }
    }

    function euro_quotation () {
        $data = $this->request('finance/quotations');

        if(!empty($data) && is_array($data['results']['currencies']['EUR'])){
            $this->error = false;
            return $data['results']['currencies']['EUR'];
        }else{
            $this->error = true;
            return false;
        }
    }

    function gbp_quotation () {
        $data = $this->request('finance/quotations');

        if(!empty($data) && is_array($data['results']['currencies']['GBP'])){
            $this->error = false;
            return $data['results']['currencies']['GBP'];
        }else{
            $this->error = true;
            return false;
        }
    }

    function guardarDolar($id, $dolar) {
        $pdo = new Conexao();
        $cmd = $pdo->conexao()->prepare("UPDATE dolar SET doleta = :d WHERE id = :id");
        $cmd->bindValue(":d", $dolar);
        $cmd->bindValue("id", $id);
        $cmd->execute();

    }

    function dolarDiaAnterior() {
        $pdo = new Conexao();

        $cmd = $pdo->conexao()->query("SELECT * FROM  dolar");
        $res = $cmd->fetch();
        return $res;
    }


}
    



?>