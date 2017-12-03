<?php

$hostname="localhost";
$username="root";
$password="";
$databasename="gallery";


$conn= new mysqli($hostname,$username,$password,$databasename);

$caption=$_POST['caption'];
//$photo=$_POST['photo'];


$target_dir = "upload/";

$target_file = $target_dir . basename($_FILES['photo']['name']);

$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

$status=move_uploaded_file($_FILES['photo']['tmp_name'], $target_file);


$g="insert into gallerytable (caption,photo) values ('$caption','$target_file')";


if($conn->query($g))
{
echo " row inserted. {$status}<br>";
}
else{
    echo "not insert.{$status}<br>";
    echo $conn->error;
    echo $g;
}
?>