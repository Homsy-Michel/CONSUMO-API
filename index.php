<?php
  require_once 'app/config/config.php';
  require_once 'app/modules/hg-api.php';

  $hg = new HG_API(HG_API_KEY);

  $dolar = $hg->dolar_quotation();
  $euro = $hg->euro_quotation();
  $gbp = $hg->gbp_quotation();
  $dolarDiaAnterior = $hg->dolarDiaAnterior();

  if($hg->is_error() == false) {
    $variationD = ($dolar['variation'] < 0) ? 'danger' : 'safe';
  }
  if($hg->is_error() == false) {
    $variationE = ($euro['variation'] < 0) ? 'danger' : 'safe';
  }
  if($hg->is_error() == false) {
    $variationG = ($gbp['variation'] < 0) ? 'danger' : 'safe';
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cotação Dolar</title>
  <link rel="stylesheet" href="style.css">

</head>
<body>
  <div class="row">
    <header>
      <h1>Cotações de Moedas pelo Mundo</h1>
    </header>

    <div class="dolarDiaAnterior">
      <?php if($hg->is_error() == false): ?>
      <p>Cotação Dolar Dia anterior</p>
      <p>USD <span class=""><?php echo($dolarDiaAnterior['doleta']); ?></span></p>
      <?php else:?>
      <p>USD <span>Serviço indisponivel</span></p>
      <?php endif;?>
    </div>

    <div class="dolar">
      <?php if($hg->is_error() == false): ?>
      <p>Cotação Dolar</p>
      <p>USD <span class="<?php echo ($variationD);?>"><?php echo($dolar['buy']); ?></span></p>
      <?php else:?>
      <p>USD <span>Serviço indisponivel</span></p>
      <?php endif;?>
    </div>

    <div class="euro">
      <?php if($hg->is_error() == false): ?>
      <p>Cotação Euro</p>
      <p>EUR <span class="<?php echo ($variationE);?>"><?php echo($euro['buy']); ?></span></p>
      <?php else:?>
      <p>EUR <span>Serviço indisponivel</span></p>
      <?php endif;?>
    </div>

    <div class="gbp">
      <?php if($hg->is_error() == false): ?>
      <p>Cotação GBP</p>
      <p>GBP <span class="<?php echo ($variationG);?>"><?php echo($gbp['buy']); ?></span></p>
      <?php else:?>
      <p>GBP <span>Serviço indisponivel</span></p>
      <?php endif;?>
    </div>
  </div>


</body>
</html>