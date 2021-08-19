<?php

namespace Tests\Unit\App\Repositories;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Repositories\ProductRepository;

class ProductRepositoryTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCreateProduct()
    {
        $params = $this->params();
        $product = new ProductRepository();
        $result = $product->create_product($params);

        $this->assertEquals(1, count($result), "testCreateProduct test failed");
    }

    public function testCheckUrlProduct()
    {
        $params = $this->params();
        $product = new ProductRepository();
        $result = $product->check_url_product($params);

        $this->assertEquals("true", $result, "testCheckUrlProduct test failed");
    }

    public function testProductList()
    {
        $product = new ProductRepository();
        $result = $product->product_list();

        $this->assertEquals(0, count($result), "testProductList test failed");
    }

    public function testFindOneProduct()
    {
        $params = $this->params();
        $product = new ProductRepository();

        $data = $product->create_product($params);
        $result = $product->find_one_product($data->id);

        $this->assertEquals(1, count($result), "testFindOneProduct test failed");
    }

    public function testUpdateProduct()
    {
        $params = $this->params();
        $extracted_data = $this->extracted_data();
        $product = new ProductRepository();

        $data = $product->create_product($params);
        $result = $product->update_product($data, $extracted_data);

        $this->assertEquals("Cermin", $result->product_name, "testUpdateProduct test failed");
    }

    public function params(){
        return [
            "url" => "https://fabelio.com/ip/hiasan-dinding-rounda",
        ];
    }

    public function extracted_data(){
        return [
            "price" => "Rp 120.000",
            "product_name" => "Cermin",
            "header_descs" => ["Dimensi", "5 cm"]
        ];
    }
}
