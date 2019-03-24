<?php
include("connect.php");
include("online.php");
session_start();
usuarios_activos(); 

$usuario = isset($_GET['nombre']) ? $_GET['nombre'] : '';
if ($_SESSION['username'] == null){
  header('Location: index.php');
}
?>
<html>
<head>
  <meta http-equiv="refresh" content="30">
	<link rel='stylesheet' href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="chat/style.css">
  <script src="img/jquery.min.js"></script>
  <script src="bootstrap/js/bootstrap.js"></script>
	<style>
		body {background-color: coral;}
		img {width: 200px; height: 200px;}
    video {width: 200px; height: 200px;}
    audio {width: 200px; height: 200px;}
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
      <li class="nav-item active">
        <a class="nav-link" href="perfil.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="chat.php">Chat</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="explorar.php">Perfiles</a>
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
$query = "SELECT ruta, contenido, id, formato FROM publicaciones WHERE usuario = '" . $_SESSION['username'] . "'";
if ($resultado = $conexion->query($query)) {
	?>
	<div class="container">
  	<div class="row">
  		<div class="col-md-4">
  		<h2>Amigos</h2>
  		<?php
  			include 'amigos.php';
  		?>
  		</div>
  		<div class="col-md-8">
  			<h2>Galería del perfil</h2>
  			<form action="publicar.php" method="POST">
			     <input type="submit" value="Nueva publicaci&oacute;n" />
			  </form>
  			<div class="row">
	<?php
	while ($fila = $resultado->fetch_row()) {		
?>	
    <div class="col-md-4">
      <div class="thumbnail">
        <a href=<?php echo "publicacion.php?visualizar=" . $fila[2] ?> target="_blank">
          <input type="hidden" name="visualizar" value= <?php echo $fila[0] ?>>
          <?php 
          if ($fila[3] == 'imagen'){
            ?><img src=<?php echo $fila[0] ?> alt="Lights" style="width:100%"><?php
          } elseif ($fila[3] == 'audio'){
            ?><audio src=<?php echo $fila[0] ?> alt="Lights" style="width:100%" controls></audio><?php
          } elseif ($fila[3] == 'video'){
            ?><video src=<?php echo $fila[0] ?> alt="Lights" style="width:100%" controls></video><?php
          }
          ?>
          
          <div class="caption">
            <p><?php echo $fila[1] ?></p>
          </div>
        </a>
      </div>
    </div>
<?php  
}
	echo "</div></div>";
   	$resultado->close();
};
?>