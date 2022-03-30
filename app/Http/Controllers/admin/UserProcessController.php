<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserProcessController extends Controller
{
    public function index()
    {
        $users = User::paginate(15);
        return view('admin.user.index', compact('users'));
    }

    public function update(Request $request)
    {
        $allowedRoles = ['admin', 'user'];

        if (!in_array($request->type, $allowedRoles)) {
            toastr()->error('Unknown user role!');
            return redirect()->route('users.index');
        }

        User::whereId($request->id)->update([
            'type' => $request->type
        ]) ?? abort(404);

        toastr()->success('User role successfully changed!');
        return redirect()->route('users.index');
    }
}
