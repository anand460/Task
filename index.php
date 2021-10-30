<?php
	$errors="";

	//connect to the database

	$db=mysqli_connect('localhost','root','','todo');
	if(isset($_POST['submit'])){
		$task=$_POST['task'];
		if(empty($task)){
			$errors = "You must fill in task first";
		}else {
			mysqli_query($db,"INSERT INTO tasks(task)VALUES('$task')");
		    header('location:index.php');
		}
	}
	if(isset($_GET['del_task'])) {
		$id = $_GET['del_task'];
		mysqli_query($db,"DELETE FROM tasks where id = $id");
		header('location:index.php');
	}
	$tasks = mysqli_query($db,"select * from tasks");


?>
<!DOCTYPE html>
<html>
<head>
	<title>TO DO LIST</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class ="heading">
		<h2>TO_DO_LIST</h2>
	</div>	
	<form method="POST" action="index.php">
	<?php if (isset($errors)) { ?>
		<p><?php echo $errors; ?></p>
		<?php } ?>
		<input type ="text" name="task" class="task_input">
		<button type="submit" class="add_btn" name="submit">ADD</button>
	</form>
	<table>
		<thead>
			<tr>
				<th><b>N0:</b></th>
				<th><b>TO DO TASK </b></th>
				<th><b> Action </b></th>
			</tr>
		</thead>

		<tbody>
		<?php $i =1; while($row = mysqli_fetch_array($tasks)) { ?> 
			<tr>
				<th><?php echo $row['id']; ?></th>
				<th class="task"><?php echo $row['task']; ?></th>
				<th class="delete">
					<a href="index.php?del_task=<?php echo $row['id'];?>">Delete</a>
				</th>
			</tr>
			<?php $i++; } ?>
		</tbody>
	</table>
</body>
</html>