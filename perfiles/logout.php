<?php
	session_start();
	session_destroy();
?>

<script language="javascript">
	alert("Sesion Finalizada");
	location.href = "../index.php";
</script>;
