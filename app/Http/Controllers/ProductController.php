<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
 use App\Helpers\Helpers;

class ProductController extends Controller
{
    public $helpers;
    function __construct(Helpers $helpers)
    {
        $this->helpers = $helpers;
    }
    public function view(Request $request) {
        $category = $this->helpers->getCategory('');
        return view('add-product', ['category' => $category]);
    }
    public function add(Request $request) {
      $price = $request->input('price');
      $product_name = $request->input('product_name');
      $category = $request->input('category');
      try {
        $product = Product::create([
            'name' => $product_name,
            'price' => $price,
            'category_id' => $category,
          ]);
        return redirect('/test4');
      } catch (\Throwable $th) {
        throw $th;
      }
    }
}
