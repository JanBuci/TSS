<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Main Public Index View
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(){
        $data = $this->getDataFromXML();
        $filteredData =  $this->filterXMLData($data["Item"]);
        return view('TSSCloneView')->with('data',$filteredData);
    }

    /**
     * Return data from XML file / API
     * @return false|mixed|null
     */
    private function getDataFromXML(){
        $XMLClass = new XMLParsingController();
        $data = $XMLClass->getXMLFile();
        return $data ? : null;
    }

    /**
     * Filter from XML file by category key
     * @param $data
     * @return array|null
     */
    private function filterXMLData($data)
    {
        $filterArr = array();
        foreach ($data as $dataItem) {
            if (isset($dataItem["Category"])) {
                if (isset($dataItem["Category"]["@attributes"]["id"]) && $dataItem["Category"]["@attributes"]["id"] === env("FILTER_BY_CATEGORY_ID"))
                    $filterArr[] = $dataItem;
            }
        }
        return $filterArr ?: null;
    }
}
