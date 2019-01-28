

<html>
<body>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<div id="sankey_multiple" style="width: 900px; height: 300px;"></div>
<?php
function multi_unique($src){
    $output = array_map("unserialize",
        array_unique(array_map("serialize", $src)));
    return $output;
}
$myfile = fopen("pre.txt", "r") or die("Unable to open file!");
$a=fgets($myfile);
$needel="-A";
$array = array();
while(!feof($myfile)) {
    if (strpos($a, $needel) !== false) {
        $start = strpos($a, 'A');
        $tmp = substr($a, $start,7);
        $end = strrpos($a, 'A');
        $tmp2 = substr($a, $end, 7);

        $array[] = array($tmp, $tmp2);


    }
    $a=fgets($myfile);
}
$output=multi_unique($array);
//print_r($output);

fclose($myfile);
?>
<script type="text/javascript">
    google.charts.load("current", {packages:["sankey"]});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = new google.visualization.DataTable();
        var users = <?php echo json_encode($array); ?>;

        data.addColumn('string', 'From');
        data.addColumn('string', 'To');
        data.addColumn('number', 'Weight');
        var arrayLength = users.length;
        for (var i = 0; i < arrayLength; i++) {
            data.addRows([
                [ users[i][0],users[i][1] , 1 ]
            ]);

        }



        // Set chart options
        var options = {
            width: 1000,
            height: 1000
        };


        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.Sankey(document.getElementById('sankey_multiple'));
        chart.draw(data, options);
    }
</script>


</body>
</html>
