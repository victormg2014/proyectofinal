<link rel='stylesheet' href="../bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="chat/style.css">

<?php
include("../connect.php");
session_start();
	///consultamos a la base
	$consulta = "SELECT * FROM chat WHERE (usuario = '" . $_SESSION['username'] . "' AND destino = '" . $_SESSION['destino'] . "') OR (usuario = '" . $_SESSION['destino'] . "' AND destino = '" . $_SESSION['username'] . "') ORDER BY id DESC";
	$ejecutar = $conexion->query($consulta); 
	echo "<table id='chat'>";
	while($fila = $ejecutar->fetch_array()) : 
		if($fila['usuario'] != $_SESSION['username']){
?>
		<div class="d-flex justify-content-start mb-4">
			<div class="img_cont_msg">
				<?php
				echo "<img src='img/perfiles/" . $fila['usuario'] . "/" . $fila['usuario'] . ".jpg' class='rounded-circle user_img_msg'>";
				?>
			</div>
			<div class="msg_cotainer" style="min-width: 100px; max-width: 80%;">
				<?php echo $fila['mensaje']; ?>
			<span class="msg_time"><?php echo formatearFecha($fila['fecha']); ?></span>
			</div>
		</div>
		<?php
		} else {
			?>
			<div class="d-flex justify-content-end mb-4">
					<div class="msg_cotainer_send" style="min-width: 100px; max-width: 80%;">
						<?php echo $fila['mensaje']; ?>
					<span class="msg_time_send"><?php echo formatearFecha($fila['fecha']); ?></span>
					</div>
					<div class="img_cont_msg">
						<?php
						echo "<img src='img/perfiles/" . $fila['usuario'] . "/" . $fila['usuario'] . ".jpg' class='rounded-circle user_img_msg'>";
						?>
					</div>
				</div>
			<?php
		}
		?>
		<?php endwhile; ?>