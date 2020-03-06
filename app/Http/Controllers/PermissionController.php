<?php

namespace App\Http\Controllers;

use App\Permission;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission as SpatiePermission;
use Illuminate\Support\Facades\Redirect;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // function __construct()
    // {
    //     $this->middleware('permission:permission-list');
    //     $this->middleware('permission:permission-create', ['only' => ['create', 'store']]);
    //     $this->middleware('permission:edit', ['only', ['edit' => 'update']]);
    //     $this->middleware('permission:permission-destroy', ['only' => [' destroy']]);
    // }
    public function index(Request $request)
    {
        //
        $permission = SpatiePermission::orderBy('id', 'DESC')->paginate(5);
        return view('permissions.index', compact('permission'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $permission = SpatiePermission::get();
        return view('permissions.create', compact('permission'));
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
        $this->validate($request, ([
            'name' => 'required | unique:permission,name'

        ]));
        SpatiePermission::create(['name' => $request->input('name')]);
        return redirect()->route('permission.index')->with('success', 'Permission created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $permission = SpatiePermission::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        //
    }
}
