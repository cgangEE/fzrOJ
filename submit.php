<?php require_once 'user.php';?>

<?php

	if (!empty($_GET['pid']) && ($_POST['clang']>=0) && !empty($_POST['ctext'])){
		$pid=$_GET['pid'];
		$uid=$_SESSION['uid'];
		$ctext=mysql_escape_string($_POST['ctext']);
		$clang=$_POST['clang'];
		require_once 'tools/info.php';
		require_once 'tools/conn.php';

		$result = mysql_query("SELECT * FROM problem WHERE pid=$pid");
		if ($row = mysql_fetch_array($result)){
			$sql="INSERT INTO code (pid, uid, ctext, clang) VALUES ('$pid', '$uid', '$ctext', '$clang')";
			mysql_query($sql, $con);
			header("Location:status.php");
		}
		else
			echo 'sorry, this problem does not exist.<br/> <a href="index.php">go to index page</a>';

		exit();
	}
?>

<?php 
	$pid=$_GET['pid'];
?>
	
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo $pid?> - Submit | fzrOJ</title>
<link href="files/css.css" rel="stylesheet" type="text/css" />
</head>

<body>
	<div id="container">
		<?php require_once 'tools/head.php' ?>
		<div id="PageBody">
				<table width="100%"><tr><td align="center">
					<form method=POST action="submit.php?pid=<?php echo $pid ?>">
					<div>
						Problem ID:<input type=text name=pid value="<?php echo $pid ?>" disabled="disabled" size=20><br/>
						Language:
						<select size=1 name=clang>
							<option value=0>GCC</option>
							<option value=1 selected>G++</option>
							<option value=2>Java</option>
						</select><br/>
						Source:<br/>
						<textarea rows="30" cols="79" name="ctext"></textarea><br/>
						
						<input type="submit" value="Submit"/>
						<input type="reset" value="Reset" />
					</div>
					</form>
				</td></tr>
				</table>

		</div>
					
		<?php require_once 'tools/footer.php' ?>

	</div>
</body>
</html>		
