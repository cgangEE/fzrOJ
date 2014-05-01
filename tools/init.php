<?php
	require_once 'info.php';
	$con=mysql_connect($host, $user, $pwd);
	if (!$con)
		die('ft' . mysql_error());

	mysql_query("CREATE DATABASE $db_name DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci",$con);
	mysql_select_db($db_name, $con);


	$sql_problems="CREATE TABLE problem
	(
		pid int PRIMARY KEY NOT NULL AUTO_INCREMENT,
		pname varchar(255),
		ptime int,
		pmem int,
		ptext text,
		psource text,
		pdate timestamp DEFAULT CURRENT_TIMESTAMP
	)";

	$sql_users="CREATE TABLE user
	(
		uid int PRIMARY KEY NOT NULL AUTO_INCREMENT,
		uname varchar(255),
		upwd varchar(255),
		uemail varchar(255),
		umotto varchar(255),
		uadmin int DEFAULT 0,
		udate timestamp DEFAULT CURRENT_TIMESTAMP
	)";

	$sql_codes="CREATE TABLE code
	(
		cid int PRIMARY KEY NOT NULL AUTO_INCREMENT,
		pid int,
		uid int,
		ctext text,
		clang varchar(255),
		cstatus int NOT NULL DEFAULT 0, 
		ctime int,
		cmem int,
		cdate timestamp DEFAULT CURRENT_TIMESTAMP,
		FOREIGN KEY (pid) REFERENCES problem(pid),
		FOREIGN KEY (uid) REFERENCES user(uid)
	)";

	$sql_test="CREATE TABLE test
	(
		tid int PRIMARY KEY NOT NULL AUTO_INCREMENT,
		tbegin datetime,
		tlength time
	)";

	$sql_belong="CREATE TABLE belong
	(
		pid int,
		tid int,
		PRIMARY KEY (pid, tid),
		FOREIGN KEY(pid) REFERENCES problem(pid),
		FOREIGN KEY(tid) REFERENCES test(tid)
	)";
	
	mysql_query($sql_problems,$con); mysql_query($sql_users,$con);
	mysql_query($sql_codes,$con);
	mysql_query($sql_test,$con);
	mysql_query($sql_belong,$con);
	
	mysql_close($con);
?>
