<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categories;

class CategoryController extends Controller
{

  public function getCategory()
  {
    $categories = Categories::all();
    $parent = Categories::where('parent_category_id','=',NULL)->get();
    $arr=array();

    foreach($parent as $par){
      $child = Categories::where('parent_category_id','=',$par->id)->get();
      $par['children']=$child;
    }

    return $parent;

  }

public function insertCategory(Request $request)
{
  try{
  $data = new Category();

  $data['parent_category_id'] = $request->input('parent_category_id');
  $data['category_name'] = $request->input('category_name');

  $res = $data->save();

  if($res==0){
    return response([
      'msg'=>'fail'
    ],400);
  }else{
    return response([
      'msg'=>'success',

    ],200);
  }
}catch(Exception $error){
   return response([
     'msg'=>'fail'
   ],400);
 }
 }

 public function deleteCategory(Request $request){
 try{
$task =  Category::where('id','=',$request->input('id'))->delete();

   if($task==0){
     return response([
       'msg'=>'fail'
     ],400);
   }else{
     return response([
       'msg'=>'success'
     ],200);
   }
 }catch(Exception $error){
   return response([
     'msg'=>'fail'
   ],400);
 }
 }

 public function updateCategory(Request $request){
 try{
  $task = Category::where('id','=',$request->input('id'))
           ->update([

           'parent_category_id' => $request->input('parent_category_id'),
           'category_name' => $request->input('category_name')

                   ]);

           if($task==0){
             return response([
               'msg'=>'fail'
             ],400);
           }else{
             return response([
               'msg'=>'success'
             ],200);
           }
         }catch(Exception $error){
           return response([
             'msg'=>'fail'
           ],400);
         }
 }
}
