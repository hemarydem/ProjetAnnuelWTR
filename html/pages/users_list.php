<?php
	require('../includes/config.php');
	session_start();
	$q = 'SELECT email,login,creationDate,userLevel,working,token FROM USERS';
	$req = $bdd-> query($q);
	$result = $req-> fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
	<head>
		<?php
			include('../includes/head.php');
		?>
		<link rel="stylesheet" href="../style/css/userList.css">
	</head>
	<body>

		<?php
			include('../includes/header.php');
		?>


		<h1>Users</h1>

			<table>
				<tr>
					<th>Email</th>
					<th>Login</th>
					<th>Date</th>
					<th>Level</th>
					<th>Actif</th>
					<th>Token</th>
				</tr>
			<?php
			foreach ($result as $key => $value) {
			?>
				<tr>
					<td><?php echo $value['email']; ?></td>
					<td><?php echo $value['login']; ?></td>
					<td><?php echo $value['creationDate']; ?></td>
					<td><?php echo $value['userLevel']; ?></td>
					<td><?php echo $value['working']; ?></td>
					<td><?php echo $value['token']; ?></td>
				</tr>

			<?php
			}
			?>
			</table>
	</body>
</html>
