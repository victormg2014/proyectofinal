<?php
include("connect.php");
session_start();
if ($_SESSION['username'] == null){
  header('Location: index.php');
}
?>
<html>
<head>
	<link rel='stylesheet' href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="chat/style.css">
	<script src="img/jquery.min.js"></script>
	<script src="bootstrap/js/bootstrap.js"></script>
	<style>
		img {width: 200px; height: 200px;}
	</style>
</head>
<body>
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
      <li class="nav-item active">
        <a class="nav-link" href="explorar.php">Perfiles<span class="sr-only">(current)</span></a>
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
<?php
$consulta = "SELECT usuario2 FROM amigos WHERE usuario = '" . $_SESSION['username'] . "'";
if ($resultado = $conexion->query($consulta)) {
	?>
	<div class="container">
  	<div class="row">
  		<div class="col-md-4">
  			<h2>Amigos:</h2>
	<?php
	$num = 0;
   	while ($fila = $resultado->fetch_row()) {
   		$num = $num + 1;
      $formulario = 'formulario' . $num;
      printf ("<form name='" . $formulario . "' method='get'><input type='hidden' name='nombre' value='$fila[0]'></form>");
      ?>
      <li onClick='javascript:document.<?php echo $formulario ?>.submit();' class="lista">
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
            </div>
            <?php
            }
   	}
   	$resultado->close();
}
$usuario = isset($_GET['nombre']) ? $_GET['nombre'] : '';
$recibir = isset($_POST['nombre']) ? $_POST['nombre'] : '';
if ($recibir != null){
	$usuario = isset($_POST['nombre']) ? $_POST['nombre'] : '';
}

$query = "SELECT ruta, contenido, id FROM publicaciones WHERE usuario = '" . $usuario . "'";
if ($resultado = $conexion->query($query)) {
	?>
  	</div><div class="col-md-8">
  		<?php
  		if ($usuario != null){
  		 echo "<h2>Publicaciones de: <a style='color: blue'>$usuario </a></h2>";
  		} else {
  			echo "<h3>Haz clic sobre un usuario para ver sus publicaciones.</h3>";
  		}
  		?>
  		<div class="row">
	<?php
	while ($fila = $resultado->fetch_row()) {
		?>
    <div class="col-md-4">
      <div class="thumbnail">
        <a href=<?php echo "publicacion.php?visualizar=" . $fila[2] ?> target="_blank">
          <input type="hidden" name="visualizar" value= <?php echo $fila[0] ?>>
          <img src=<?php echo $fila[0] ?> alt="Lights" style="width:100%">
          <div class="caption">
            <p><?php echo $fila[1] ?></p>
          </div>
        </a>
      </div>
    </div>
    <?php
	}
	echo "</div></div></div></div>";
   	$resultado->close();
}
?>