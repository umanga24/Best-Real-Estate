<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PropertyFace;
use Illuminate\Http\Request;

class PropertyFaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $propertyfaces =  PropertyFace::all();

        return view('admin.propertyface.index', compact('propertyfaces'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.propertyface.create');
        
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
            'direction' => 'required|string|max:255',
        ]);


        $data = [
            'direction' => $request->input('direction'),

        ];


        $success = PropertyFace::create($data);

        if ($success) {
            $request->session()->flash('success', 'Property face direction added successfully.');
        } else {
            $request->session()->flash('error', 'Error while adding property face direction data.');
        }


        return redirect()->route('propertyface.index');
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
        $propertyface = PropertyFace::find($id);
        return view('admin.propertyface.edit', compact('propertyface'));
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
        $propertyface = PropertyFace::find($id);
        $propertyface->direction = $request->direction;

        $propertyface->update();
        return redirect(route('propertyface.index'));
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
