<?php
include 'koneksi.php';
header('Content-Type: application/json; charset=utf-8');
http_response_code(400);

$course = null;
$latitude = null;
$longitude = null;
$mmsi = null;
$type = null;

if(isset($_GET['course'])) $course = $_GET['course'];
if(isset($_GET['latitude'])) $latitude = $_GET['latitude'];
if(isset($_GET['longitude'])) $longitude = $_GET['longitude'];
if(isset($_GET['lat'])) $latitude = $_GET['lat'];
if(isset($_GET['lon'])) $longitude = $_GET['lon'];
if(isset($_GET['mmsi'])) $mmsi = $_GET['mmsi'];
if(isset($_GET['type'])) $type = $_GET['type'];

if(isset($_POST['course'])) $course = $_POST['course'];
if(isset($_POST['latitude'])) $latitude = $_POST['latitude'];
if(isset($_POST['longitude'])) $longitude = $_POST['longitude'];
if(isset($_POST['lat'])) $latitude = $_POST['lat'];
if(isset($_POST['lon'])) $longitude = $_POST['lon'];
if(isset($_POST['mmsi'])) $mmsi = $_POST['mmsi'];
if(isset($_POST['type'])) $type = $_POST['type'];

if($course != null && $latitude != null && $longitude != null && $mmsi != null && $type != null){
    $sql = "INSERT INTO `record` (`id`, `mmsi`, `latitude`, `longitude`, `course`, `type`, `timestamp`) VALUES (NULL, '$mmsi', '$latitude', '$longitude', '$course', '$type', current_timestamp());";
    $result = mysqli_query($conn, $sql);
    if($result){
        http_response_code(200);        
        echo json_encode([
            "status" => "Success",
            "pesan" => "Record sucessfully recorded in database",
        ]);die;
    }
    else{             
        echo json_encode([
            "status" => "Failed",
            "pesan" => "Record failed record to database, Database Error",
        ]);die;
    }
}