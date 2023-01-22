<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Тестовое задание</title>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Merriweather&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="reset.css">
	<link rel="stylesheet" href="style1.css">
	<link rel="stylesheet" type="text/css"  href="style3.css">
</head>

<body>
<h1>Тестовое задание</h1>
<div class="elements">
<? $conn = new mysqli('localhost', 'root', 'root');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    $dbName = "testtask";
    $charset = "utf8";
	if (mysqli_select_db($conn, $dbName)) {
		$sql = "SELECT id FROM files";
		$result = $conn->query($sql);
		$max = 0;
		while ($row = $result->fetch_assoc()){
			if ($row["id"] > $max){
				$max = $row["id"];
			}
		}

        if (empty($_GET['level'])) {
            $sql = "SELECT * FROM files WHERE level=0";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
					if ($row["isparent"] == 1){ 
						
					echo '<div class="element">
						<div class="isfolder"> <img src="images\blue_documents_folder_12406.png" alt=""> </div>
						<div class="descr"> 
						<a href="index.php?level='.(1+$row["level"]).'&id='.$row["id"].'">'.$row["descr"].'</a> </div>
						</div>';
					}
                    else {
						echo '<div class="element">
						<div class="isfolder"> <img src="images\5c86abd7f23f51696e0f43b8.png" alt=""> </div>
						<div class="descr"> 
						<a href="'. $row["filepath"] .'" download>'.$row["descr"].'</a> </div>
						</div>';
					}
                }
            } else {
                echo "0 results";
            }
        } else {
			$sql = 'SELECT * FROM files WHERE level ='.$_GET["level"].' AND parentid =' .$_GET["id"];
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
					if ($row["isparent"] == 1){ 
						
					echo '<div class="element">
						<div class="isfolder"> <img src="images\blue_documents_folder_12406.png" alt=""> </div>
						<div class="descr"> 
						<a href="index.php?level='.(1+$row["level"]).'&id='.$row["id"].'">'.$row["descr"].'</a> </div>
						</div>';
					}
                    else {
						echo '<div class="element">
						<div class="isfolder"> <img src="images\5c86abd7f23f51696e0f43b8.png" alt=""> </div>
						<div class="descr"> 
							<a href="'. $row["filepath"] .'" download>'.$row["descr"].'</a> </div>
						</div>';
					}
                }
            } else {
                echo "0 results";
            }
		}
}}
?>



</div>
<div class= "forms">
	<div class="form">
	<p> Создать файл</p>
  <form class="file" action="addfile.php" method="post" enctype='multipart/form-data'>
  	<input type="text" class="text" name="filedescr"> 
	<input type="hidden" name="id" value="<? echo ($max+1); ?>">
	<input type="hidden" name="isparent" value="0">
	<input type="hidden" name="parentid" value="<? if (!empty($_GET['id'])) {echo $_GET['id'];}?>">
	<input type="hidden" name="level" value="<? if (empty($_GET['level'])){echo 0;} else {echo $_GET['level'];}?>">
	<input type="file" class = "text" name="filepath">
    <input type="submit" name="file" value="Создать" class="sub">
  </form>
</div>
<div class="form">
	<p>Создать папку</p>
  <form class="folder" action="addfile.php" method="post">
  	<input type="text"class="text" name="filedescr"> 
	  <input type="hidden" name="id" value="<? echo ($max+1); ?>">
	<input type="hidden" name="isparent" value="1">
	<input type="hidden" name="parentid" value="<? if (!empty($_GET['id'])) {echo $_GET['id'];}?>">
	<input type="hidden" name="level" value="<? if (empty($_GET['level'])){echo 0;} else {echo $_GET['level'];}?>">
    <input type="submit" name="folder" value="Создать" class="sub">
  </form>
</div>
</div>

</body>

</html>