<?php

namespace App\Http\Controllers;

use App\Imports\HolidaysImport;
use App\Models\Holiday;
use Exception;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Validators\ValidationException;

use Maatwebsite\Excel\Facades\Excel;

class HolidayController extends Controller
{
    public function index()
    {
        $holidays = Holiday::all();
        return view('welcome',compact('holidays'));
    }
    public function import(Request $request)
    {
        try{
            $file = $request->file('file');
            (new HolidaysImport(1))->import($file);
            return redirect('/')->with('success', 'All good!');
        }catch(Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
