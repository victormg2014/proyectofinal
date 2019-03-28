<html>
<head>
  <link rel='stylesheet' href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="chat/style.css">
  <script src="img/jquery.min.js"></script>
  <script src="bootstrap/js/bootstrap.js"></script>
  <style>
  .estilo {height:50px;border: 2px solid #990000; width: 100%;}
  .casilla{
    background-color: red;
    display: inline-block;
    width: 40px;
    height: 40px;
    margin-top: 15px;
    margin-left: 15px;
    border-radius: 20px;
  }

  #checkboxes input[type=checkbox]{
      display: none;
  }

  #checkboxes input[type=checkbox]:checked + .casilla{
      background-color: green;
  }

  .boton {
    -moz-box-shadow: 0px 1px 0px 0px #f0f7fa;
    -webkit-box-shadow: 0px 1px 0px 0px #f0f7fa;
    box-shadow: 0px 1px 0px 0px #f0f7fa;
    background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #ed39e7), color-stop(1, #b31288));
    background:-moz-linear-gradient(top, #ed39e7 5%, #b31288 100%);
    background:-webkit-linear-gradient(top, #ed39e7 5%, #b31288 100%);
    background:-o-linear-gradient(top, #ed39e7 5%, #b31288 100%);
    background:-ms-linear-gradient(top, #ed39e7 5%, #b31288 100%);
    background:linear-gradient(to bottom, #ed39e7 5%, #b31288 100%);
    filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#ed39e7', endColorstr='#b31288',GradientType=0);
    background-color:#ed39e7;
    -moz-border-radius:6px;
    -webkit-border-radius:6px;
    border-radius:6px;
    border:1px solid #78008a;
    display:inline-block;
    cursor:pointer;
    color:#ffffff;
    font-family:Arial;
    font-size:15px;
    font-weight:bold;
    padding:6px 24px;
    text-decoration:none;
    text-shadow:0px -1px 0px #5b6178;
  }
  .boton:hover {
    background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #b31288), color-stop(1, #ed39e7));
    background:-moz-linear-gradient(top, #b31288 5%, #ed39e7 100%);
    background:-webkit-linear-gradient(top, #b31288 5%, #ed39e7 100%);
    background:-o-linear-gradient(top, #b31288 5%, #ed39e7 100%);
    background:-ms-linear-gradient(top, #b31288 5%, #ed39e7 100%);
    background:linear-gradient(to bottom, #b31288 5%, #ed39e7 100%);
    filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#b31288', endColorstr='#ed39e7',GradientType=0);
    background-color:#b31288;
  }
  .boton:active {
    position:relative;
    top:1px;
  }


  </style>
</head>
<body>
<?php
include("connect.php");
session_start();
if ($_SESSION['username'] == null){
  header('Location: index.php');
}
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Bienvenido: <?php echo $_SESSION['username'] ?></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="perfil.php">Home </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="chat.php">Chat</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="explorar.php">Perfiles</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="difusion.php">Difundir mensaje<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="modificar.php">Modificar perfil</a>
      </li>
    </ul>
    <span class="navbar-text">
      <a href='logout.php'>Cerrar Sesi&oacute;n</a>
    </span>
  </div>
</nav>
<p/>
<div class="container">
  <div class="row">
      <div class="col-md-4" style="background-color: orange; border-radius: 20px; padding-bottom: 20px;">
        <form method="post" action="difundir.php">
<?php
$destino = isset($_SESSION['destino']) ? $_SESSION['destino'] : '';
//if ($destino != null){
//  header('Location: chat/chat.php');
//}

$query = "SELECT usuario2 FROM amigos WHERE usuario = '" . $_SESSION['username'] . "'";
$result = $conexion->query($query);
$count = mysqli_num_rows($result);
echo "<h2 style='text-align: center;'>Amigos</h2><hr>";
if ($count != null) {
  if ($resultado = $conexion->query($query)) {
    $num = 0;
    ?>
    <div id="checkboxes">
    <?php
    while ($fila = $resultado->fetch_row()) {
      ?>
        <div class="d-flex bd-highlight">
          <div class="img_cont">
            <?php
            echo "<img src='img/perfiles/" . $fila[0] . "/" . $fila[0] . ".jpg' class='rounded-circle user_img'>";
            $query = "SELECT usuario FROM usuarios_online WHERE usuario = '" . $fila[0] . "'";
            $result = $conexion->query($query);
            $count = mysqli_num_rows($result);
            if ($count != null) {
              printf ("<span class='online_icon'></span>");
              ?>
              </div>
              <div class="user_info">
                <span><?php echo $fila[0]; ?></span>
                <p><?php echo $fila[0] . " est&aacute; en l&iacute;nea"; ?></p>
              </div>
              <input type="checkbox" name="difundir[]" id=<?php echo $fila[0] ?> value=<?php echo $fila[0] ?>>
              <label class="casilla" for=<?php echo $fila[0] ?>></label>
              </div>
            <?php
            }
            else {
              printf ("<span class='online_icon offline'></span>");
              ?>
              </div>
              <div class="user_info">
                <span><?php echo $fila[0]; ?></span>
                <p><?php echo $fila[0] . " est&aacute; desconectad@"; ?></p>
              </div>
              <input type="checkbox" name="difundir[]" id=<?php echo $fila[0] ?> value=<?php echo $fila[0] ?>>
              <label class="casilla" for=<?php echo $fila[0] ?>></label>
            </div>
            <?php
            }
            ?>
      <?php
      }
      echo "</div>";
    $resultado->close();
  }
}
?>
</div>
  <div class="col-md-8" style="background-color: #1D9BD6; border-radius: 20px;">
  <h2 style='text-align: center;'>Mensaje a difundir</h2><hr>
  <textarea class="estilo" name="mensaje" placeholder="Escribe tu mensaje" required></textarea>
  <input type="submit" class="boton" value="Enviar">
</form>
</div></div>