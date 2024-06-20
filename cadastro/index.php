<?php
include('config/config.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link link="styleshome" rel="stylesheet" type="text/css" />
<title><?php echo $nome_webSite." - Registro"; ?></title>
</head>
<body>

<div id="bg_info">
Faça seu cadastro agora mesmo, e venha fazer parte dessa historia. <?php echo $nome_server; ?>  !<br />
<i>Observaçao: preencha o formulario com dados corretos.</i>
</div>

<div id="box_out">

<div id="box_in">
<?php
if(isset($_GET['pag']))
{
	if(file_exists('pag/'.$_GET['pag'].'.php'))
	{
	include('pag/'.$_GET['pag'].'.php');
	}
	else
	{
		echo '<div id="msg_alert"><b>404 - Pagina não existe ou não foi encontrada..</b></div>';
	}
}
else
{
include('pag/cadastro.php');
}
?>
  <div style="clear:both"></div>
</div>

</div>

<div class="mgs_credito">Script desenvolvido pelo Kinho! e disponibilizado gratuitamente no forum L2JBrasil; favor manter os creditos.</div>

</body>
</html>