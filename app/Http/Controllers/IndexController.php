<?php

namespace App\Http\Controllers;

use App\Classes\Decolorate;
use Illuminate\Http\Request;


class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->hasFile('imageToGetColor')) {
            if ($request->file('imageToGetColor')->isValid()) {
                try {
                    $file = $request->file('imageToGetColor');
                    $fecha = new \DateTime();
                    $name = $fecha->getTimestamp() . '.' . $file->getClientOriginalExtension();
                    $request->file('imageToGetColor')->move("uploads", $name);
                    $Decolorate = new Decolorate('uploads/' . $name);
                    
                    
                    return view('index', ['colors' => $Decolorate->getColor()]);
                } catch (\Exception $e) {
                    echo $e;
                }

            }
        }
        return view('index');

    }
}
