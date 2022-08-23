<?php

namespace App\Http\Controllers;

use App\Models\ProductData;
use Illuminate\Http\Request;

class ProductDataController extends Controller
{
    /**
     * Save Data Action
     * @param Request $request
     * @return bool
     */
    public function saveData(Request $request){
        $data = $request->all();
        $this->saveDataToDB($data);

        return true;
    }

    /**
     * execute mass insert to DB
     * @param $json
     * @return void
     */
    private function saveDataToDB($json){
        $data = $this->transformData($json);
        ProductData::insert($data);
    }

    /**
     * parse data from json to data table structure
     * @param $data
     * @return array
     */
    private function transformData($data)
    {
        $data = json_decode($data["dataArr"]);
        $dataArray = array();
        $i=0;
        foreach ($data as $key => $val) {
                $dataArray[$i]['Product_ID'] = $key;
                $dataArray[$i]['Kusy'] = $val;
                $i++;

        }
        return $dataArray;
    }
}
