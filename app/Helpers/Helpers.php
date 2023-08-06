<?php

namespace App\Helpers;

use App\Models\Category;

class Helpers
{
 public function getCategory($id)
 {
  $category = Category::where('status', 1)->get()->toArray();
  return $this->multipleSelect($category, $parent = 0, $level = 0, $id);
 }
 public function multipleSelect($category, $parent, $level, $id)
 {

  $html = '';

  // if(!empty($category)) {
  //  foreach ($category as $key => $cate) {
  //   if ($cate->parent_id == $parent) {
  //    $html .= '<option value="' . $cate->id . '">' . $cate->name . '</option>';
  //    unset($category[$key]);
  //    // die($cate);

  //   } else {
  //    $html .= '<option value="' . $cate['id'] . '">';
  //    $html .= $this->multipleSelect($category, $cate['parent'], $level+1);
  //    $html .= '</option>';
  //   }
  //  }
  // }
  // $menu_tmp = array();

  // foreach ($category as $key => $cate) {
  //  if ($cate['parent_id'] == $parent) {
  //   $menu_tmp[] = $cate;
  //   unset($category[$key]);
  //  }
  // }

 
  if ($category) {
   foreach ($category as $item) {
    $selected = $item['id'] == $id ? "selected" : '';
    $html .= '<option value="'. $item['id'].'" '.  $selected .'>';
    // $html .= $this->multipleSelect($category, $item['id'], $level + 1);
    $html .= $item['name'];
    $html .= '</option>';
   }
  }
  return $html;
 }
}
