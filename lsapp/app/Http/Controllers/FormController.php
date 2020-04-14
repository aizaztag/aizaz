<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;




class FormController extends Controller
{
    public function create()
    {
        return view('forms.create');
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'item_name' => 'required|max:255',
            'sku_no' => 'required|alpha_num',
            'price' => 'required|numeric',
        ]);
        \App\Form::create($validatedData);

        return response()->json('Form is successfully validated and data has been saved');

    }
}
