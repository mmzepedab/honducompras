<?php

/**
 * Description of RbacCommand
 *
 * @author mmzepedab
 */
class RbacCommand extends CConsoleCommand
{
   
    private $_authManager;
 
    
	public function getHelp()
	{
		
		$description = "DESCRIPTION\n";
		$description .= '    '."This command generates an initial RBAC authorization hierarchy.\n";
		return parent::getHelp() . $description;
	}
 
	
	/**
	 * The default action - create the RBAC structure.
	 */
	public function actionIndex()
	{
		 
		$this->ensureAuthManagerDefined();
		
		//provide the oportunity for the use to abort the request
		$message = "This command will create three roles: Helpdesk Admin, Helpdesk Central, and Helpdesk Officer\n";
		$message .= " and the following permissions:\n";
		$message .= "create, read, update and delete issue\n";
		$message .= "Would you like to continue?";
	    
	    //check the input from the user and continue if 
		//they indicated yes to the above question
	    if($this->confirm($message)) 
		{
		     //first we need to remove all operations, 
			 //roles, child relationship and assignments
			 $this->_authManager->clearAll();
                         		 
 
			 //create the lowest level operations for issues
			 $this->_authManager->createOperation(
				"createIssue",
				"create a new issue"); 
			 $this->_authManager->createOperation(
				"readIssue",
				"read issue information"); 
			 $this->_authManager->createOperation(
				"updateIssue",
				"update issue information"); 
			 $this->_authManager->createOperation(
				"deleteIssue",
				"delete an issue from a project");     
 
			 //create the helpdesk_officer role and add the appropriate 
			 //permissions as children to this role
			 $role=$this->_authManager->createRole("helpdesk_officer"); 
			 $role->addChild("readIssue"); 
 
			 //create the helpdesk_central role, and add the appropriate 
			 //permissions, as well as the helpdesk_officer role itself, as children
			 $role=$this->_authManager->createRole("helpdesk_central"); 
			 $role->addChild("helpdesk_officer"); 
			 $role->addChild("createIssue"); 
			 $role->addChild("updateIssue"); 
 
			 //create the helpdesk_admin role, and add the appropriate permissions, 
			 //as well as both the helpdesk_officer and helpdesk_central roles as children
			 $role=$this->_authManager->createRole("helpdesk_admin"); 
			 $role->addChild("helpdesk_officer"); 
			 $role->addChild("helpdesk_central");
			 $role->addChild("deleteIssue");	
		
		     //provide a message indicating success
		     echo "Authorization hierarchy successfully generated.\n";
        }
 		else
			echo "Operation cancelled.\n";
    }
 
	public function actionDelete()
	{
		$this->ensureAuthManagerDefined();
		$message = "This command will clear all RBAC definitions.\n";
		$message .= "Would you like to continue?";
	    //check the input from the user and continue if they indicated 
	    //yes to the above question
	    if($this->confirm($message)) 
	    {
			$this->_authManager->clearAll();
			echo "Authorization hierarchy removed.\n";
		}
		else
			echo "Delete operation cancelled.\n";
			
	}
	
	protected function ensureAuthManagerDefined()
	{
		//ensure that an authManager is defined as this is mandatory for creating an auth heirarchy
		if(($this->_authManager=Yii::app()->authManager)===null)
		{
		    $message = "Error: an authorization manager, named 'authManager' must be con-figured to use this command.";
			$this->usageError($message);
		}
	}
}

?>
