	<?php
	require_once 'db_config.php';
	//setting connection
	$db_stat= "host=$db_host port=$db_port dbname=$db_name user=$db_user password=$db_pass";
	$db_conn = pg_connect($db_stat);
	?>