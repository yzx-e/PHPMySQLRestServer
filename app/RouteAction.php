<?php

include_once 'PropertiesDB.php';

class RouteAction {
    
    var $properties;
   
    function __construct() 
    {
        $this->properties = new PropertiesDB();
    }

    function index($request, $response, $args) 
    {
        echo "<h1>Welcome to REST server home page</h1>";
    }
    
    function getProperties($request, $response, $args) 
    {
        $records = $this->properties->getProperties();
        $json_data = json_encode($records);
        
        return $response->withHeader('Content-Type','application/json')->write($json_data);
    }
    
    function addProperties($request, $response, $args) 
    {
        $post = $request->getParsedBody();
        
        foreach($post as $key=>$value)
        {
            ${$key} = $value;
        }
        $values = [$street_address, $suburb, $state, $property_type, $land_area, $selling_price, $filename];
        
        $success = $this->properties->addProperties($values);
        
        if($success)
        {
            $data = ['message' => 'Property saved to database'];
        }
        else
        {
            $data = ['message' => 'Failed to save property to database'];
        }
        
        return $response->withHeader('Content-Type','application/json')->write(json_encode($data));
    }
    
    function searchProperties($request, $response, $args) 
    {
        $keyword = $args['keyword'];
        $records = $this->properties->searchProperties($keyword);
        
        return $response->withHeader('Content-Type','application/json')->write(json_encode($records));
    }
}
