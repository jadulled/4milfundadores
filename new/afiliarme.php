<?
require_once 'app/db/db.php';

$afiliado = array();

if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {

  foreach( $DB->attrsAfiliado as $v ){
    $afiliado[$v] = isset($_POST[$v]) ? $_POST[$v] : '';
  }

  try {
    $DB->createAfiliado($afiliado);

    /**
    * Falta el manejo de las imágenes, vienen en:
    * $_FILES["foto1"]
    * $_FILES["foto2"]
    * $_FILES["foto3"]
    **/
  } catch( DBValidationException $e ) {
    echo $e->getMessage();
    die();
  }

  echo 'Afiliado creado exitosamente!';
  die();
} else {

  foreach( $DB->attrsAfiliado as $v ){
    $afiliado[$v] = '';
  }

}


?>
<!DOCTYPE html>
<html>
<head>
  <title>Afiliaciones | Partido De La Red</title>
  <meta name="description" content="Ya no hay razones para que nuestros
  representantes se limiten a escucharnos cada 2 años. En tiempos de la red,
  es fundamental que todos podamos participar para vivir una democracia donde
  entre todos construyamos el país que soñamos.">
  <link rel="stylesheet" type="text/css" href="css/pure-min.css">
  <style type="text/css">
    body {
      padding: 15px;
    }

    .pure-button-success {
      color: white;
      border-radius: 4px;
      text-shadow: 0 1px 1px rgba(0, 0, 0, 0.2);
      background: rgb(28, 184, 65);
    }

    small {
      color: #999;
    }
  </style>
