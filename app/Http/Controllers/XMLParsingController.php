<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class XMLParsingController extends Controller
{
    /**
     * Get data from XML file and return Array
     * @return false|mixed
     */
    public function getXMLFile()
    {
        try {
        $file= file_get_contents(base_path().'\cenik.xml');
        } catch (\ErrorException){
            return false;
        }
        $object = simplexml_load_string($file);

        return json_decode(json_encode($object), true);
    }
}
