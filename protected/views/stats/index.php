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
    
    //General Stats ************
    $command = "SELECT COUNT(*) as count FROM tbl_issue"; 
    $row=$connection->createCommand($command)->queryRow();
    $allTickets = (isset($row['count']) ? $row['count'] : 1);
    
    $command = "SELECT  CAST(CAST(COUNT(id) AS FLOAT) /COUNT(DISTINCT CONVERT(VARCHAR(10),create_time,111)) AS NUMERIC (36,2)) AS dailyTickets
  FROM [honducompras].[dbo].[tbl_issue]"; 
    $row=$connection->createCommand($command)->queryRow();
    $dailyTickets = (isset($row['dailyTickets']) ? $row['dailyTickets'] : 1);
    
    $command = "SELECT COUNT(DISTINCT institution_id) AS institutions
  FROM [honducompras].[dbo].[tbl_issue]"; 
    $row=$connection->createCommand($command)->queryRow();
    $attendedInstitutions = (isset($row['institutions']) ? $row['institutions'] : 1);
    
    
    
    $params = isset($_GET['uId']) ? 'AND assigned_to = '.$_GET['uId'] : '';
    $params = empty($_GET['uId']) ? '' : $params;
    $command = "SELECT COUNT(*) as count FROM tbl_issue WHERE status = 0 ".$params; 
    $row=$connection->createCommand($command)->queryRow();
    $openedTickets = (isset($row['count']) ? $row['count'] : 1);
    $command = "SELECT COUNT(*) as count FROM tbl_issue WHERE status = 1 ".$params; 
    $row=$connection->createCommand($command)->queryRow();
    $closedTickets = (isset($row['count']) ? $row['count'] : 1);
    
    //SELECT to get count for bar chart this month
    $command = "SELECT     tbl_user.first_name +' '+ tbl_user.last_name AS Nombre, 
SUM(CASE WHEN tbl_issue.status = 1 THEN 1 ELSE 0 END) AS Cerrado, 
SUM(CASE WHEN tbl_issue.status = 0 THEN 1 ELSE 0 END) AS Abierto,
percentage = 
CAST(SUM(CASE WHEN tbl_issue.status = 1 THEN 1 ELSE 0 END)AS FLOAT)/
(SUM(CASE WHEN tbl_issue.status = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN tbl_issue.status = 0 THEN 1 ELSE 0 END))*100
FROM         tbl_issue INNER JOIN tbl_user ON tbl_issue.assigned_to = tbl_user.id
WHERE MONTH(create_time) = MONTH(GETDATE()) 
GROUP BY assigned_to, first_name, last_name 
ORDER BY Cerrado DESC;";
    $rowsThisMonth=$connection->createCommand($command)->queryAll(); 
    
    
    //SELECT to get count for bar chart
    $command = "SELECT     tbl_user.first_name +' '+ tbl_user.last_name AS Nombre, SUM(CASE WHEN tbl_issue.status = 1 THEN 1 ELSE 0 END) AS Cerrado, SUM(CASE WHEN tbl_issue.status = 0 THEN 1 ELSE 0 END) AS Abierto
FROM         tbl_issue INNER JOIN tbl_user ON tbl_issue.assigned_to = tbl_user.id
GROUP BY assigned_to, first_name, last_name;";
    $rows=$connection->createCommand($command)->queryAll(); 
    
    //SELECT to get count from last 30 days
    $command2 = "SELECT convert(char(3), create_time, 0) + ' ' + convert(char, datepart (d, create_time)) AS 'date', count(*) AS 'count', MAX(create_time) AS create_time
