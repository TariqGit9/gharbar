<?php

namespace App\Http\Traits;
use DataTables;



trait AllUserTable {
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

}