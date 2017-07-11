<?php session_start();?>

<table>
	<tr>
		<td><h1 style="font-weight: bold;text-align: center;font-family: Arial;">MediaQueue</h1></td><?php if(isset($_SESSION['google_data'])){ ?>
		<td><img style="width: 50px; height: 50px; -webkit-border-radius: 50%; border-radius: 50%;" src="<?php echo $_SESSION['google_data']['picture']; ?>" width="50px" size="50px" /></td>
		<td style="font-size: 16px;font-weight: bold;min-height: 1em;font-family: Arial;">
			Welcome <a style="text-decoration: none;" href="<?php echo $_SESSION['google_data']['link']; ?>" /><?php echo $_SESSION['google_data']['given_name']; ?></a>! 
		</td><?php }?>
	</tr>
</table>
