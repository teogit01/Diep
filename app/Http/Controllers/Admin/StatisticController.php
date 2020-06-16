<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\bill;
use Carbon\Carbon;
class StatisticController extends Controller
{
   	public function index(){
   		$total = 0;
   		$date = Carbon::now()->month;
   		$bills = bill::get(['id','date']);
   		foreach ($bills as $bill){
   			if (Carbon::create($bill->date)->month == $date){
   				 $total = $total + bill::find($bill->id)->get('total')[0]->total;
   				
   			}
   		}
   		
   		return view('admin.statistic.index',['total'=>$total]);
   	}

   	public function month(Request $request){

   		$total = 0;
   		$date = $request->month;
   		$bills = bill::get(['id','date']);
   		foreach ($bills as $bill){
   			if (Carbon::create($bill->date)->month == $date){
   				 $total = $total + bill::find($bill->id)->get('total')[0]->total;
   				
   			}
   		}
   		return view('admin.statistic.update',['total'=>$total]);
   	}

      public function quy(Request $request){
         
         $total = 0;
         for($i = $request->start; $i < $request->start+3; $i++){
            $bills = bill::get(['id','date']);
               foreach($bills as $bill){
                  if (Carbon::create($bill->date)->month == $i){
                     $total = $total + bill::find($bill->id)->get('total')[0]->total;
                  }
               }
         }
         return view('admin.statistic.update',['total'=>$total]);
      }
}
	