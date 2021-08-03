<?php

    require_once 'hg-api.php';

    $key = "1cf44028";

    $p = new HG_API($key);
    $res2 = $p->dolar_quotation();
    $p->guardarDolar(2, $res2['buy']);

?>