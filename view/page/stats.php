<?php
	/**
	 * Created by PhpStorm.
	 * User: Neznayka
	 * Date: 19.06.2019
	 * Time: 13:24
	 */
	include ROOT . '/view/layouts/header.php';
?>
	<script src="https://canvasjs.com/assets/script/canvasjs.min.js" defer></script>
	<script>
        window.onload = function () {

            var chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                exportEnabled: true,
                title: {
                    text: "Процент жанров"
                },
                data: [{
                    type: "pie",
                    legendText: "{label}",
                    indexLabelFontSize: 16,
                    indexLabel: "{label} - #percent%",
                    yValueFormatString: "##0",
                    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>,
                }]
            });
            chart.render();

        }
	</script>
	<style>
		body {
			background-color: white;
		}
	</style>
		<div id="chartContainer" style="height: 100%; width: 100%;"></div>
<?php
	include ROOT . '/view/layouts/footer.php';
?>