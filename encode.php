<?php
header('Content-Type: application/json; charset=utf-8');

if( 
    (isset($_GET['course']) || isset($_POST['course'])) &&
    (isset($_GET['lat']) || isset($_POST['lat'])) &&
    (isset($_GET['lon']) || isset($_POST['lon'])) &&
    (isset($_GET['mmsi']) || isset($_POST['mmsi']))
){
    $course = null;
    $lat = null;
    $lon = null;
    $mmsi = null;

    if(isset($_GET['course'])) $course = $_GET['course'];
    if(isset($_POST['course'])) $course = $_POST['course'];

    if(isset($_GET['lat'])) $lat = $_GET['lat'];
    if(isset($_POST['lat'])) $lat = $_POST['lat'];

    if(isset($_GET['lon'])) $lon = $_GET['lon'];
    if(isset($_POST['lon'])) $lon = $_POST['lon'];

    if(isset($_GET['mmsi'])) $mmsi = $_GET['mmsi'];
    if(isset($_POST['mmsi'])) $mmsi = $_POST['mmsi'];

    $output = shell_exec('py encode.py '.$course.' '.$lat.' '.$lon.' '.$mmsi);
    echo json_encode([
        'status' => 'success',
        'message' => 'encode ais data sucessfully',
        'data' => $output
    ]);
    die;
}
echo json_encode([
    'status' => 'failed',
    'message' => 'ais data needed!',
]);
?>

