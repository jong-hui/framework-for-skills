<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<?php foreach ($list as $key => $value): ?>
		<br><a href="<?=$value?>"><?=$key?></a>
	<?php endforeach ?>
</body>
</html>