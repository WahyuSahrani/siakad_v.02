<?php 
	$conn	= mysqli_connect("localhost","id5850705_siakad_root","111995000","id5850705_siakad");

	function query($query){
	global $conn;
	$result = mysqli_query($conn, $query);
	$rows = [];
	while($row = mysqli_fetch_assoc($result)){
		$rows[] = $row;

	}
	return $rows;
}
 ?>