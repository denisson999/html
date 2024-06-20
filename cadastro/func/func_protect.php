<?php

function anti_inject_text($parametro, $conn)
{
	$dados = htmlentities(trim($parametro));
	$dados = mysqli_real_escape_string($conn, strip_tags($dados));
	return $dados;
}

function anti_inject_senha($dados, $conn)
{
	$parametro = htmlentities(trim($dados));
	$parametro = mysqli_real_escape_string($conn, strip_tags($dados));
	$parametro = base64_encode(pack("H*", sha1($dados)));
	return $parametro;
}

?>
