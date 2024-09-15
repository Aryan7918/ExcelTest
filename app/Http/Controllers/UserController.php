<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use PHPUnit\TextUI\Configuration\Directory;

class UserController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function import(Request $request)
    {
        $validate = $request->validate([
            'file' => 'required|mimes:xls,xlsx',
        ]);
        $file = $request->file('file');
        // $path = public_path('uploads');
        // if(!File::exists($path)) {
        //     File::makeDirectory($path, 0777, true);
        // }
        // $file->move($path, $file->getClientOriginalName());
        // return response()->json(['message' => 'File uploaded successfully']);
        // Excel::import(new HolidayImport, 'users.xlsx');
        
        return redirect('/')->with('success', 'All good!');

    }
   
}
