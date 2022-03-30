<?php 

function GeneratePieChart($values)
{

?>

<canvas id="myChart" style="width:100%;"></canvas>

<script>
var barColors = [
    <?php for($i = 0; $i < count($values) -1; $i++): ?> "<?php echo rand_color(); ?>",
    <?php endfor; ?> "<?php echo rand_color(); ?>"
];


<?php
$yValues = json_encode(array_values($values));
echo "var yValues = ". $yValues . ";\n";
?>

<?php
$xValues = json_encode(array_keys($values));
echo "var xValues = ". $xValues . ";\n";
?>

new Chart("myChart", {
    type: "pie",
    data: {
        labels: xValues,
        datasets: [{
            backgroundColor: barColors,
            data: yValues
        }]
    },
});
</script>

<?php

}

//https://stackoverflow.com/questions/5614530/generating-a-random-hex-color-code-with-php

function rand_color() {
    return '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
}


?>