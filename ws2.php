<?php

//connect to the SOAP service and get the results
     $client = new SoapClient("http://www.webservicex.net/country.asmx?WSDL");
     $result = $client->GetCountries();
     $xml = $result->GetCountriesResult;
      //process the xml
      $xml = simplexml_load_string($xml);
      foreach($xml->Table as $table) {
            $output .= 
            "<p>$table->Name</p>";
      }
      print_r($output);
    

?>
