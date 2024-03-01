<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use RealRashid\SweetAlert\Facades\Alert;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function create_order()
    {
        return view('order.createorder');
    }


    public function index()
    {
        //$permissions = $this->permission->all();
        $permissions = Permission::All();

        return view("permission.index", ["permissions" => $permissions]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("permission.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storepermission(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|string|max:250',

        ]);

        Permission::create([
            'name' => $request->name,
        ]);

        Alert::success('Success', 'Permission Created!');
        return redirect()->route('permissionindex');
    }

    //get all permission getAllPermission
    public function getAllPermissions()
    {
        $permissions = Permission::All();
        return response()->json([
            'permissions' => $permissions
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}