<?php

	function connect(){
		$conecta = mysqli_connect('localhost', 'root', '', 'frozenfitness');
		// $conecta = mysqli_connect('192.168.0.100', 'ypfrozen', 'Pr0j3cts3cur1ty', 'dbypfrozen');
		// $conecta = mysqli_connect('10.107.134.25', 'root', 'bcd127', 'frozenfitness');
		// $conecta = mysqli_connect('192.168.0.100', 'root', 'bcd127', 'dbypfrozen');
		// $conecta = mysqli_connect('10.107.134.26','root','bcd127','frozenfitness');
		// $conecta = mysqli_connect('10.107.134.7','root','bcd127','frozenfitness');
		return $conecta;
	}

	function erro(){
		echo "<script type='text/javascript'> alert('Ocorreu alguma falha, tente novamente'); </script>";
	}

?>
