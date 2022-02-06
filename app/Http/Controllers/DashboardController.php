<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;   

class DashboardController extends Controller
{
    //
    public function index(){
        return view('admin.dashboard.index');
    }

    public function getIncome(){
        $collection = DB::table('squares')
        ->select(DB::raw("DATE_FORMAT(created_at, '%Y-%m-%e') date,count(*) as y"))
        // ->groupByRaw('parties.name,parties.candidate_photo')
        ->where('type','in')
        ->groupBy(DB::raw('date'))
        ->get();
        $data=[];
        foreach ($collection as $index => $element) {
            $element->y=intval($element->y);
            $element->date=1000*intval(strtotime($element->date));
            $data[$index]=array($element->date,$element->y);
        }
        return response()->json($data);
    }

    public function getExpenses(){
        $collection = DB::table('squares')
        ->select(DB::raw("DATE_FORMAT(created_at, '%Y-%m-%e') date,count(*) as y"))
        // ->groupByRaw('parties.name,parties.candidate_photo')
        ->where('type','out')
        ->groupBy(DB::raw('date'))
        ->get();
        $data=[];
        foreach ($collection as $index => $element) {
            $element->y=intval($element->y);
            $element->date=1000*intval(strtotime($element->date));
            $data[$index]=array($element->date,$element->y);
        }
        return response()->json($data);
    }
}
