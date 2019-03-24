include("connect.php");
<?php
$usuario = isset($_POST['usuario']) ? $_POST['usuario'] : '';
$clave = isset($_POST['clave']) ? $_POST['clave'] : '';

session_start();
$ldap_dn = "cn=$usuario,ou=usuarios,dc=social,dc=com";
$ldap_con = ldap_connect("servidor.social.com");
ldap_set_option($ldap_con, LDAP_OPT_PROTOCOL_VERSION, 3);
if(ldap_bind($ldap_con, $ldap_dn, $clave)) {
	$_SESSION['username'] = $usuario;
	header('Location: perfil.php');
} else {
	echo "Usuario o contrase&ntilde;a inv&aacute;lidos";
}
?>
