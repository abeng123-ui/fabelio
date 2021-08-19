<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Interfaces\ProductInterface;
use App\Models\Links;

class ProductRepository implements ProductInterface
{
    public function create_product($params)
    {
        $data = new Links;
        $data->url = $params['url'];
        $data->save();

        return $data;
    }

    public function check_url_product($params)
    {
        $cek = Links::where('url', (string) $params['url'])->get();
        if(count($cek)){
            return "false";
        }elseif(filter_var($params['url'], FILTER_VALIDATE_URL)){
            return "true";
        }else{
            return "false";
        }
    }

    public function product_list()
    {
        return Links::orderBy('id', 'desc')->get();
    }

    public function find_one_product($id)
    {
        return Links::find($id);
    }

    public function update_product($data, $extracted_data)
    {
        // save product detail
        $price_data = str_replace(".", "", $extracted_data['price']);
        $price_value = filter_var($price_data, FILTER_SANITIZE_NUMBER_INT);
        $price_currency = str_replace($price_value, "", $price_data);
        $data->product_name = $extracted_data['product_name'];
        $data->price_value = $price_value;
        $data->price_currency = $price_currency;
        $data->description = implode(" ", $extracted_data['header_descs']);
        $data->update();

        return $data;
    }
}
