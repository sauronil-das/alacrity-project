<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    //
    public function show()
    {
        // Return all users
        $loans = Loan::all();
        $users = User::all();

        return Inertia::render('Dashboard', compact('loans', 'users'));
    }

    public function update(Request $request, $id)
    {
        // Update a specific user
    }

    public function destroy(User $user)
    {
        $user->delete();
        // Delete a specific user
    }
}
