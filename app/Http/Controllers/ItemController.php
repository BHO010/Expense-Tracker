<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Profile;
use DateTime;
use \stdClass;


class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = Auth::user();
        //$date = date('Y-m-d',strtotime("-1 days"));
        $date = date('Y-m-d');
        $items = Item::where('user_id', $user->id)->where('date', $date)->get();
        $currentTotal = Item::where('user_id', $user->id)->where('date', $date)->sum('expense');
        $total = Item::where('user_id', $user->id)->sum('expense');

        return view('statisticDay', [
            'total' => $total,
            'date' => $date,
            'items' => $items,
            'currentTotal' => $currentTotal
        ]);
    }

    public function rangeIndex()
    {
        //
        $user = Auth::user();
        $startDate = date('Y-m-d',strtotime("-1 days"));
        $endDate = date('Y-m-d');
        $earlier = new DateTime($startDate);
        $later = new DateTime($endDate);
        $dayCount = $later->diff($earlier)->format("%a");

        $array = array();
        for($i=0;$i<=$dayCount;$i++) {
            $template = new stdClass();
            
            $date = date('Y-m-d',strtotime("-$i days"));
            $template->date = $date;
            
            $total = Item::where('user_id', $user->id)->where('date', $date)->sum('expense');
            $template->total = $total;
            
            $food = Item::where('user_id', $user->id)->where('date', $date)->where('category', 'food')->sum('expense');
            $template->food = $food;
            
            $houseHold = Item::where('user_id', $user->id)->where('date', $date)->where('category', 'houseHold')->sum('expense');
            $template->houseHold = $houseHold;
            
            $personal = Item::where('user_id', $user->id)->where('date', $date)->where('category', 'personal')->sum('expense');
            $template->personal = $personal;
            
            $bills = Item::where('user_id', $user->id)->where('date', $date)->where('category', 'bills')->sum('expense');
            $template->bills = $bills;
            
            $misc = Item::where('user_id', $user->id)->where('date', $date)->where('category', 'misc')->sum('expense');
            $template->misc = $misc;
            
            array_push($array, $template);
        }
        

        return view('statisticRange', [
            'startDate' => $startDate,
            'endDate' => $endDate,
            'array' => $array
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("item.create");

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = request()->validate([
            'category' => 'required',
            'item' => 'required',
            'expense'=> 'required'
        ]);
 
        $user = Auth::user();
        $profile = new item();
 
        $profile->user_id = $user->id;
        $profile->category = request('category');
        $profile->name = request('item');
        $profile->expense = request('expense');
        $profile ->date = date('Y-m-d');
        $saved = $profile->save();
 
        if ($saved) {
            return redirect('/profile');
        }
 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        //
        $item = Item::where('id', $item->id)->first();
        $user = Auth::user();
    
        return view('item.edit', [
            'item' => $item,
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        //
        $data = request()->validate([
            'category' => 'required',
            'item' => 'required',
            'expense'=> 'required'
        ]);

        $item->category = request('category');
        $item->name = request('item');
        $item->expense = request('expense');

        $updated = $item->save();
            if ($updated) {
                return redirect('/profile');
            }

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
       $destroyed = $item->delete();
        if ($destroyed) {
            return redirect('/profile');
        }
    }


    public function getDay(Request $request) {

        $data = request()->validate([
            'date' => 'required',
        ]);


        $user = Auth::user();
        $date = request('date');
        $items = Item::where('user_id', $user->id)->where('date', $date)->get();
        $currentTotal = Item::where('user_id', $user->id)->where('date', $date)->sum('expense');

        return view('statisticDay', [
            'date' => $date,
            'items' => $items,
            'currentTotal' => $currentTotal
        ]);
    }

    public function getRange(Request $request) {

        $data = request()->validate([
            'startDate' => 'required',
            'endDate' => 'required'
        ]);

        $user = Auth::user();
        $startDate = request('startDate');
        $endDate = request('endDate');

        $earlier = new DateTime($startDate);
        $later = new DateTime($endDate);
        $dayCount = $later->diff($earlier)->format("%a");
        $totalExp = 0;
        $array = array();
        for($i=0;$i<=$dayCount;$i++) {
            $template = new stdClass();
            
            $date = date('Y-m-d',strtotime("-$i day", $later->format('U')));
            $template->date = $date;
            
            $total = Item::where('user_id', $user->id)->where('date', $date)->sum('expense');
            $template->total = $total;
            $totalExp = $totalExp + $total;
            $food = Item::where('user_id', $user->id)->where('date', $date)->where('category', 'food')->sum('expense');
            $template->food = $food;
            
            $houseHold = Item::where('user_id', $user->id)->where('date', $date)->where('category', 'houseHold')->sum('expense');
            $template->houseHold = $houseHold;
            
            $personal = Item::where('user_id', $user->id)->where('date', $date)->where('category', 'personal')->sum('expense');
            $template->personal = $personal;
            
            $bills = Item::where('user_id', $user->id)->where('date', $date)->where('category', 'bills')->sum('expense');
            $template->bills = $bills;
            
            $misc = Item::where('user_id', $user->id)->where('date', $date)->where('category', 'misc')->sum('expense');
            $template->misc = $misc;
            
            array_push($array, $template);
        }
        $avg = $totalExp / $dayCount+1;

        return view('statisticRange', [
            'startDate' => $startDate,
            'endDate' => $endDate,
            'avg' => $avg,
            'array' => $array
        ]);

    }


}
