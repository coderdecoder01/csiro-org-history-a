<?php
require_once("sparqllib.php");
$a = $_POST[gen];
$data = sparql_get(
    "http://23.101.230.37:7200/repositories/CSIRO",
    $a);

if (!isset($data)) {
    //print "<p>Error: ".sparql_errno().": ".sparql_error()."</p>";
}
//print "<table class='example_table'>";
//print "<tr>";
foreach ($data->fields() as $field) {
    // print "<th>$field</th>";
}
//print "</tr>";
$array = array();

foreach ($data as $row) {
    //  print "<tr>";
    $a = 0;
    foreach ($data->fields() as $field) {
        //     print "<td>$row[$field]</td>";
        if ($a == 0) {
            $tmp1 = $row[$field];
            $a++;
        } else {
            $tmp2 = $row[$field];
            $array[] = array($tmp1, $tmp2);

        }
    }
    // print "</tr>";
}
//print "</table>";
/*echo "sfsffsfd".$array[0][1];
echo gettype($array);
    $newarray = array();

for( $i =0;$i<5;$i++){
    $newarray[]= $data[$i];
}
for( $i =0;$i<5;$i++){

}*/
//$dataPoints = $array();
$i = 0;
$dataPoints = array();
foreach ($array as $var) {
    //  echo "\n", $var[0], "\t\t", $var[1];


    $dataPoints[] = array("label" => $var[0], "y" => (double)$var[1]);
}
/*foreach ( $dataPoints as $var ) {
      echo "\n", $var[0], "\t\t", $var[1];
    //$dataPoints[$i]=array("label"=>$var[0], "y"=>(double)$var[1]);

}*/
?>
<!DOCTYPE HTML>
<html>
<head>
    <script>
        window.onload = function() {


            var chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                title: {
                    text: "Number of Members in each Unit"
                },
                subtitles: [{
                    text: "CSIRO"
                }],

                data: [{
                    type: "pie",
                    indexLabel: "{label} ({y})",
                    fontsize: 4,
                    is3D: true,
                    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                }]
            });
            chart.render();
            localStorage.setItem("gen", foo);

        }

    </script>
</head>
<body>
<div id="chartContainer" style="height: 650px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<input type="submit" class="button" name="someAction" value="back" onclick="window.history.go(-1)"\ />

</body>
</html>

