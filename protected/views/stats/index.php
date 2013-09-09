<?php
/* @var $this StatsController */

$this->breadcrumbs=array(
	'Estadisticas',
);

$this->menu=array(
	array('label'=>'Rendimiento por oficial', 'url'=>array('stats/index')),
	array('label'=>'Consultas por area', 'url'=>array('stats/areaStats')),
        array('label'=>'Administrar consultas', 'url'=>array('issue/admin')),
);

?>




<?php 
    $connection = Yii::app()->db;
    
    $params = isset($_GET['uId']) ? 'AND assigned_to = '.$_GET['uId'] : '';
    $params = empty($_GET['uId']) ? '' : $params;
    $command = "SELECT COUNT(*) as count FROM tbl_issue WHERE status = 0 ".$params; 
    $row=$connection->createCommand($command)->queryRow();
    $openedTickets = (isset($row['count']) ? $row['count'] : 1);
    $command = "SELECT COUNT(*) as count FROM tbl_issue WHERE status = 1 ".$params; 
    $row=$connection->createCommand($command)->queryRow();
    $closedTickets = (isset($row['count']) ? $row['count'] : 1);
?>

<script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Estado', 'Tickets'],
          ['Abierto',     <?php echo $openedTickets;?>],
          ['Cerrado',     <?php echo $closedTickets;?>]
        ]);

        var options = {
          title: 'Tickets mesa de ayuda',
          colors: ['#B3B3B3', '#2D5897']
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);
      }
    </script>


<h1><?php echo 'Rendimiento'  ?></h1>


<b>Filtrar datos:</b>

<?php 
    $defaultValue = isset($_GET['uId']) ? $_GET['uId'] : 'prompt';
    echo CHtml::beginForm(CHtml::normalizeUrl(array('stats/index')), 'get', array('id'=>'filter-form'))
    . CHtml::dropDownList('uId', 
            'promt', 
            User::model()->getHelpDeskUsers(), 
            array('prompt'=>'Por oficial de mesa de ayuda',
                            'options'=>array($defaultValue=>array('selected'=>'selected'))
                            ))
    . CHtml::submitButton('Buscar', array('name'=>''))
    . CHtml::link('Mostrar todos los resultados',array('stats/index'),array('style'=>'font-size:smaller;text-decoration:none;'))
    . CHtml::endForm();
	?>
</br>
<h3><?php echo '<b>Total tickets:</b> '. ($openedTickets + $closedTickets) .' <i>('.$openedTickets.' Abiertos / '.$closedTickets.' Cerrados)</i>'   ?></h3>


<div id="piechart" style="width: 100%; height: 500px;"></div>