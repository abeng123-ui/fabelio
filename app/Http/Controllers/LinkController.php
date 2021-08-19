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
    public function link_create()
    {
        // display linkk submission form
        return view('link.create');
    }

    public function link_store(ProductInterface $product)
    {
        // create url product
        $data = $product->create_product($this->params);

        // Flash Message / Alert
        $this->request->session()->flash('message.level', 'success');
        $this->request->session()->flash('message.content', 'Successfully saved');

        return redirect('link/detail/'.$data->id);
    }

    public function check_url(ProductInterface $product){
        // check is product url is valid or not
        return $product->check_url_product($this->params);
    }

    public function link_list(ProductInterface $product)
    {
        // get list product
        $data = $product->product_list();

        return view('link.list', compact('data'));
    }

    public function link_detail(ProductInterface $product, DomDocumentInterface $dom)
    {
        $data = $product->find_one_product($this->request['id']);

        if(!$data){
            // redirectback if product is not found
            // Flash Message / Alert
            $this->request->session()->flash('message.level', 'error');
            $this->request->session()->flash('message.content', 'Product is not found');

            return redirect('/');
        }

        // get product info from html
        $extracted_data = $dom->get_product_info_from_html($data);

        // update data product
        $product->update_product($data, $extracted_data);

        // formatting response
        $transform = new ProductTransformer();
        $result = $transform->transform($extracted_data);

        return view('link.detail', compact('result'));

    }

}
