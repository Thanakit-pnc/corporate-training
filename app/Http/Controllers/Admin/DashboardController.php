<?php

namespace App\Http\Controllers\Admin;

use App\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function __construct() {
        $this->middleware('auth:web');
    }

    public function index() {

        $companies = Company::with('company_students')->get();

        return view('admin.dashboard', [
            'companies' => $companies
        ]);
    }

    public function create_group(Request $request) {

        $this->validate($request, [
            'company' => 'required',
            'trainee' => 'required|numeric',
        ]);

        Company::create([
            'company_name' => $request->company,
            'amount' => $request->trainee,
        ]);
        
        return back();
    }

    public function update(Company $company, Request $request) {
        
        list($day, $month, $year) = explode("/", $request->expire_date);

        $expire = $year.'-'.$month.'-'.$day;
        
        $company->company_name = $request->company;
        $company->amount = $request->amount;
        $company->expire_date = $expire;
        $company->save();

        return redirect()->route('admin.dashboard');
    }
}
