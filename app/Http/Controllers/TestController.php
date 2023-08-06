<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    public $helpers;
    function __construct(Helpers $helpers)
    {
        $this->helpers = $helpers;
    }
    //
    public function view()
    {
        return view("test");
    }

    public function showTest1()
    {
        $arrdata = [0, 6, 100, 46, 47];
        $arr = [];
        $maxValue = $arrdata[0];
        for ($i = 1; $i < count($arrdata); $i++) {
            if ($maxValue < $arrdata[$i]) {
                $maxValue = $arrdata[$i];
            }
        }
        $maxValue2 = $arrdata[0];
        for ($i = 1; $i < count($arrdata); $i++) {
            if ($maxValue2 < $arrdata[$i] && $arrdata[$i] < $maxValue) {
                $maxValue2 = $arrdata[$i];
            }
        }

        array_push($arr, $maxValue, $maxValue2);
        return view('test1', ['arr' => $arr]);
    }
    public function showTest2()
    {
        $arr = [4, 8, 9, 5, 8, 9, 4, 1, 9, 5];
        $freq = [];
        foreach ($arr as $num) {
            if (isset($freq[$num])) {
                $freq[$num]++;
            } else {
                $freq[$num] = 1;
            }
        }

        $uniqueValue = [];
        foreach ($freq as $num => $count) {
            if ($count == 1) {
                array_push($uniqueValue, $num);
            }
        }
        return view('test2', ['arr' => $uniqueValue]);
    }
    public function showTest3()
    {
        $amount = 2018;
        $arr = [50, 10, 5, 1];
        $i = 0;
        $withdrawl = [];
        while ($amount > 0) {
            if ($amount >= $arr[$i]) {
                $num = intdiv($amount, $arr[$i]);
                if ($num > 0) {
                    $result =  '$' . $arr[$i] . ' have ' . $num;
                    array_push($withdrawl, $result);
                }
                $amount -= $arr[$i] * $num;
            }
            $i++;
        }
        return view('test3', ['arr' => $withdrawl]);
    }

    public function showTest4() {
        $products = DB::table('product')
        ->join('category', 'category.id', '=', 'product.category_id')
        ->select(['category.id', 'category.name as category_name', 'product.name as product_name', 'product.category_id', 'product.price'])
        ->paginate(5);
        // $products = Product::with('category')->paginate(5);
        $category = $this->helpers->getCategory('');
        return view('test4', ['products' => $products, 'category' => $category]);
    }

    public function search(Request $request) {
        $option = $request->input('category');
        $categories = Category::where('status', 1)->where('id', $option)->orWhere('parent_id', '!=', 0)->get()->toArray();
        $arrCate = [];
        foreach($categories as $cate) {
            if($cate['id'] == $option) {
                array_push($arrCate, $cate['id']);
            }
            if(in_array($cate['parent_id'], $arrCate)) {
                array_push($arrCate, $cate['id']);
            }
        }
        $products = DB::table('product')
        ->join('category', 'category.id', '=', 'product.category_id')
        ->whereIn('product.category_id', $arrCate)
        ->select(['category.id', 'category.name as category_name', 'product.name as product_name', 'product.category_id', 'product.price'])
        ->paginate(5);
        $category = $this->helpers->getCategory($option);
        return view('test4', ['products' => $products, 'category' => $category]);    
    }
}
