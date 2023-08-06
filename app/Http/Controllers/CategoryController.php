<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\Helpers;
use App\Models\Category;

class CategoryController extends Controller
{
    //
    
    public $helpers;
    function __construct(Helpers $helpers)
    {
        $this->helpers = $helpers;
    }
    public function view(Request $request) {
        $category = $this->helpers->getCategory('');
        return view('add-category', ['category' => $category]);
    }
    public function add(Request $request) {
      $category_name = $request->input('category_name');
      $category = empty($request->input('category')) ? 0 : $request->input('category');
      try {
        $category = Category::create([
            'name' => $category_name,
            'parent_id' => $category,
            'status' => 1,
          ]);
        return redirect('/test4');
      } catch (\Throwable $th) {
        throw $th;
      }
    }
}