FROM tbl_issue
WHERE create_time >= dateadd(day,datediff(day,0,GetDate())- 30,0) 
GROUP BY convert(char(3), create_time, 0) + ' ' + convert(char, datepart (d, create_time)) ORDER BY MAX(create_time) ASC";
    $rows2=$connection->createCommand($command2)->queryAll(); 
    
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
      
      
      google.load("visualization", "1", {packages:["imagebarchart"]});
      google.setOnLoadCallback(drawChartThisMonth);
      function drawChartThisMonth() {
        var data = google.visualization.arrayToDataTable([
          ['Oficial', 'Cerrado', 'Abierto'],
          <?php
                foreach($rowsThisMonth as $r){
                    echo("['".$r['Nombre']."', ".$r['Cerrado'].", ".$r['Abierto']."], ");
                }
          ?>
        ]);
        
        var options = {
          title: 'Tickets por oficial (Octubre)',
          colors: ['#2D5897', '#B3B3B3'],
          width: 600,
          height: 200,
          valueLabelsInterval: 1,
          min: 0
        };
        
        
        var chart = new google.visualization.ImageBarChart(document.getElementById('chart_this_month_div'));
        chart.draw(data, options);
      }
      
      google.load("visualization", "1", {packages:["imagebarchart"]});
      google.setOnLoadCallback(drawChart2);
      function drawChart2() {
        var data = google.visualization.arrayToDataTable([
          ['Oficial', 'Cerrado', 'Abierto'],
          <?php
                foreach($rows as $r){
                    echo("['".$r['Nombre']."', ".$r['Cerrado'].", ".$r['Abierto']."], ");
                }
          ?>
        ]);
        
        var options = {
          title: 'Tickets por oficial desde Sep 10 hasta la Fecha',
          colors: ['#2D5897', '#B3B3B3'],
          width: 900,
          height: 200,
          min: 0
        };
        
        var chart = new google.visualization.ImageBarChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
      
       google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart3);
      function drawChart3() {
        var data = google.visualization.arrayToDataTable([
          ['Dia', 'Tickets'],
          <?php
                foreach($rows2 as $r){
                    echo("['".$r['date']."', ".$r['count']."],");
                }
              ?>
        ]);

        var options = {
          title: 'Tickets ultimos 30  dias',
          hAxis: {title: 'Dia'},
          width: 900,
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('chart_div3'));
        chart.draw(data, options);
      }
      
    </script>


<h1><?php echo 'Rendimiento global'  ?></h1>




<div id="general_stats_table" style="display: box; width: 100%; height: 120px; border-bottom-style: solid; border-width: 1px; border-color: #2D5897;">
    <div id='general_stat' title='Total Tickets' style="display: box; height: 80px; width: 100px; border-style: solid; border-width: 1px; border-color: lightgrey; margin: 10px; margin-left: 10px; float: left; padding: 10px 0px 10px 0px; background-image: url(images/ticket-icon.png)">
        
        <div align='center'><b>Total Tickets</b></div>
                
                <div align='center' style='margin-top: 20px; color: #2D5897'><h1 style='color: #2D5897'><b><?php echo $allTickets;?></b></h1></div>
        
    </div>
    <div id='general_stat' title='Promedio de consultas diarias' style="display: box; height: 80px; width: 100px; border-style: solid; border-width: 1px; border-color: lightgrey; margin: 10px; margin-left: 10px; float: left; padding: 10px 0px 10px 0px; background-image: url(images/por-icon.png)">
        
        <div align='center'><b>Con. Diarias</b></div>
                
                <div align='center' style='margin-top: 20px; color: #2D5897'><h1 style='color: #2D5897'><b><?php echo $dailyTickets;?></b></h1></div>
        
    </div>
    
    <div id='general_stat' title='Instituciones Atendidades' style="display: box; height: 80px; width: 100px; border-style: solid; border-width: 1px; border-color: lightgrey; margin: 10px; margin-left: 10px; float: left; padding: 10px 0px 10px 0px; background-image: url(images/ins-icon.png)">
        
        <div align='center'><b>Ins. Atendidas</b></div>
                
                <div align='center' style='margin-top: 20px; color: #2D5897'><h1 style='color: #2D5897'><b><?php echo $attendedInstitutions;?></b></h1></div>
        
    </div>
    
    <div id='general_stat' title='Oficial con mas tickets resuelto ultimo mes' style="display: box; height: 80px; width: 100px; border-style: solid; border-width: 1px; border-color: lightgrey; margin: 10px; margin-left: 10px; float: left; padding: 10px 0px 10px 0px; background-image: url(images/usu-icon.png)">
        
        <div align='center'><b>Mayor Tickets</b></div>
                
                <div align='center' style='margin-top: 15px; color: #2D5897'><h3 style='color: #2D5897'><b><?php echo "Marlon </br> Zuniga";?></b></h3></div>
        
    </div>
    
    <div id='general_stat' title='Instituciones Atendidades' style="display: box; height: 80px; width: 100px; border-style: solid; border-width: 1px; border-color: lightgrey; margin: 10px; margin-left: 10px; float: left; padding: 10px 0px 10px 0px; background-image: url(images/estadisticas-icon.png)">
        
        <div align='center'><b>Ins. Atendidas</b></div>
                
                <div align='center' style='margin-top: 20px; color: #2D5897'><h1 style='color: #2D5897'><b><?php echo "57.25";?></b></h1></div>
        
    </div>
    
    
</div>


</br>
</br>
</br>
</br>
<div id="chart_this_month_div"></div>
</br>
</br>
</br>
</br>
<h1>Rendimiento detallado</h1>


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


<div id="chart_div"></div>

</br>

<div id="chart_div3" style="width: 100%; height: 500px;"></div>