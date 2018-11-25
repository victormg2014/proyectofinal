<html>
<head>
	<link rel='stylesheet' href="bootstrap/css/bootstrap.min.css">
	<style>
		body {background-color: coral;}
	</style>
</head>
<body>
<?php
include("connect.php");
session_start();
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
      <li class="nav-item active">
        <a class="nav-link" href="chat.php">Chat<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="explorar.php">Perfiles</a>
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
  		<div class="col-md-4">
<?php
$destino = isset($_SESSION['destino']) ? $_SESSION['destino'] : '';
//if ($destino != null){
//	header('Location: chat/chat.php');
//}
$query = "SELECT usuario2 FROM amigos WHERE usuario = '" . $_SESSION['username'] . "'";
$result = $conexion->query($query);
$count = mysqli_num_rows($result);
if ($count != null) {
	if ($resultado = $conexion->query($query)) {
		echo "<table><h2>Amigos:</h2>";
		while ($fila = $resultado->fetch_row()) {
	    	printf ("<tr><td>" . $fila[0] . "</td><td><form method='post' action='chat/iniciar.php'><input type='hidden' name='destino' value='" . $fila[0] . "'><input type='submit' value='Chatear'></form></td></tr>");
		}
		echo "</table>";
	   	$resultado->close();
	}
}
?>
</div>
	<div class="col-md-8">
		
	<?php
	include 'chat/chat.php';
	?>

</div></div>