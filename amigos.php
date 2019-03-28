<html>
<head>
	<style>
		body {background-color: coral;}
		.miniatura {width: 25px; height: 25px;}
		#icono{
			list-style:none;
		}
		#hover-content {
    		display:none;
		}
		#icono:hover #hover-content {
    		display:block;
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
	<link rel='stylesheet' href="bootstrap/css/bootstrap.min.css">
</head>
<body>
<form method="get">
	<div align="center">
		<input type="text" name="nombre" style="border: 2px solid #990000;" placeholder="Buscar usuario">
		<input type="submit" class="boton" value="Enviar">
	</div>
</form>
<?php
$usuario = isset($_GET['nombre']) ? $_GET['nombre'] : '';

// Validar si el usuario que se va a agregar existe, si ya tiene una petición, o si ya es amigo.
if ($usuario != $_SESSION['username']){
	$comprobar = "SELECT * FROM cuenta WHERE usuario = '$usuario'";
	$result = $conexion->query($comprobar);
	$count = mysqli_num_rows($result);
	if ($count != null) {
		$comprobar = "SELECT * FROM amigos WHERE usuario = '" . $_SESSION['username'] . "' AND usuario2 = '$usuario'";
		$result = $conexion->query($comprobar);
		$count = mysqli_num_rows($result);
		if ($count != null) {
			echo "<div align='center'>Este usuario ya es tu amigo.</div>";
		}
		else {
			$comprobar = "SELECT * FROM solicitudes WHERE usuario = '" . $_SESSION['username'] . "' AND destino = '$usuario'";
			$result = $conexion->query($comprobar);
			$count = mysqli_num_rows($result);
			if ($count == 1) {
				echo "<div align='center'>Este usuario ya ha recibido una petici&oacute;n de amistad.</div>";
			}
			else{
				if ($usuario != null){
					$query = "INSERT INTO solicitudes (usuario, destino) VALUES ('". $_SESSION['username'] . "', '$usuario')";
					if ($conexion->query($query) === TRUE) {
						echo "<div align='center'>Se ha enviado correctamente la solicitud de amistad.</div>";
					}
					else {
						echo "<div align='center'>Error al enviar la solicitud de amistad.</div>";
					}
				}
			}
		}
	}
	else {
		echo "<div align='center'>El usuario $usuario no existe.</div>";
	}
}
else {
	echo "<div align='center'>No puedes agregarte a ti mismo.</div>";
}

// Mostrar lista de amigos
$query = "SELECT usuario2 FROM amigos WHERE usuario = '" . $_SESSION['username'] . "'";
$result = $conexion->query($query);
$count = mysqli_num_rows($result);
if ($count != null) {
	if ($amigos = $conexion->query($query)) {
		$num = 0;
		echo "<hr><table>";
		while ($fila = $amigos->fetch_row()) {
			$num = $num + 1;
      		$perfil = 'perfil' . $num;
      		$borrar = 'borrar' . $num;
      		$chatear = 'chatear' . $num;
			echo "<tr><td>";
			$num = $num + 1;
      $formulario = 'formulario' . $num;
      printf ("<form name='$borrar' method='post' action='borrar.php'><input type='hidden' name='usuario' value= '$fila[0]'></form>");
      printf ("<form name='" . $chatear . "' method='post' action='chat/iniciar.php'><input type='hidden' name='destino' value='" . $fila[0] . "'></form>");
      printf ("<form name='" . $perfil . "' method='post' action='explorar.php'><input type='hidden' name='nombre' value='$fila[0]'></form>");
      ?>
      <li style="list-style:none;">
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
                <p><?php echo "En l&iacute;nea"; ?></p>
              </div>
              </td><td>
              	<span onClick='javascript:document.<?php echo $perfil ?>.submit();' id='icono' alt="Ver perfil" title="Ver perfil">
              	<img src='img/casa.png' class='miniatura' >
              	</span><span onClick='javascript:document.<?php echo $chatear ?>.submit();' id='icono' alt="Enviar mensaje" title="Enviar mensaje">
              	<img src='img/email.png' class='miniatura'>
              	</span><span onClick='javascript:document.<?php echo $borrar ?>.submit();' id='icono' alt="Borrar amigo" title="Borrar amigo">
              	<img src='img/cancelar.png' class='miniatura'>
              	</span>
              </td></tr>
              </div>
            <?php
            }
            else {
              printf ("<span class='online_icon offline'></span>");
              ?>
              </div>
              <div class="user_info">
                <span><?php echo $fila[0]; ?></span>
                <p><?php echo "Offline"; ?></p>
              </div>
              </td><td>
              	<span onClick='javascript:document.<?php echo $perfil ?>.submit();' class='icono' alt="Ver perfil" title="Ver perfil">
              	<img src='img/casa.png' class='miniatura' >
              	</span><span onClick='javascript:document.<?php echo $chatear ?>.submit();' class='icono' alt="Enviar mensaje"  title="Enviar mensaje">
              	<img src='img/email.png' class='miniatura'>
              	</span><span onClick='javascript:document.<?php echo $borrar ?>.submit();' class='icono' alt="Borrar amigo"  title="Borrar amigo">
              	<img src='img/cancelar.png' class='miniatura'>
              	</span>
              </td></tr>
            </div>
            <?php
            }
            ?>
      </li>
      <?php
		}
		echo "</table>";
	   	$amigos->close();
	}
}

