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

        $companies = Company::all();

        return view('admin.dashboard', [
            'companies' => $companies
        ]);
    }

    public function create_group(Request $request) {

        $this->validate($request, [
            'company' => 'required',
            'amount' => 'required|numeric',
        ]);

        $companies = Company::create([
            'company_name' => $request->company,
            'amount' => $request->amount
        ]);

        return redirect()->route('group.index', [$companies->id]);
    }
}
