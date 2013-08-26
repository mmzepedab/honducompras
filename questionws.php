<?php
ini_set( 'soap.wsdl_cache_enable' , 0 );
ini_set( 'soap.wsdl_cache_ttl' , 0 );
$client=new SoapClient('http://localhost:8888/honducompras/?r=questions/quote');
function object_to_array($Class)
{
    $Class = (array)$Class;

    foreach($Class as $key => $value)
    {   
        print_r($Class);
	if(is_object($value)&&get_class($value)==='stdClass')
	{
	    $Class[$key] = self::object_to_array($value);
	}
    }
    return $Class;
}
function printListObject($namaObject)
{
    
    foreach($namaObject as $v)
    {
        //print_r($v);
	echo '<br/>';
	$aku= object_to_array($v);
	foreach($aku as $k=>$valu)
	{
	    echo $valu;
	    echo '<br/>';
	}
    }
}
printListObject($client->getQuestions());
?>