// Mostrar peticiones de amistad recibidas
$query = "SELECT usuario, destino FROM solicitudes WHERE destino = '" . $_SESSION['username'] . "' AND respuesta IS NULL";
$result = $conexion->query($query);
$count = mysqli_num_rows($result);

if ($count != null) {
	if ($amigos = $conexion->query($query)) {
		echo "<hr>";
		while ($fila = $amigos->fetch_row()) {
			?>
			<li style="list-style:none;">
	        <div class="d-flex bd-highlight">
	        <div class="img_cont">
	        <?php
	        $aceptar = $fila[0] . "a";
	        $rechazar = $fila[0] . "r";
	        printf ("<form name='$aceptar' method='post' action='responder.php'><input type='hidden' name='aceptar' value='$fila[0]'></form>");
	        printf ("<form name='$rechazar' method='post' action='responder.php'><input type='hidden' name='rechazar' value='$fila[0]'></form>");
			$sentencia = $pdo->query("SELECT ruta_foto FROM cuenta WHERE usuario = '$fila[0]'");
			$datos = $sentencia->fetch();
			$mostrar = $datos['ruta_foto'];
			echo "<img src='$mostrar' class='rounded-circle user_img'></div><div class='user_info'>";
	    	echo "<span>" . $fila[0] . "</span></div><div class='user_info'>";
	    	?>
	    	<span onClick='javascript:document.<?php echo $aceptar ?>.submit();' id='icono' alt="Aceptar" title="Aceptar">
            <img src='img/aceptar.png' class='miniatura' ></span>
            <span onClick='javascript:document.<?php echo $rechazar ?>.submit();' id='icono' alt="Rechazar" title="Rechazar">
            <img src='img/cancelar.png' class='miniatura' ></span>
	    	<?php
	    	echo "</div></li>";
		}
		
	   	$amigos->close();
	}
}

// Mostrar peticiones de amistad enviadas
$query = "SELECT usuario, destino FROM solicitudes WHERE usuario = '" . $_SESSION['username'] . "' AND respuesta IS NULL";
$result = $conexion->query($query);
$count = mysqli_num_rows($result);

if ($count != null) {
	if ($amigos = $conexion->query($query)) {
		echo "<hr>";
		while ($fila = $amigos->fetch_row()) {
			?>
			<li style="list-style:none;">
	        <div class="d-flex bd-highlight">
	        <div class="img_cont">
	        <?php
	        $cancelar = $fila[1] . "c";
	        printf ("<form name='$cancelar' method='post' action='cancelar.php'><input type='hidden' name='nombre' value='$fila[1]'></form>");
			$sentencia = $pdo->query("SELECT ruta_foto FROM cuenta WHERE usuario = '$fila[1]'");
			$datos = $sentencia->fetch();
			$mostrar = $datos['ruta_foto'];
			echo "<img src='$mostrar' class='rounded-circle user_img'></div><div class='user_info'>";
	    	echo "<span>" . $fila[1] . "</span>";
			?>
			<span onClick='javascript:document.<?php echo $cancelar ?>.submit();' id='icono' alt="Cancelar" title="Cancelar">
            <img src='img/cancelar.png' class='miniatura' ></span>
            <?php
	    	echo "</div></li>";
		}
	   	$amigos->close();
	}
}

?>
</body>
</html>