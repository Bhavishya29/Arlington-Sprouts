<!DOCTYPE html>
<html>
<head>
	<center><img src="sprouts.webp"  width="500" height="300"/></center>
	<title>Arlington Sprouts</title>
	<style type="text/css">
		body {
			background-color: #BDB76B;
			font-family: Arial, sans-serif;
			font-size: 14px;
			line-height: 1.5;
			margin: 0;
			padding: 0;
			
		}
                
		h1, h2 {
			color: #000000;
			margin: 20px 0;
			text-align: center;
		}

		table {
			border-collapse: collapse;
			margin: 20px auto;
			width: 80%;
		}

		table th, table td {
			border: 1px solid #999999;
			padding: 10px;
			text-align: center;
		}

		form {
			margin: 20px auto;
			text-align: center;
			width: 80%;
		}

		form input[type="text"], form input[type="submit"] {
			border: 1px solid #999999;
			padding: 5px;
			width: 50%;
		}

		form input[type="submit"] {
			background-color: #556B2F;
			color: #F8F8FF;
			cursor: pointer;
			margin: 10px;
			padding: 10px;
		}

		form input[type="submit"]:hover {
			background-color:#8FBC8F;
		}

		.error {
			color: red;
			font-weight: bold;
			margin: 10px auto;
			text-align: center;
		}
	</style>
</head>
<body>
	<h1>Arlington Sprouts</h1>

	<!-- search form -->
	<form method="post">
		<input type="text" name="search" placeholder="Enter name or ID">
		<input type="submit" value="Search">
	</form>

	<!-- insert form -->
	<form method="post">
		<input type="text" name="id" placeholder="Enter id">
		<input type="text" name="name" placeholder="Enter name">
		<input type="text" name="price" placeholder="Enter price">
		<input type="submit" name="insert" value="Insert">
	</form>

	<!-- update form -->
	<form method="post">
		<input type="text" name="id" placeholder="Enter ID to update">
		<input type="text" name="name" placeholder="Enter new name">
		<input type="submit" name="update" value="Update">
	</form>

	<!-- delete form -->
	<form method="post">
		<input type="text" name="id" placeholder="Enter ID to delete">
		<input type="submit" name="delete" value="Delete">
	</form>

<?php
//connect to database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ArlingtonSprouts";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//process search form
if(isset($_POST['search'])){
    $search = $_POST['search'];
    //query to retrieve ITEM details
    $sql = "SELECT * FROM ITEM WHERE Iname='$search' OR iId='$search'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        //output retrieved ITEM details
        echo "<table>";
        echo "<tr><th>Name</th><th>ID</th><th>Price</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["Iname"]. "</td><td>" . $row["iId"]. "</td><td>" . $row["Sprice"]. "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "<center> No results found. </center>";
    }
}

//process insert form
if(isset($_POST['insert'])){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    //query to insert new ITEM
    $sql = "INSERT INTO ITEM (iId,Iname, Sprice) VALUES ('$id','$name', '$price')";
    if ($conn->query($sql) === TRUE) {
        echo "<p class='success'><center>New ITEM added successfully.</center></p>";
    } else {
        echo "<p class='error'>Error: " . $sql . "<br>" . $conn->error . "</p>";
    }
}

//process update form
if(isset($_POST['update'])){
    $id = $_POST['id'];
    $name = $_POST['name'];
    //query to update ITEM record
    $sql = "UPDATE ITEM SET Iname='$name' WHERE iId='$id'";
    if ($conn->query($sql) === TRUE) {
        echo "<p class='success'><center>ITEM record updated successfully.</center></p>";
    } else {
        echo "<p class='error'>Error: " . $sql . "<br>" . $conn->error . "</p>";
    }
}

//process delete form
if(isset($_POST['delete'])){
    $id = $_POST['id'];
    //query to delete ITEM record
    $sql = "DELETE FROM ITEM WHERE iId='$id'";
    if ($conn->query($sql) === TRUE) {
        echo "<p class='success'><center>ITEM record deleted successfully.</center></p>";
    } else {
        echo "<p class='error'>Error: " . $sql . "<br>" . $conn->error . "</p>";
    }
}

$conn->close();
?>
</body>
</head>
</html>
