<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Interfaces\DomDocumentInterface;
use DOMDocument;
use DomXPath;

class HtmlRepository implements DomDocumentInterface
{
    public function get_product_info_from_html($data)
    {
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

        return [
            'price' => $price,
            'product_name' => $product_name,
            'header_descs' => $header_descs,
            'header' => $header,
            'image' => $image,
        ];
    }
}
