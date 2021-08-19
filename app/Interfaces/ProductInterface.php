<?php

namespace App\Interfaces;

interface ProductInterface
{
    public function create_product($params);
    public function check_url_product($params);
    public function product_list();
    public function find_one_product($params);
    public function update_product($data, $extracted_data);
}
