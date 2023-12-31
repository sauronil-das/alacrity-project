<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLoanRequest;
use App\Models\Loan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Log\Logger;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log as FacadesLog;
use Inertia\Inertia;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // 
        // $user = User::all();

        // if (!Cache::has('name')) {
        //     Cache::put('name', $user->random('name'), 30);
        // }
        // $name = Cache::get('name');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('CreateLoan');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLoanRequest $request)
    {
        $data = $request->validated();
        $userKeys = [
            'email',
            'name',
            'password',
            'phone',
            'brp',
            'passport_number',
            'sort_code',
        ];
        $userData = Arr::only($data, $userKeys);

        $loanData = Arr::except($data, $userKeys);
        $loanData['loan_date'] = now();
        $loanData['interest_rate'] = 4.5;

        $interestRateDecimal = $loanData['interest_rate'] / 100;

        $loanData['repayment_amount'] = $loanData['amount'] + ($loanData['amount'] * $interestRateDecimal);

        $user = User::create($userData);
        $loan = $user->loans()->create($loanData);
    
        $userEmail = $data['email'];
        Log::info($data['email'].'email');
        Cache::put('userEmail', $userEmail, 5000);

        return [
            'user' => $user,
            'loan' => $loan
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        //
        // $loans = Loan::all();
        // return response()->json($loans);
        

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Loan $loan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Loan $loan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Loan $loan)
    {
        //
        $loan->delete();
        return response()->json(['message' => 'Loan deleted successfully']);    
    }
}
