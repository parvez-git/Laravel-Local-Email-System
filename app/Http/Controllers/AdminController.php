<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
    	$users = User::latest()->get();

    	return view('admin.index', compact('users'));
    }

    public function lost()
    {
        $users = User::where('login_at', '<', Carbon::now()->subDays(2))->get();

        return view('admin.lostuser', compact('users'));
    }    

    public function returned()
    {
        $users = User::where('returned', true)->where('admin', '!=', Auth::id())->get();

        return view('admin.returneduser', compact('users'));
    }


    public function block($id)
    {
    	$user = User::findOrFail($id);

    	$user->update(['block' => !$user->block]);

    	return back();
    }


    public function delete($id)
    {
    	User::findOrFail($id)->delete();

    	return back();
    }
}
