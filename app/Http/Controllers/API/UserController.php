<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\Functions;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use Functions;

    public function getUsers(Request $request)
    {
    	$v = validator($request->all(), [
            'page' => 'integer',
            'perPage' => 'integer',
            'search' => 'nullable',
        ]);
        if ($v->fails()) return $this->jsonValidation($v);
        
        $users = User::query();
        
        //Search with name/email
        if($request->search) {
        	$search = $request->search;
        	$users->where('name','like',"%$search%")->orWhere('email','like',"%$search%");
        }


        //Total count
        $count = $users->count();

        ///Pagination
        if($request->page && $request->perPage) {
            $page = $request->page;
            $perPage = $request->perPage;
            $users = $users->skip($perPage*($page-1))->take($perPage);
        }
        $users = $users->latest()->get();
        $data = ['users' => $users, 'count' =>$count];
        return $this->jsonData('User list',$data);
    }

}
