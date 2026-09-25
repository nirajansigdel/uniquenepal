<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\UserDetail;
use Illuminate\Http\Request;

class UserDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userDetails = UserDetail::with(['user', 'product'])->latest()->paginate(15);
        $page_title = 'User Details';
        return view('backend.userdetails.index', compact('userDetails', 'page_title'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $userDetail = UserDetail::with(['user', 'product'])->findOrFail($id);
        $page_title = 'User Detail - ' . $userDetail->full_name;
        return view('backend.userdetails.show', compact('userDetail', 'page_title'));
    }
}
