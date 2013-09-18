<?php

require ('mail/class.phpmailer.php');
class IssueController extends Controller
{

	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'roles'=>array('helpdesk_central'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'roles'=>array('helpdesk_admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Issue;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Issue']))
		{
			$model->attributes=$_POST['Issue'];
			if($model->save()){
                            
                            $this->sendEmail($model->contact_email,$model->user->email,$model->ticket_number,$model->id,$model->user->concatened);
                            Yii::app()->user->setFlash('success', "Se creó la consulta correctamente.");
                            $this->redirect(array('view','id'=>$model->id));
                        }
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Issue']))
		{
			$model->attributes=$_POST['Issue'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
                if(!Yii::app()->user->checkAccess('helpdesk_admin')) {
                    throw new CHttpException(403,'No esta autorizado para realizar esta accion.');
                }

		$this->loadModel($id)->delete();
                
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex($tNumber = '',$uId = '')
	{
                $criteria = new CDbCriteria();
                $criteria->addSearchCondition( 'ticket_number', $tNumber, true );
                $criteria->addSearchCondition( 'assigned_to', $uId, false );
                
		$dataProvider=new CActiveDataProvider('Issue',array('criteria'=>$criteria,));
                $dataProvider->pagination->pageSize = 5;
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Issue('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Issue']))
			$model->attributes=$_GET['Issue'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Issue the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Issue::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'El item solicitado no existe.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Issue $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='issue-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
        protected function getUserOptions(){
            $userArray = CHtml::listData(User::model()->findAll(),'id','concatened');
            return $userArray;
            
        }
        
        public function sendEmail($to, $toCC, $tNumber, $tId, $userFullName)
	{
                $mail = new PHPMailer;
                $mail->IsSMTP();                                      	// Set mailer to use SMTP
                $mail->Host = 'smtp.gmail.com';  			// Specify main and backup server
                $mail->Port='465'; 
                $mail->SMTPAuth = true;                               	// Enable SMTP authentication
                $mail->Username = 'cconcae';                          // SMTP username
                $mail->Password = '@oncaecc';                        // SMTP password
                $mail->SMTPSecure = 'ssl';                            	// Enable encryption, 'ssl' also accepted
                $mail->SMTPKeepAlive = true;  

                $mail->From = 'cconcae@gmail.com';
                $mail->FromName = 'Mesa de Ayuda ONCAE';
                $mail->AddAddress($to);  // Add a recipient
                //$mail->AddAddress('ellen@example.com');               // Name is optional
                $mail->AddReplyTo('cconcae@gmail.com', 'Mesa de ayuda ONCAE');
                $mail->AddCC($toCC, $userFullName);
                $mail->AddCC('cconcae@gmail.com', 'Mesa de ayuda ONCAE');
                //$mail->AddBCC('bcc@example.com');

                //$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
                //$mail->AddAttachment('/var/tmp/file.tar.gz');         // Add attachments
                //$mail->AddAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
                $mail->IsHTML(true);                                  // Set email format to HTML
                $subject = 'Ticket '.$tNumber.' Mesa de Ayuda ONCAE';
                $message = '
                                    <html>
                                    <head>
                                      <title>'.$tNumber.' </title>
                                    </head>
                                    <body>
                                      <p>Se ha creado el ticket <b>'.$tNumber.'</b> se le asigno al Oficial de Mesa de Ayuda <b>'.$userFullName.'</b> </p>
                                      </br>
                                      <p>Puede ver el estado de su consulta en <b><a href="http://www.oncae.gob.hn/honducompras/index.php?r=issue/view&id='.$tId.'">este link</a></b></p>
                                      <p>Para dar seguimiento a su consulta via telefono llamar al 2238-7827</p>
                                    </body>
                                    </html>
                                    ';
                
                $mail->Subject = $subject;
                $mail->Body    = $message;
                //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                if(!$mail->Send()) {
                   throw new CHttpException(410, 'Se ha creado la consulta pero ocurrio un error al momento de enviar los correos, favor realizar este paso manualmente.');
                }
	}
}
