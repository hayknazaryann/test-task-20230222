<?php

namespace App\Http\Controllers;

use App\Enums\Actions;
use App\Models\User;
use Illuminate\Http\Request;

class JsonDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::find(auth()->id());
        $jsonData = $user->jsonData()->get();
        $view = view('json.table', compact('jsonData'))->render();
        if (\request()->ajax()) {
            return $view;
        }
        return view('json.index', compact('view'));
    }

    /**
     * Display a create form of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $action = Actions::CREATE;
        $view = view('json.form', compact('action'));
        if (\request()->ajax()) {
            return $view->render();
        }
        return view('json.index', compact('view'));
    }


    /**
     * Display a edit form of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $action = Actions::EDIT;
        $view = view('json.form', compact('action'));
        if (\request()->ajax()) {
            return $view->render();
        }
        return view('json.index', compact('view'));
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
