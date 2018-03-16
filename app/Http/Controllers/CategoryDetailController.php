<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CategoryDetail;

class CategoryDetailController extends Controller
{
  public function getCategoryDetail()
  {
  return CategoryDetail::all();
  }

public function insertCategoryDetail(Request $request){
  try{
  $data = new CategoryDetail();

  $data['category_id'] = $request->input('category_id');
  $data['key'] = $request->input('key');

  $data->save();

  if($data==0){
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

 public function deleteCategoryDetail(Request $request){
 try{
  $task = CategoryDetail::where('id','=',$request->input('id'))->delete();

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

 public function updateCategoryDetail(Request $request){
 try{
  $task = CategoryDetail::where('id','=',$request->input('id'))
           ->update([

           'category_id' => $request->input('category_id'),
           'key' => $request->input('key')

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
