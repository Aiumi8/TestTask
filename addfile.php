<?php
$conn = new mysqli('localhost', 'root', 'root');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    $dbName = "testtask";
    $charset = "utf8";
	if(move_uploaded_file($_FILES['filepath']['tmp_name'], 'loadedfiles/' . $_POST["filedescr"] ))
				{
					$filepath = "http://testtask/loadedfiles/" . $_POST["filedescr"];
					echo $filepath;
				}
	if (!$_POST["parentid"])
	{
		$_POST["parentid"] = 0;
	}
	if (mysqli_select_db($conn, $dbName)) {
		if (!$filepath)
		{
		$sql = 'INSERT INTO `files` (`id`, `isparent`, `level`, `parentid`, `descr`) VALUES (\''.$_POST["id"].'\', \''.$_POST["isparent"].'\', \''.$_POST["level"].'\', \''.$_POST["parentid"].'\', \''.$_POST["filedescr"].'\');';
		} else {
			$sql = 'INSERT INTO `files` (`id`, `isparent`, `level`, `parentid`, `descr`, `filepath`) VALUES (\''.$_POST["id"].'\', \''.$_POST["isparent"].'\', \''.$_POST["level"].'\', \''.$_POST["parentid"].'\', \''.$_POST["filedescr"].'\', \''.$filepath.'\');';	
			echo "<br/>".$sql;
		}
		$result = $conn->query($sql);}
	
	if ($_POST["isparent"] == 0){
		echo "Файл создан" ;
	} else {
		echo "Папка создана" ;
	}
	
	
}
?>