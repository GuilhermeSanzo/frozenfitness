<?php

	/* Verificando se a sessão já foi aberta */
	if(!isset($_SESSION)) {
	    session_start();
	}

	function connect(){
		$conecta = mysqli_connect('localhost', 'root', '', 'frozenfitness');
		// $conecta = mysqli_connect('192.168.0.2', 'ypfrozen', 'Pr0j3cts3cur1ty', 'dbypfrozen');
		// $conecta = mysqli_connect('10.107.134.15', 'root', 'bcd127', 'frozenfitness');
		// $conecta = mysqli_connect('10.107.144.8', 'root', 'bcd127', 'frozenfitness');
		// $conecta = mysqli_connect('10.107.134.19', 'root', 'bcd127', 'frozenfitness');
		// $conecta = mysqli_connect('192.168.0.82', 'root', 'bcd127', 'frozenfitness');
		// $conecta = mysqli_connect('10.107.144.29','root','bcd127','frozenfitness');
		// $conecta = mysqli_connect('10.107.134.7','root','bcd127','frozenfitness');

		// Definindo os caracteres da conexão como utf8
		mysqli_set_charset($conecta, "utf8");
		return $conecta;
	}

	function erro(){
		echo "<script type='text/javascript'> alert('Ocorreu alguma falha, tente novamente'); </script>";
	}

?>
