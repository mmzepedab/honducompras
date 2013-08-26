<?php

//connect to the SOAP service and get the results
     $client = new SoapClient("http://localhost:8888/honducompras/?r=questions/quote");
     $result = $client->getQuestions();
     $xml = $result->getQuestionsResult;
     
     /*
      //process the xml
      $xml = simplexml_load_string($xml);
      foreach($xml->Table as $table) {
            $output .= 
            "<p>$table->Name</p>";
      }*/
      print_r($result);

?>
