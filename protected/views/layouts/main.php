<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
        
        

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
        
        
</head>

<body>

<div class="container" id="page">

	<div id="header">
            <div id="loginInfo">
                <?php  if(!Yii::app()->user->isGuest){
                            echo 'Bienvenido/a <b>'.Yii::app()->user->first_name.' '.Yii::app()->user->last_name.'</b></br>';
                            echo '[ <a href="?r=site/logout">Cerrar Sesión</a> ]'; 
                        }else{
                            echo '[ <a href="?r=site/login">Iniciar Sesión</a> ]';  
                        }  
                ?> 
                    
            </div>
            <a href="./"><div id="logo"></div></a>
            
	</div><!-- header -->

	<div id="mainMbMenu">
		<?php $this->widget('application.extensions.mbmenu.MbMenu',array(
			'items'=>array(
				array('label'=>'Inicio', 'url'=>array('/site/index')), 
                                array('label'=>'Mesa de ayuda', 'url'=>('?r=issue'),'items'=>array(
                                    array('label'=>'Consultas', 'url'=>array('/issue')),
                                    array('label'=>'Estadisticas', 'url'=>array('/stats'), 'visible'=>Yii::app()->user->checkAccess('helpdesk')),
                                    array('label'=>'Preguntas Frecuentes', 'url'=>array('/question')),                                   
                                    array('label'=>'Contacto', 'url'=>array('/site/contact')),
                                )),			
                                array('label'=>'Acerca de', 'url'=>array('/site/page', 'view'=>'about')),
                                array('label'=>'Administracion', 'url'=>array('#'), 'visible'=>(Yii::app()->user->checkAccess('RBAC Manager')) , 'items'=>array(
                                    array('label'=>'Usuarios', 'url'=>array('/user')),
                                    array('label'=>'Roles de Usuarios', 'url'=>array('/rbam') , 'visible'=>(Yii::app()->user->checkAccess('RBAC Manager'))),
                                    array('label'=>'Consultas', 'url'=>array('/user'),'items'=>array(
                                        array('label'=>'Categorias', 'url'=>array('/category')),
                                        array('label'=>'Metodos de recepcion', 'url'=>array('/issueReceptionType')),
                                    )),      
                                )),
				array('label'=>'Inicio de sesion', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				
                                 array('label'=>'Mi perfil ('.Yii::app()->user->name.')', 'visible'=>!Yii::app()->user->isGuest, 'url'=>('?r=issue'),'items'=>array(
                                    array('label'=>'Ver mi perfil', 'url'=>array('/user/view', 'id'=>Yii::app()->user->id)),
                                    array('label'=>'Actualizar mi información', 'url'=>array('/user/update', 'id'=>Yii::app()->user->id)),
                                    array('label'=>'Cambiar Contraseña', 'url'=>array('/stats/index')),
                                    array('label'=>'Cerrar Sesión', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
                                )),
			
		),
                )); ?>
	</div><!-- mainmenu -->
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
			'homeLink'=> CHtml::link('Inicio', Yii::app()->homeUrl),
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		Honducompras sitio de informaciónn <?php echo date('Y'); ?><br/>
		Todos los derechos reservados.<br/>
        <?php echo CHtml::link('www.honducompras.gob.hn', 'http://www.honducompras.gob.hn'); ?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
