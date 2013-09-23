<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;




$this->menu=array(
	array('label'=>'Consultas', 'url'=>array('issue/index')),
	array('label'=>'Estadisticas', 'url'=>array('stats/index'), 'visible'=>Yii::app()->user->checkAccess('helpdesk')),
        array('label'=>'Preguntas frecuentes', 'url'=>array('question/index')),
        array('label'=>'Contactenos', 'url'=>array('site/contact')),
);

?>


    <!-- Js slider -->        
    <!-- load jQuery and the plugin -->
    <!-- <script src="http://code.jquery.com/jquery-latest.min.js"></script> -->
    <script src="js/jquery-latest.min.js"></script>
    <script src="js/bjqs-1.3.js"></script>      
    <!-- bjqs.css contains the *essential* css needed for the slider to work -->
    <link rel="stylesheet" href="css/bjqs.css">
    <!-- demo.css contains additional styles used to set up this demo page - not required for the slider --> 
    <link rel="stylesheet" href="css/demo.css">

      <!--  Outer wrapper for presentation only, this can be anything you like -->
      <div id="banner-fade">
          
        <!-- start Basic Jquery Slider -->
        <ul class="bjqs">
          <li><img src="images/banner01.png" title="La Oficina Normativa de Contratación y Adquisiciones del Estado (ONCAE) será la entidad responsable por administrar HonduCompras."></li>
          <li><img src="images/banner02.jpg" title="La Oficina Normativa de Contratación y Adquisiciones del Estado (ONCAE) será la entidad responsable por administrar HonduCompras."></li>
          <li><img src="images/banner03.png" title="La Oficina Normativa de Contratación y Adquisiciones del Estado (ONCAE) será la entidad responsable por administrar HonduCompras."></li>
        </ul>
        <!-- end Basic jQuery Slider -->

      </div>
      <!-- End outer wrapper -->

      <script class="secret-source">
        $(document).ready(function($) {
          $('#banner-fade').bjqs({
            animtype      : 'fade',  
            height      : 250,
            width       : 700,
            responsive  : true,
            nexttext : '>', // Text for 'next' button (can use HTML)
            prevtext : '<', // Text for 'previous' button (can use HTML)
            showmarkers : false, 
          });

        });
      </script>

       
        <b>¿Qué es HonduCompras?</b>
        <p align="justify">Mediante el Decreto Ejecutivo 010/2005 promulgado en octubre de 2005, se crea el Sistema de Información de Contratación y Adquisiciones del Estado de Honduras, “HonduCompras”,<a href="www.honducompras.gob.hn">www.honducompras.gob.hn</a>, el cual es el único medio por el que se difundirá y gestionará, a través de Internet, los procedimientos de contratación que celebren los órganos comprendidos en el ámbito de aplicación de la Ley de Contratación del Estado, para lo cual el Órgano Responsable de su administración establecerá los mecanismos, plazos y condiciones para la incorporación gradual de las entidades al Sistema.</p>

        <b>¿Quién es el responsable por administrar HonduCompras?</b>
        <p align="justify">La Oficina Normativa de Contratación y Adquisiciones del Estado (ONCAE) será la entidad responsable por administrar HonduCompras.</p>

	



