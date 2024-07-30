<?php
header('Content-Type: application/json; charset=utf-8');

if(isset($_GET['ais']) || isset($_POST['ais'])){
    $ais = null;
    if(isset($_GET['ais'])) $ais = $_GET['ais'];
    if(isset($_POST['ais'])) $ais = $_POST['ais'];
    $output = shell_exec('py decode.py '.$ais);
    $raw = json_decode($output);
    echo json_encode([
        'status' => 'success',
        'message' => 'decode ais data sucessfully',
        'data' => $raw
    ]);
    die;
}
echo json_encode([
    'status' => 'failed',
    'message' => 'ais data needed!',
]);
?>

