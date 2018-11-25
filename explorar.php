<?php
include("connect.php");
session_start();
?>
<html>
<head>
	<link rel='stylesheet' href="bootstrap/css/bootstrap.min.css">
	<style>
		body {background-color: coral;}
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
  			<h2>Amigos</h2>
	<?php
	echo "<table>";
   	while ($fila = $resultado->fetch_row()) {
   		printf ("<tr><td>" . $fila[0] . "</td><td><form method='get'><input type='hidden' name='nombre' value='$fila[0]'><input type='submit' value='Ver perfil'></form></td></tr>");
   	}
   	echo "</table>";
   	$resultado->close();
}
$usuario = isset($_GET['nombre']) ? $_GET['nombre'] : '';

$query = "SELECT ruta FROM publicaciones WHERE usuario = '" . $usuario . "'";
if ($resultado = $conexion->query($query)) {
	?>
  	</div><div class="col-md-8">
  		<?php
  		if ($usuario != null){
  		 echo "<h2>Publicaciones de: <a style='color: blue'>$usuario </a></h2>";
  		}
  		?>
  		<div class="row">
	<?php
	while ($fila = $resultado->fetch_row()) {
		?>
    	<div class="col-md-4">
      		<div class="thumbnail">
        		<a href="/w3images/lights.jpg" target="_blank">
          		<img src=<?php echo $fila[0] ?> alt="Lights" style="width:100%"><form method='get'>
          		<div class="caption">
            		<p>Lorem ipsum donec id elit non mi porta gravida at eget metus.</p>
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