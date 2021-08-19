<?php

namespace App\Transformers;

class ProductTransformer {

    public function transform($extracted_data) {
        return [
            'price' => $extracted_data['price'],
            'product_name' => $extracted_data['product_name'],
            'image' => $extracted_data['image'],
            'header_desc' => isset($extracted_data['header_descs']) ? str_replace("\n", "<br>", $extracted_data['header_descs']) : '',
            'header' => isset($extracted_data['header'][0]->textContent) ? $extracted_data['header'][0]->textContent : ''
        ];
    }

}

?>
