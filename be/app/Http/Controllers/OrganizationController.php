<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrganizationRequest;
use App\Models\Organization;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin', ['except' => ['showall']]);
    }
    
    public function showall()
    {
        return response()->json(Organization::get(['id', 'organization', 'abbreviation']));
    }

    public function search(Request $request)
    {
        return response()->json(
            Organization::where('organization', 'like', '%'.$request->search.'%')->with(['college:id,college','orgtype:id,name'])
            ->orderBy('organization', $request->sort)
            ->paginate(8));
    }

    public function index(Request $request)
    {
        return response()->json(Organization::with(['college:id,college', 'orgtype:id,name'])->orderBy('organization', $request->sort)->paginate(8));
    }

    public function store(OrganizationRequest $request)
    {
       Organization::create($request->validated() + ['abbreviation' => $request->abbreviation, 'organization_service_id' => $request->orgservice]);
       return $this->success('Organization added succesfully!');
    }

    public function update(OrganizationRequest $request, $id)
    {
        $org = Organization::find($id);
        if(!empty($org)) {
            $org->update($request->validated() + ['abbreviation' => $request->abbreviation, 'organization_service_id' => $request->orgservice]);
            return $this->success('Organization updated successfully!');
        }
        else {
            return $this->error('Organization id not found');
        }
    }

    public function destroy($id)
    {
        Organization::destroy($id);
        return $this->success('Organization deleted successfully!');
    }
}