</head>
<body>
  <img class="pure-img" src="img/head_formulario.jpg">
  <form class="pure-form pure-form-stacked" method="post" enctype="multipart/form-data">
    <label for="apellido">Apellido/s <small>(como figura en tu DNI)</small></label>
    <input type="text" name="apellido" id="apellido" value="<?= $afiliado['apellido'] ?>" required>

    <label for="nombres">Nombre/s <small>(como figura en tu DNI)</small></label>
    <input type="text" name="nombres" id="nombres" value="<?= $afiliado['nombres'] ?>" required>

    <label for="dni">DNI <small>(sólo números)</small></label>
    <input type="text" name="dni" id="dni" value="<?= $afiliado['dni'] ?>" title="DNI escrito sólo con números." required pattern="[0-9]{1,9}">

    <label for="sexo">Sexo</label>
    <select name="sexo" id="sexo" required>
      <option value="" selected disabled>-&nbsp;sexo&nbsp;-</option>
      <option value="f" <? if( $afiliado['sexo'] == 'f') echo 'selected'; ?>>Femenino</option>
      <option value="m" <? if( $afiliado['sexo'] == 'm') echo 'selected'; ?>>Masculino</option>
    </select>

    <label for="dia">Fecha de Nacimiento</label>
    <select name="dia" id="dia" required>
      <option value="" selected disabled>-&nbsp;dia&nbsp;-</option>
      <? for( $k = 1; $k <= 31; $k++ ){ $_dia = str_pad($k, 2, '0', STR_PAD_LEFT)?>
        <option value="<? echo $_dia ?>" <? if( $afiliado['dia'] == $_dia ) echo 'selected'; ?>>
          <?= $k ?>
        </option>
      <? } ?>
    </select>
    <select name="mes" id="mes" required>
      <option value="" selected disabled>-&nbsp;mes&nbsp;-</option>
      <option value="01" <? if( $afiliado['mes'] == '01') echo 'selected'; ?>>Ene</option>
      <option value="02" <? if( $afiliado['mes'] == '02') echo 'selected'; ?>>Feb</option>
      <option value="03" <? if( $afiliado['mes'] == '03') echo 'selected'; ?>>Mar</option>
      <option value="04" <? if( $afiliado['mes'] == '04') echo 'selected'; ?>>Abr</option>
      <option value="05" <? if( $afiliado['mes'] == '05') echo 'selected'; ?>>May</option>
      <option value="06" <? if( $afiliado['mes'] == '06') echo 'selected'; ?>>Jun</option>
      <option value="07" <? if( $afiliado['mes'] == '07') echo 'selected'; ?>>Jul</option>
      <option value="08" <? if( $afiliado['mes'] == '08') echo 'selected'; ?>>Ago</option>
      <option value="10" <? if( $afiliado['mes'] == '10') echo 'selected'; ?>>Sep</option>
      <option value="10" <? if( $afiliado['mes'] == '10') echo 'selected'; ?>>Oct</option>
      <option value="11" <? if( $afiliado['mes'] == '11') echo 'selected'; ?>>Nov</option>
      <option value="12" <? if( $afiliado['mes'] == '12') echo 'selected'; ?>>Dic</option>
    </select>
    <select name="ano" id="ano" required>
      <option value="" selected disabled>-&nbsp;año&nbsp;-</option>
      <? for( $k = 1996; $k >= 1900; $k-- ){ ?>
        <option value="<?= $k ?>" <? if( $afiliado['ano'] == (string)$k ) echo 'selected'; ?>>
          <?= $k ?>
        </option>
      <? } ?>
    </select>

    <label for="lugar_nac">Lugar de Nacimiento <small>(como figura en tu DNI)</small></label>
    <input type="text" name="lugar_nac" id="lugar_nac" value="<?= $afiliado['lugar_nac'] ?>" title="Tu lugar de nacimiento como figura en el DNI." required>

    <label for="profesion">Profesión u Oficio</label>
    <input type="text" name="profesion" id="profesion" value="<?= $afiliado['profesion'] ?>" required>

    <label for="est_civil">Estado Civil <small>(como figura en tu DNI)</small></label>
    <input type="text" name="est_civil" id="est_civil" value="<?= $afiliado['est_civil'] ?>" title="Estado Civil como figura en el DNI." required>

    <label for="direccion">Domicilio <small>(Si es DNI Libro, el último domicilio registrado legalmente)</small></label>
    <input type="text" name="direccion" id="direccion" value="<?= $afiliado['direccion'] ?>" title="Domicilio legal como figura en el DNI." required>

    <label for="mail">E-Mail</label>
    <input type="text" name="mail" id="mail" value="<?= $afiliado['mail'] ?>">

    <label for="telefono">Teléfono <small>(opcional)</small></label>
    <input type="text" name="telefono" id="telefono" value="<?= $afiliado['telefono'] ?>">

    <label for="mosaico">Como queres que figure tu nombre en el mosaico de los 4.000 Fundadores.</label>
    <select name="mosaico" id="mosaico" required>
      <option value="poner_nombre" <? if( $afiliado['mosaico'] == 'poner_nombre') echo 'selected'; ?>>Nombre Completo + Inicial Apellido</option>
      <option value="poner_apellido" <? if( $afiliado['mosaico'] == 'poner_apellido') echo 'selected'; ?>>Inicial Nombre + Apellido Completo</option>
    </select>

    <p>Subí las dos caras de tu DNI que tengan un máximo de 6MB.<br>
    <strong>Es muy importante que las fotos esten en foco y que los datos sean legibles.<br>
    Si tu cámara no permite tomar fotos en foco de muy cerca,<br>
    aléjala unos centímetros hasta que los datos en las fotos aparezcan legibles.</strong></p>

    <label for="foto1">Subir Frente DNI Tarjeta ó Primera hoja con foto DNI Libro (Requerido)</label>
    <input type="file" name="foto1" id="foto1">

    <label for="foto2">Subir Dorso DNI Tarjeta ó Segunda Hoja DNI libro (Requerido)</label>
    <input type="file" name="foto2" id="foto2">

    <label for="foto3">En el caso que haya cambio de domicilio en DNI libro, subirlo también:</label>
    <input type="file" name="foto3" id="foto3">

    <br><br>

    <button class="pure-button pure-button-success">Afiliarme</button>
  </form>
  <? require 'app/partials/analytics.html' ?>
</body>
</html>