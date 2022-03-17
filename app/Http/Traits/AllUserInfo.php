<?php

namespace App\Http\Traits;
use DataTables;
use App\Models\User;
use App\Models\Admin;
use App\Models\Blogger;
use Illuminate\Support\Facades\Hash;

trait AllUserInfo {
    public function getAllUsers($data,$type)
    {
        return DataTables::of($data)
        ->addColumn('action', function ($data) use ($type){
                
            $button = '<a href="JavaScript:void(0);" class="btn btn-info btn-sm  update-user "  data-type="' . $type . '" data-name="' . $data->name . '"data-email="' . $data->email . '"data-id="' . $data->id . '"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;';  
            $button .= '<a href="JavaScript:void(0);" class="btn btn-danger btn-sm   delete"title="Delete" data-type="' . $type . '" data-id=' . $data->id . '><i class="fa fa-trash"></i></a>&nbsp;&nbsp;';  
    
            return $button;
        })
        ->addColumn('name', function ($data)   {
            $email = $data->name;
            return $email;
        })
        ->addColumn('email', function ($data)   {
            $email = $data->email;
            return $email;
        })

        ->rawColumns([ 'action','image','phone','email'])
        ->make(true);
    }

    public function editUserInfo($request,$model)
    {
        $type = $request->type;
        $user = $model::find($request->id);
        if(  $user ){
            $user->name = $request->name;
            $user->email = $request->email;
            $user->save();
            return response()->json([
                'success' => true,
            ], 200);
        }
        return response()->json([
            'success' => false,
        ], 200);
    }
    public function addUserInfo($request,$model)
    {
        $type = $request->type;
        $checkmodel = clone $model;
        $check =  $checkmodel::where('email',$request->email)->first();
        if( $check ){
            return response()->json([
                'success' => false,
                'error' => 'User Exists',
            ], 200);
        }
        
        $model->name = $request->name;
        $model->email = $request->email;
        $model->password =Hash::make($request->password) ;
        $model->save();
        return response()->json([
            'success' => true,
        ], 200);
    }
}