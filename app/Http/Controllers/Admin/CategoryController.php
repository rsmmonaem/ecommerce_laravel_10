<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class CategoryController extends Controller
{
    function index(){
        return view('admin.dashboard');
    }
}
