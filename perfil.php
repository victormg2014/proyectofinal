<html>
<head>
	<style>
		body {background-color: coral;}
	</style>
</head>
<body>
<?php
include("connect.php");
session_start();
echo "<div align='center'>";
echo "Bienvenido: " . $_SESSION['username'] . "<br/>";
echo "<a href='logout.php'>Cerrar Sesión</a>";
echo "</div>";
?>
</body>
</html>