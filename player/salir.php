<?php header("Content-Type: text/html; charset=utf-8");?>
<?php
    session_start();
   // inclu铆mos los datos de acceso a la BD
    // comprobamos que se haya iniciado la sesi贸n
    if(isset($_SESSION['usuarioLogueado'])) {
        session_destroy();
echo '<script language = javascript>

	self.location = "/"
	</script>';}
else
{
	echo '<script language = javascript>

	self.location = "/"
	</script>';}
?>