<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Form;
use Illuminate\Support\Facades\Redirect;
use App\Interfaces\ProductInterface;
use App\Interfaces\DomDocumentInterface;
use App\Transformers\ProductTransformer;
use Response;
use Session;

class LinkController extends Controller
{
    private $product;
    private $dom;

    public function __construct(Request $request, ProductInterface $product, DomDocumentInterface $dom)
    {
        $this->product = $product;
        $this->dom = $dom;
        $this->params = $request->all();
        $this->request = $request;
    }

    public function link_create()
    {
        // display linkk submission form
        return view('link.create');
    }

    public function link_store()
    {
        // create url product
        $data = $this->product->create_product($this->params);

        // Flash Message / Alert
        $this->request->session()->flash('message.level', 'success');
        $this->request->session()->flash('message.content', 'Successfully saved');

        return redirect('link/detail/'.$data->id);
    }

    public function check_url(){
        \Log::Info("PAA ".json_encode($this->request['url']));
        // check is product url is valid or not
        return $this->product->check_url_product($this->params);
    }

    public function link_list()
    {
        // get list product
        $data = $this->product->product_list();

        return view('link.list', compact('data'));
    }

    public function link_detail()
    {
        $data = $this->product->find_one_product($this->request['id']);

        if(!$data){
            // redirectback if product is not found
            // Flash Message / Alert
            $this->request->session()->flash('message.level', 'error');
            $this->request->session()->flash('message.content', 'Product is not found');

            return redirect('/');
        }

        // get product info from html
        $extracted_data = $this->dom->get_product_info_from_html($data);

        // update data product
        $this->product->update_product($data, $extracted_data);

        // formatting response
        $transform = new ProductTransformer();
        $result = $transform->transform($extracted_data);

        return view('link.detail', compact('result'));

    }

    public function update_product_scheduler()
    {
        $products = $this->product->product_list();
        \Log::Info("products ".json_encode($products));
        $results = [];

        foreach($products as $data){
            $old_price = $data->price_value;
            // get product info from html
            $extracted_data = $this->dom->get_product_info_from_html($data);
            \Log::Info("extracted_data ".json_encode($extracted_data));

            // update data product
            $update = $this->product->update_product($data, $extracted_data);

            array_push($results, $update);
            \Log::Info("Scheduler log, Product Name : ".$data->product_name." - Old Price: ".$old_price. " - New Price: ".$data->price_value);
        }

        return response(["error" => false, "data" => $results],'200');

    }

}
