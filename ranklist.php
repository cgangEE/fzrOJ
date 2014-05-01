<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title> Ranklist | fzrOJ</title>
<link href="files/css.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<div id="container">
		<?php require_once 'tools/head.php' ?>
		<div id="PageBody">
			<p>
			<table width="100%" id="table">
			<tr>
				<th width="25%" >No.</th>
				<th width="25%" >User ID</th>
				<th width="25%" >Motto</th>
				<th width="25%" >Solved</th>
			</tr>		
			<?php
				require_once 'tools/info.php';
				require_once 'tools/conn.php';
				require_once 'tools/func.php';

				if (!empty($_GET['rid']))
					$rid = $_GET['rid'];
				else
					$rid = 0;

				$sql = "SELECT uname, count(DISTINCT pid) problem, umotto
				FROM code, user 
				WHERE code.uid=user.uid 
				AND cstatus=3
				GROUP BY user.uid
				ORDER BY COUNT(DISTINCT pid) DESC
				";

				$result = mysql_query($sql);
				$no = 0;
				$flag =1;

				
				while ($row = mysql_fetch_array($result)){
					$no ++;
					if ($no==($rid+1)*15+1){ 
						$flag=0; break;
					}

					if ($no>=$rid*15+1 )
						echo 
							'<tr>'.
							'<td width="25%">'. $no . '</td>'.
							'<td width="25%">'.$row[uname].'</td>'.
							'<td width="25%">' . $row[umotto]. '</td>'.
							'<td width="25%">'. $row[problem]. '</td></tr>';
						

				}
				
			?>
			</table>
			<p id="subs">
				<a href="ranklist.php">[Top]</a>&nbsp;&nbsp;&nbsp;
				<a href="ranklist.php?rid=<?php 
					echo max(0, $rid-1);
					?>">[Previous Page]</a>&nbsp;&nbsp;&nbsp;

				
				<?php 
					if ($flag==0) $rid++;
					$s="<a href='ranklist.php?rid=$rid'>[Next Page]</a>";
					echo $s;
				?>
			</p>
			</p>
			
		
		</div>
		<?php require_once 'tools/footer.php' ?>

	</div>
</body>
</html>				
