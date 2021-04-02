<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Post;
use App\Models\User;
use DB;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //$title = 'ADMIN page';



        if (auth()->user()->role == 'admin') {
            
            $data = [
                'users' => User::orderBy('id', 'asc')->paginate(5),
                'posts' => Post::orderBy('id', 'desc')->paginate(5)
            ];

            return view('admin.admin')->with($data);
        }
        //return '/dashboard';
        return redirect('/dashboard')->with('error', 'Unauthorized page');
        //return view('pages.index', compact('title'));
        
    }

    
}
