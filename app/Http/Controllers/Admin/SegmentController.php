<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Segment;

class SegmentController extends Controller
{
    public function index() {

        $segments =  Segment::all();
        
        return view('admin.segment.list', compact('segments'));
    }


    public function create()
    {
        return view('admin.segment.create');
    }

    public function store(Request $request)
    {
      
      
        $request->validate([
            'title' => 'required|string|max:255', 
        ]);
    
    
        $data = [
            'title' => $request->input('title'),
           
        ];
    
     
        $success = Segment::create($data); 
      
        if ($success) {
            $request->session()->flash('success', 'Segment added successfully.');
        } else {
            $request->session()->flash('error', 'Error while adding Segment data.');
        }
    
        
        return redirect()->route('segment.index');
    }
    
}
