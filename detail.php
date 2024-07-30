<?php
    include "koneksi.php";
    if(!isset($_GET['mmsi'])){
        header('Location: /');
        die;
    }
    $newer_data = mysqli_fetch_object(mysqli_query($conn, "SELECT * FROM record WHERE mmsi = ".$_GET['mmsi']." ORDER BY timestamp DESC"))
?>
<!doctype html>
<html lang="en" data-bs-theme="dark">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AIS Receiver | Record</title>
    <link href="/bootstrap-5.3.3/bootstrap.min.css" rel="stylesheet">
    <link href="/datatables/dataTables.css" rel="stylesheet">
  </head>
  <body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary bg-dark text-dark">
    <div class="container">
        <a class="navbar-brand" href="/index.php">AIS Receiver</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav ms-auto">
            <a class="nav-link active" aria-current="page" href="/index.php">Record</a>
        </div>
        </div>
    </div>
    </nav>

    <div class="container mt-5">
        <div class="card p-3">
            <div class="ps-1 pb-3 pt-2">
                <a href="/" class="btn btn-secondary">< Back</a>
            </div>
            <h3 class="mb-3"><b>Latest Record from MMSI <?=$_GET['mmsi']?></b></h3>
            <div class="row">
                <div class="col-md-5">
                    <div class="input-group input-group mb-2">
                        <span class="input-group-text" id="inputGroup-sizing-sm" style="width: 150px">MMSI</span>
                        <input type="text" class="form-control" value="<?=$newer_data->mmsi?>" disabled>
                    </div>
                    <div class="input-group input-group mb-2">
                        <span class="input-group-text" id="inputGroup-sizing-sm"style="width: 150px">Latitude</span>
                        <input type="text" class="form-control" value="<?=$newer_data->latitude?>" disabled>
                    </div>
                    <div class="input-group input-group mb-2">
                        <span class="input-group-text" id="inputGroup-sizing-sm"style="width: 150px">Longitude</span>
                        <input type="text" class="form-control" value="<?=$newer_data->longitude?>" disabled>
                    </div>
                    <div class="input-group input-group mb-2">
                        <span class="input-group-text" id="inputGroup-sizing-sm"style="width: 150px">Course</span>
                        <input type="text" class="form-control" value="<?=$newer_data->course?>" disabled>
                    </div>
                    <div class="input-group input-group mb-2">
                        <span class="input-group-text" id="inputGroup-sizing-sm"style="width: 150px">Type</span>
                        <input type="text" class="form-control" value="<?=$newer_data->type?>" disabled>
                    </div>
                    <div class="input-group input-group mb-2">
                        <span class="input-group-text" id="inputGroup-sizing-sm"style="width: 150px">Timestamp</span>
                        <input type="text" class="form-control" value="<?=$newer_data->timestamp?>" disabled>
                    </div>
                </div>
                <div class="col-md-7">
                <iframe 
                    width="100%" 
                    height="100%" 
                    frameborder="0" 
                    scrolling="no" 
                    marginheight="0" 
                    marginwidth="0" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"
                    src="https://maps.google.com/maps?q=<?=$newer_data->latitude?>, <?=$newer_data->longitude?>&hl=es&z=14&amp;output=embed"
                >
                </iframe>
                </div>
            </div>
            <hr>
            <h3 class="mb-3"><b>History from MMSI <?=$_GET['mmsi']?></b></h3>
            <table id="myTable" class="display">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>MMSI</th>
                        <th>Longitude</th>
                        <th>Latitude</th>
                        <th>Course</th>
                        <th>Type</th>
                        <th>Timestamp</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql = "SELECT * FROM record WHERE mmsi = ".$_GET['mmsi']." ORDER BY timestamp DESC";
                        $query = mysqli_query($conn, $sql);
                        $idx = 0;                        
                        while($data = mysqli_fetch_object($query)){
                        $idx++;
                    ?>
                    <tr>
                        <td><?=$idx?></td>
                        <td><?=$data->mmsi?></td>
                        <td><?=$data->longitude?></td>
                        <td><?=$data->latitude?></td>
                        <td><?=$data->course?></td>
                        <td><?=$data->type?></td>
                        <td><?=$data->timestamp?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    
    <script src="/bootstrap-5.3.3/bootstrap.bundle.min.js"></script>
    <script src="/jquery-3.7.1/jquery-3.7.1.min.js"></script>
    <script src="/datatables/dataTables.js"></script>
    <script type="text/javascript">
        $(document).ready( function () {
            $('#myTable').DataTable();
        } );
    </script>
  </body>
</html>