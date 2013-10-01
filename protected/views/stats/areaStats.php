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
    
    $command = "SELECT DISTINCT tbl_category.name, COUNT(*) AS count FROM tbl_issue INNER JOIN tbl_category ON tbl_issue.category_id = tbl_category.id ".$params." GROUP BY tbl_category.name ";
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
          title: 'Consultas por area',
          colors: ['#B3B3B3', '#339900', '#CC3333', '#2D5897', '#FFCC00', '#CD38FF', '#66FF33']
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);
      }
    </script>


<h1><?php echo 'Consultas por area'  ?></h1>

<b>Filtrar datos:</b>

    <?php 
        $defaultValue = isset($_GET['uId']) ? $_GET['uId'] : 'prompt';
        echo CHtml::beginForm(CHtml::normalizeUrl(array('stats/areaStats')), 'get', array('id'=>'filter-form'));
        echo Chtml::label('Fecha inicio: ','','');
    ?>   
    
    <?php
    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
        'name' => 'start_date',
        'value' => isset($_GET['start_date']) ? $_GET['start_date'] : '',
        'htmlOptions' => array(
            'size' => '20',         // textField size
            'maxlength' => '10',    // textField maxlength
        ),
        'options' => array(
        'dateFormat' => 'yy-mm-dd',     // format of "2012-12-25"
        ),
    ));
    ?>

    <?php 
        echo Chtml::label('Fecha final: ','','');
    ?> 

    <?php
    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
        'name' => 'end_date',
        'value' => isset($_GET['end_date']) ? $_GET['end_date'] : '',
        'htmlOptions' => array(
            'size' => '20',         // textField size
            'maxlength' => '10',    // textField maxlength
        ),
        'options' => array(
        'dateFormat' => 'yy-mm-dd',     // format of "2012-12-25"
        ),
    ));
    ?>

    <?php 
    echo CHtml::submitButton('Buscar', array('name'=>''))
    . CHtml::link('Mostrar todos los resultados',array('stats/areaStats'),array('style'=>'font-size:smaller;text-decoration:none;'))
    . CHtml::endForm();
    ?>






<div id="piechart" style="width: 100%; height: 500px;"></div>