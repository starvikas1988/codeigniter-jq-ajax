<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>User</title>
</head>
<body>
	<h2>Users</h2>
	<ul>
	<?php
	print_r($users);
		foreach ($users as $key => $value) {
			?>
			<li>
				<?php echo $value; ?>
			</li>
			<?php
		}
	?>
</ul>
</body>
</html>