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
    
    $params = isset($_GET['start_date']) ? "AND `create_time` >= '".$_GET['start_date']." 00:00:00'" : '';
    $params = empty($_GET['start_date']) ? '' : $params;
    $params .= isset($_GET['end_date']) ? " AND `create_time` <= '".$_GET['end_date']." 23:59:59'" : '';
    $params = empty($_GET['end_date']) ? '' : $params;
    $command = "SELECT COUNT(*) as count FROM tbl_issue WHERE category_id = 1 ".$params;
    $row=$connection->createCommand($command)->queryRow();
    $honducomprasIssues = (isset($row['count']) ? $row['count'] : 0);
    $command = "SELECT COUNT(*) as count FROM tbl_issue WHERE category_id = 2 ".$params; 
    $row=$connection->createCommand($command)->queryRow();
    $eCatalogIssues = (isset($row['count']) ? $row['count'] : 0);
    $command = "SELECT COUNT(*) as count FROM tbl_issue WHERE category_id = 3 ".$params; 
    $row=$connection->createCommand($command)->queryRow();
    $legalIssues = (isset($row['count']) ? $row['count'] : 0);
    $command = "SELECT COUNT(*) as count FROM tbl_issue WHERE category_id = 4 ".$params; 
    $row=$connection->createCommand($command)->queryRow();
    $PACCIssues = (isset($row['count']) ? $row['count'] : 0);
    $command = "SELECT COUNT(*) as count FROM tbl_issue WHERE category_id = 5 ".$params; 
    $row=$connection->createCommand($command)->queryRow();
    $RPCIssues = (isset($row['count']) ? $row['count'] : 0);
    $command = "SELECT COUNT(*) as count FROM tbl_issue WHERE category_id = 6 ".$params; 
    $row=$connection->createCommand($command)->queryRow();
    $CUBSIssues = (isset($row['count']) ? $row['count'] : 0);
?>

<script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Estado', 'Tickets'],
          ['Honducompras',     <?php echo $honducomprasIssues;?>],
          ['Catalogo Electronico',     <?php echo $eCatalogIssues;?>],
          ['Legal',     <?php echo $legalIssues;?>],
          ['PACC',     <?php echo $PACCIssues;?>],
          ['Registro de proveedores',     <?php echo $RPCIssues;?>],
          ['CUBS',     <?php echo $CUBSIssues;?>]
        ]);

        var options = {
          title: 'Consultas por area',
          colors: ['#B3B3B3', '#2D5897', '#339900', '#CC3333', '#FFCC00', '#CD38FF']
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