<?php
$usuario = isset($_POST['usuario']) ? $_POST['usuario'] : '';
$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
$clave = isset($_POST['clave']) ? $_POST['clave'] : '';
$imagen = isset($_POST['foto']) ? $_POST['foto'] : '';
if ($usuario == null){
	header('Location: index.php');
}
?>
<html>
<head>
	<style>
		body {background-color: coral;}
	</style>
</head>
<body>
<?php
include("connect.php");

$tabla = "cuenta";

if ($conexion->connect_error) {
	die("La conexion falló: " . $conexion->connect_error);
}

$query = "SELECT max(id) as maximo from cuenta";
if ($resultado = $conexion->query($query)) {
	while ($fila = $resultado->fetch_row()) {
		$siguiente = $fila[0] + 1;
	}
   	$resultado->close();
}

$ldap_con = ldap_connect("servidor.social.com");
$ldap_dn = "cn=admin,dc=social,dc=com";
ldap_set_option($ldap_con, LDAP_OPT_PROTOCOL_VERSION, 3);
if(ldap_bind($ldap_con, $ldap_dn, "victor")) {
	$comprobar=ldap_search($ldap_con,"ou=Usuarios,dc=social,dc=com", "cn=$usuario");
	$existe = ldap_count_entries($ldap_con,$comprobar);
	if ($existe == 0){
		// Crea un directorio para insertar las imágenes con el nombre del usuario
		if (!file_exists('img/perfiles/' . $usuario)) {
		    mkdir('img/perfiles/' . $usuario, 0777, true);
		}

		// Utiliza el nuevo id para renombrar la imagen que va a subir y la ruta
		$imagen = $usuario . '.jpg';
		$publicacion = 'img/perfiles/' . $usuario . '/' . $imagen;

		$target_path = 'img/perfiles/' . $usuario . "/";
		$target_path = $target_path . $imagen;
		if(move_uploaded_file($_FILES['foto']['tmp_name'], $target_path)) { 
			echo "El archivo ". basename( $_FILES['foto']['name']). " ha sido subido";
		} else{
			echo "Ha ocurrido un error, intentelo de nuevo";
		}
		$clave ="{MD5}" . base64_encode(pack("H*",md5($clave)));
		
        $info["cn"] = $usuario;
        $info["sn"] = $nombre;
        $info["objectclass"] = "person";
        $info["userPassword"] = $clave;
        
        ldap_add($ldap_con, "cn=$usuario,ou=Usuarios,dc=social,dc=com", $info);
        $query = "INSERT INTO cuenta (usuario, nombre, ruta_foto) VALUES ('$usuario', '$nombre' ,'$target_path')";
        $conexion->query($query);
        header('Location: index.php');
    } else {
    	echo "Este usuario ya existe<form method='post' action='registro.php'><input type='submit' value='Volver'></form>";
    }
} else {
        echo "No se ha podido conectar con el servidor LDAP";
}

mysqli_close($conexion);
?>

</body>
</html>
