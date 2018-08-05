<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PhotoController extends Controller
{
    
    public function index()
    {
        return "Index : List Table";
    }

   
    public function create()
    {
        return "Create : Create Form";
    }

   
    public function store(Request $request)
    {
        return "Store : Add Data to Table";
    }

    public function show($id)
    {
        return "Show ID : " .$id. " :Show Data Detail";
    }

    
    public function edit($id)
    {
        return "Edit ID : " .$id. " : Edit My ID";
    }

    public function update(Request $request, $id)
    {
        dd($request);
        return "Update ID : " .$id. " : Save My ID";
    }


    public function destroy($id)
    {
        return "Delete Data ID : ".$id." : Delete My ID";
    }
}
