<?php

class Question extends CActiveRecord
{
    /**
     * @var integer post ID
     * @soap
     */
    public $id;
    /**
     * @var string post title
     * @soap
     */
    public $title;
 
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}

?>
