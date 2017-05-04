<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Dingo\Api\Routing\Helpers;
use App\Category;
use App\Pack;
class HomeController extends Controller
{
   use Helpers;


    public function getIndex(){
    	return view('home/index');
    }


    public function getTest(){

    	return response([5,3,42,2,4,24,24,24,300],200);
    }

    public function getDingoCheck(){

    	/*
           object to array

    	$user = User::findOrFail($id);

        return $this->response->array($user->toArray());*/

      return $this->response->array(['I','will','be','among','the richest',
    		'people','on','earth','with','billions','in dollars.'])->setStatusCode(200);
      }


      public function getCategories(){

        $categories=Category::where('active',1)->get();
        return response($categories,200);
        }

       public function getInitialData(){

           $packs=Pack::where('status',1)->get();
           $categories=Category::where('active',1)->get();


           return response(['packs'=>$packs,'categories'=>$categories],200);

        }
      }


 


