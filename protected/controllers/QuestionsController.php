<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of QuestionsController
 *
 * @author mmzepedab
 */
class QuestionsController extends CController{
    public function actions()
    {
        return array(
            'quote'=>array(
                'class'=>'CWebServiceAction',
                'classMap'=>array(
                    'Question'=>'Question',  // or simply 'Post'
                ),
            ),
        );
    }
    
    
    /**
     * @return Question[] a list of posts
     * @soap
     */
    public function getQuestions()
    {
        return Question::model()->findAll();
    }
    
}

?>
