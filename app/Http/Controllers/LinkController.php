<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Form;
use Illuminate\Support\Facades\Redirect;
use Response;
use Session;
use App\Models\Links;
use DOMDocument;
use DomXPath;

class LinkController extends Controller
{
    public function index()
    {
        // $data = Jenisbarang::all();

        // return view('jenis_barang.index', compact('data'));
    }

    public function link_create()
    {
        return view('link.create');
    }

    public function link_store(Request $request)
    {
        $data = new Links;
        $data->url = $request->url;
        $data->save();

        // Flash Message / Alert
        $request->session()->flash('message.level', 'success');
        $request->session()->flash('message.content', 'Successfully saved');

        return redirect('link/detail/'.$data->id);
    }

    public function check_url(){
        $cek = Links::where('url', (string) Input::get('url'))->get();
        if(count($cek)){
            return "false";
        }elseif(filter_var(Input::get('url'), FILTER_VALIDATE_URL)){
            return "true";
        }else{
            return "false";
        }
    }

    public function link_list(Request $request)
    {
        $data = Links::orderBy('id', 'desc')->get();

        return view('link.list', compact('data'));
    }

    public function link_detail(Request $request)
    {
        $data = Links::find($request->id);

        if(!$data){
            return [
                'price' => '',
                'product_name' => '',
                'image' => '',
                'header_desc' => '',
                'header' => ''
            ];
        }

        // extract data from html
        $ch =curl_init();
        curl_setopt($ch,CURLOPT_URL, $data->url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        curl_close($ch);

        $document = new DOMDocument();
         libxml_use_internal_errors(true);
        $document->loadHTML($response);
        libxml_clear_errors();

        $finder = new DomXPath($document);

        $price = $document->getElementById('product-final-price')->textContent;
        $product_name = $document->getElementById('product-name')->textContent;
        $header  = $finder->query("//*[contains(@class, 'text-center font-bold text-32 mb-4 mt-4')]");;
        $header_desc  = $finder->query("//*[contains(@class, 'grid-container grid-item justify-between css-1520z5e')]");;
        $header_descs = [];
        foreach ($header_desc as $k) {
            array_push($header_descs, $k->textContent);
        }

        $image= $document->getElementById('product-image')->getAttribute('src');


        // save product detail
        $price_data = str_replace(".", "", $price);
        $price_value = filter_var($price_data, FILTER_SANITIZE_NUMBER_INT);
        $price_currency = str_replace($price_value, "", $price_data);

        $data->product_name = $product_name;
        $data->price_value = $price_value;
        $data->price_currency = $price_currency;
        $data->description = implode(" ",$header_descs);
        $data->update();

        $data = [
            'price' => $price,
            'product_name' => $product_name,
            'image' => $image,
            'header_desc' => isset($header_descs) ? str_replace("\n", "<br>", $header_descs) : '',
            'header' => isset($header[0]->textContent) ? $header[0]->textContent : ''
        ];

        return view('link.detail', compact('data'));

    }

}
