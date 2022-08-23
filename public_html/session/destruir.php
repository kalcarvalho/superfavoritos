<?php
session_start();
if (isset($_SESSION['trajetoria'])){

	session_unset("trajetoria"); // Eliminar todas as variáveis da sessão
	session_destroy("trajetoria"); // Destruir a sessão
	header('Location: ../administrator/index.php');
  
} else {

	echo "Acesso não autenticado!";
  
}
?>