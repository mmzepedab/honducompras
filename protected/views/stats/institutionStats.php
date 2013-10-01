<?php
/* @var $this StatsController */

$this->breadcrumbs=array(
	'Estadisticas',
);

$this->menu=array(
	array('label'=>'Rendimiento por oficial', 'url'=>array('stats/index')),
	array('label'=>'Consultas por area', 'url'=>array('stats/areaStats')),    
        array('label'=>'Consultas por institución', 'url'=>array('stats/institutionStats')),
        array('label'=>'Administrar consultas', 'url'=>array('issue/admin')),
);

?>




<?php 
    $connection = Yii::app()->db;
    
    $params = isset($_GET['start_date']) ? "WHERE create_time >= '".$_GET['start_date']." 00:00:00'" : '';
    $params = empty($_GET['start_date']) ? '' : $params;
    $params .= isset($_GET['end_date']) ? " AND create_time <= '".$_GET['end_date']." 23:59:59'" : '';
    $params = empty($_GET['end_date']) ? '' : $params;
    
    $command = "SELECT     distinct entidades.nombre AS name, COUNT(tbl_issue.id) AS count
FROM         tbl_issue INNER JOIN
                      entidades ON tbl_issue.institution_id = entidades.codent GROUP BY entidades.nombre";
    $rows=$connection->createCommand($command)->queryAll();    

    
?>

<script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Estado', 'Tickets'],
              <?php
                foreach($rows as $r){
                    echo("['".$r['name']."', ".$r['count']."],");
                }
              ?>

        ]);

        var options = {
          title: 'Consultas por institución',
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('piechart'));
        chart.draw(data, options);
      }
    </script>


<h1><?php echo 'Consultas por institución'  ?></h1>








<div id="piechart" style="width: 100%; height: 500px;"></div>