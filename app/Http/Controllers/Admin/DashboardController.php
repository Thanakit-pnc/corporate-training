<?php

namespace App\Http\Controllers\Admin;

use App\Company;
use App\Dataset_Company;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function __construct() {
        $this->middleware('auth:web');
    }

    public function index() {

        $companies = Company::with('dataset_company')->get();

        $dataset_companies = Dataset_Company::all();

        return view('admin.dashboard', [
            'companies' => $companies,
            'dataset_companies' => $dataset_companies
        ]);
    }

    public function create_group(Request $request) {

        $this->validate($request, [
            'company' => 'required',
            'company_other' => 'required_if:company,other|unique:dataset_companies,company_name',
            'amount' => 'required|numeric',
        ]);

        if($request->has('company_other')) {

            $dataset_company = Dataset_Company::create([
                'company_name' => $request->company_other
            ]);

            $companies = Company::create([
                'company_id' => $dataset_company->id,
                'amount' => $request->amount
            ]);

        } else {
            $companies = Company::create([
                'company_id' => $request->company,
                'amount' => $request->amount
            ]);
        }

        return redirect()->route('group.index', [$companies->id]);
    }
}
