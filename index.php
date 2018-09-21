<?php
	$conn = mysqli_connect("localhost", "root", "", "database2");

	if ($conn->connect_error) {
    	die("Connection failed: ".$conn->connect_error);
	} 
	echo "Connected successfully";

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form method="POST" action="index.php" enctype="multipart/form-data">
		Nama: <input type="text" name="nama"><br>
		nim: <input type="text" name="nim"  onkeypress='return event.charCode >= 48 && event.charCode <= 57'><br>
		gambar: <input type="file" name="gambar" required><br>
		<button type="submit" name="submit">SUBMIT</button>
	</form>
	<?php 
		if (isset($_POST['submit'])) {
			$target_dir = "gambar/";
			$target_file = $target_dir.basename($_FILES['gambar']['name']);
			// $gambar = $_POST['gambar'];
			$nama = $_POST['nama'];
			$nim = $_POST['nim'];

			$sqlinp = "INSERT INTO data1(nama,nim,gambar) VALUES ('$nama', '$nim', '".addslashes($target_file)."')";
			$sqlout = mysqli_query($conn, "SELECT * FROM data1");
		
			while($row = mysqli_fetch_assoc($sqlout)) {
		        echo "nama:" .$row['nama']."<br>";
		        echo "nim:".$row['nim']."<br>";
		        echo "gambar: <img src=' ".$row['gambar']." ' height='100' width='100'><br>";
            }
            

			if (mysqli_query($conn, $sqlinp)) {
			    echo "New record created successfully";
			} else {
			    echo "Error: " . $sqlinp . "<br>" . mysqli_error($conn);
			}
			echo "<br>";

			
			
			// if (move_uploaded_file($_FILES['gambar']['tmp.name'], $target_file)) {
				
			// }
			
			mysqli_close($conn);	
		}
	?>
</body>
</html>