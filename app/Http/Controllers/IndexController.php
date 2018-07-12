<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\File\Exception\FileNotFoundException;

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
                } catch (FileNotFoundException $e) {

                }
            }
        }
        return view('index');

    }
}
