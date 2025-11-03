<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LandAreaType;
use Illuminate\Http\Request;

class LandAreaTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $landareatypes =  LandAreaType::all();

        return view('admin.landareatype.index', compact('landareatypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.landareatype.create');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $request->validate([
            'title' => 'required|string|max:255',
        ]);


        $data = [
            'title' => $request->input('title'),

        ];


        $success = LandAreaType::create($data);

        if ($success) {
            $request->session()->flash('success', 'Land area type added successfully.');
        } else {
            $request->session()->flash('error', 'Error while adding land area type data.');
        }


        return redirect()->route('landareatype.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $landareatype = LandAreaType::find($id);
        return view('admin.landareatype.edit', compact('landareatype'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $landareatype = LandAreaType::find($id);
        $landareatype->title = $request->title;

        $landareatype->update();
        return redirect(route('landareatype.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
