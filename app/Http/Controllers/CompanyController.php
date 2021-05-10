<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\CompanyManager;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index()
    {
        return Company::withCount('managers')->paginate(10);
    }

    public function show($id)
    {
        return Company::findOrFail($id);
    }

    public function update(Request $request,$id)
    {
        $company = Company::findOrFail($id);
        if($request->input('name')) $company->name = $request->input('name');
        if($request->input('website_url')) $company->website = $request->input('website');
        if($request->input('description')) $company->sdescription = $request->input('description');
        if($request->input('compte_address')) $company->compte_address = $request->input('compte_address');
        $company->save();
        return $company;
    }


    public function getManagers($id)
    {
        return CompanyManager::with('manager')->where('company_id',$id)->get();
    }

    public function addManager(Request $request,$id)
    {
        $company = new CompanyManager();
        $company->company_id = $id;
        $company->user_id = $request->input('user_id');
        $company->save();
        return $company;
    }
    public function deleteManager($id, $manager_id)
    {
        $company_manager = CompanyManager::where('user_id',$manager_id)
            ->where('company_id',$id);
        if($company_manager->delete()) return  true;
        return "Error while deleting";
    }

    public function updateAvatar($id, Request $request)
    {
        $company = Company::findOrFail($id);
        $company->logo = $request->file('img')->store('companies_avatar');
        $company->save();
        return $company;

    }
}
