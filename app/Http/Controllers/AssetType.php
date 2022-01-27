<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\AssetTypeDB;

class AssetType extends Controller
{
    //Create Asset Type
    public function createat()
    {
        return view("AssetTracker.Pages.createat");
    }

    //Validation part for creating Asset Type
    public function createat_check(Request $req)
    {
        $validatedData = $req->validate([
            'assettype' => 'required|alpha|unique:asset_type_d_b_s',
            'assetdesc' => 'max:500',
        ], [
            'assettype.required' => 'Asset type is required',
            'assettype.alpha' => 'Invalid asset type',
            'assettype.unique' => 'Asset type already exists',
            'assetdesc.max' => 'Description should be less than 500 chars',
        ]);
        if ($validatedData) {
            $assettype = $req->assettype;
            $assetdesc = $req->assetdesc;

            $at = new AssetTypeDB();
            $at->assettype = $assettype;
            $at->assetdesc = $assetdesc;

            if (!$at->save())
                return back()->with('error', "Database error");

            return redirect("/showat");
        }
    }

    //Displaying Asset Type
    public function showat()
    {
        $atData = AssetTypeDB::latest('updated_at')->paginate(2);
        return view("AssetTracker.Pages.showat", ['atData' => $atData]);
    }

    //Editing Asset Type
    public function editat(Request $req)
    {
        $editContent = AssetTypeDB::whereId($req->atid)->first();
        return response()->json($editContent);
    }

    //Validation part for editing Asset Type
    public function editat_check(Request $req, AssetTypeDB $assetVar)
    {
        $rules = array(
            'assettype' => 'required|alpha|unique:asset_type_d_b_s',
            'assetdesc' => 'max:500'
        );

        $messages = array(
            'assettype.required' => 'Asset type is required',
            'assettype.alpha' => 'Invalid asset type',
            'assettype.unique' => 'Asset type already exists',
            'assetdesc.max' => 'Description should be less than 500 chars',
        );

        $error = Validator::make($req->all(), $rules, $messages);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'assettype' => $req->assettype,
            'assetdesc' => $req->assetdesc
        );

        AssetTypeDB::whereId($req->atid)->update($form_data);

        return response()->json(['success' => 'Data is successfully updated']);
    }

    //Delete ASset Type
    public function delat(Request $req)
    {
        $assettype_id = $req->atid;
        $delassettype = AssetTypeDB::find($assettype_id);
        $delassettype->delete();
    }
}
