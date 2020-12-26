<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\FormEntry;
use App\Models\Order;
use App\Models\Product;
use App\Models\Service;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use stdClass;

class CompanyController extends Controller
{
    public function create(bool $previouslyFailed = false)
    {
        $content = new stdClass();
        $content->title = "Specify your company-data";
        $content->method = "POST";
        $content->url = route('company.store');
        $content->previouslyFailed = $previouslyFailed;

        $content->elements = array(
            new FormEntry(
                "Company Name",
                "name",
                "text"
            ),
            new FormEntry(
                "E-Mail Address",
                "emailAddress",
                "email",
                ""
            ),
            new FormEntry(
                "Firstname of a contact person",
                "contactFirstname",
                "text",
                ""
            ),
            new FormEntry(
                "Lastname of a contact person",
                "contactLastname",
                "text",
                ""
            )
        );

        return view('manageDataStructure')->with('formStructure', $content);
    }

    public function store(Request $request)
    {
        if (Company::count() >= 1)
            return response()->json(["Error" => "Only one Company can exist"], 406);

        $company = new Company;
        $company->Name = $request->name;
        $company->EMailAddress = $request->emailAddress;
        $company->ContactFirstname = $request->contactFirstname;
        $company->ContactLastname = $request->contactLastname;
        try {
            $company->save();
        } catch (QueryException $e) {
            return $this->create(true);
        }
        return redirect()->route('dashboard');
    }

    public function edit(Company $company, bool $previouslyFailed = false)
    {
        $content = new stdClass();
        $content->title = "Edit your company-data";
        $content->method = "PUT";
        $content->url = route('company.update',$company->id);
        $content->previouslyFailed = $previouslyFailed;

        $content->elements = array(
            new FormEntry(
                "Company Name",
                "name",
                "text",
                $company->Name
            ),
            new FormEntry(
                "E-Mail Address",
                "emailAddress",
                "email",
                $company->EMailAddress
            ),
            new FormEntry(
                "Firstname of a contact person",
                "contactFirstname",
                "text",
                $company->ContactFirstname
            ),
            new FormEntry(
                "Lastname of a contact person",
                "contactLastname",
                "text",
                $company->ContactLastname
            )
        );

        return view('manageDataStructure')->with('formStructure', $content);
    }
    public function update(Request $request, Company $company)
    {
        DB::beginTransaction();
        $company->Name = $request->name;
        $company->EMailAddress = $request->emailAddress;
        $company->ContactFirstname = $request->contactFirstname;
        $company->ContactLastname = $request->contactLastname;

        if (Company::where("id", $company->id)->exists()) {
            try {
                $company->save();
            } catch (QueryException $e) {
                return $this->edit($company, true);
            }
            DB::commit();
        } else {
            DB::rollBack();
        }
        return redirect()->route('dashboard');
    }

    public function destroy(Company $company)
    {
        //Remove all company data - there can only be one company - so delete all table contents:
        DB::statement('SET FOREIGN_KEY_CHECKS=0;'); //is needed for simple and efficient truncation
        Product::truncate();
        Service::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        Order::truncate();
        Company::truncate();
        return response()->json([], 202);
    }

}
