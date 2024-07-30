<?php
    include "koneksi.php";
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
            <h3 class="mb-3"><b>Record</b></h3>
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
                        <th>Detail</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql = "SELECT * FROM record ORDER BY timestamp ASC";
                        $query = mysqli_query($conn, $sql);
                        $idx = 0;

                        $data2 = [];
                        while($dat = mysqli_fetch_object($query)){
                            $data2[] = (array) $dat;
                        }
                        
                        usort($data2, function($a, $b) {
                            if ($a["mmsi"] === $b["mmsi"]) {
                                return DateTime::createFromFormat("d/m/Y", $a["timestamp"]) <=> DateTime::createFromFormat("d/m/Y", $b["timestamp"]);
                            }
                            return $a["mmsi"] <=> $b["mmsi"];
                        });
                        
                        $results = [];
                        $last = count($data2) - 1;
                        
                        for ($i = 0; $i < count($data2); $i++) {
                            if ((isset($data2[$i + 1]) && $data2[$i + 1]["mmsi"] !== $data2[$i]["mmsi"]) || $i === $last) {
                                $results[] = (object)$data2[$i];
                            }
                        }
                        
                        foreach($results as $data){
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
                        <td><a href="/detail.php?mmsi=<?=$data->mmsi?>" class='btn btn-primary'>Detail</a></td>
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