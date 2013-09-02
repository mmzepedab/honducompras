<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;

$this->menu=array(
	array('label'=>'Consultas', 'url'=>array('issue/index')),
	array('label'=>'Estadisticas', 'url'=>array('stats/index')),
        array('label'=>'Preguntas frecuentes', 'url'=>array('question/index')),
        array('label'=>'Contactenos', 'url'=>array('contact/index')),
);

?>

<h1>Bienvenido a <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>



<ul>
        <li><b>¿Qué es HonduCompras?</b></li>
        <p align="justify">Mediante el Decreto Ejecutivo 010/2005 promulgado en octubre de 2005, se crea el Sistema de Información de Contratación y Adquisiciones del Estado de Honduras, “HonduCompras”,<a href="www.honducompras.gob.hn">www.honducompras.gob.hn</a>, el cual es el único medio por el que se difundirá y gestionará, a través de Internet, los procedimientos de contratación que celebren los órganos comprendidos en el ámbito de aplicación de la Ley de Contratación del Estado, para lo cual el Órgano Responsable de su administración establecerá los mecanismos, plazos y condiciones para la incorporación gradual de las entidades al Sistema.</p>

        <li><b>¿Quién es el responsable por administrar HonduCompras?</b></li>
        <p align="justify">La Oficina Normativa de Contratación y Adquisiciones del Estado (ONCAE) será la entidad responsable por administrar HonduCompras.</p>

	
</ul>


