<?php 
	//print_r($argv); die;
	
    $reverse_ip = $argv[1];
	$host_url 	= $argv[2];

    if (checkdnsrr($reverse_ip . "." . $host_url . ".", "A")) 
		print(1);
	else 
		print(0);