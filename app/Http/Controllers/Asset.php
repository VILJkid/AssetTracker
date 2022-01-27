<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\AssetTypeDB;
use App\Models\AssetDB;
use App\Models\AssetImage;

class Asset extends Controller
{
    //Create Asset
    public function createasset()
    {
        $atData = AssetTypeDB::orderBy('assettype')->get();
        return view("AssetTracker.Pages.createasset", ['atData' => $atData]);
    }

    //Validation part for creating Asset
    public function createasset_check(Request $req)
    {
        $validatedData = $req->validate([
            'assetname' => 'required|string|unique:asset_d_b_s',
            'assettype_id' => 'required',
            'assetimage*' => 'image|mimes:jpeg,png,jpg',
        ], [
            'assetname.required' => 'Asset name is required',
            'assetname.string' => 'Invalid asset name',
            'assetname.unique' => 'Asset already exists',
            'assettype_id.required' => 'Asset type is required',
            'assetimage*.image' => 'Upload an image file',
            'assetimage*.mimes' => 'Only jpeg, jpg, and png files are allowed',
        ]);
        if ($validatedData) {
            $assetname = $req->assetname;
            $assettype_id = $req->assettype_id;
            $assetstatus = $req->assetstatus;

            $assetcode = $assettype_id . mt_rand(10000000, 99999999) . mt_rand(1000000, 9999999);

            $asset = new AssetDB();
            $asset->assetname = $assetname;
            $asset->assetcode = $assetcode;
            $asset->assetstatus = $assetstatus;
            $asset->assettype_id = $assettype_id;
            if (!$asset->save())
                return back()->with('error', "Asset Database error");

            $asset_id = $asset->id;

            if ($req->hasFile('assetimage')) {
                $assetImageArr = [];
                foreach ($req->assetimage as $file) {

                    $assetImageName = time() . '-' . $file->getClientOriginalName();
                    $assetImageArr[] = $assetImageName;

                    if (!$file->move(public_path('Images/' . $assettype_id . '/' . $asset_id), $assetImageName)) {
                        return back()->with('error', "Image upload error");
                    } else {
                        $aimage = new AssetImage();
                        $aimage->assetimage = $assetImageName;
                        $aimage->asset_id = $asset_id;
                        if (!$aimage->save())
                            return back()->with('error', "Image Database error");
                    }
                }
            }

            return back()->with('success', "Asset added");
        }
    }

    //Display Asset
    public function showasset(Request $request)
    {
        $aData = AssetDB::latest('updated_at')->paginate(4);
        return view("AssetTracker.Pages.showasset", ['aData' => $aData]);
    }

    //Display Asset Image
    public function showimage(Request $req)
    {
        $aid = $req->aid;
        $aData = AssetDB::where('id', $aid)->get();
        $iData = AssetImage::where('asset_id', $aid)->get();
        return response()->json(["aData" => $aData, "iData" => $iData]);
    }

    //Change Asset Status
    public function changestatus(Request $req)
    {
        $aid = $req->aid;
        $check = $req->check;

        $aData = AssetDB::find($aid);
        $aData->assetstatus = $check;
        $aData->save();

        return response()->json($aData);
    }

    //Edit Asset
    public function editasset(Request $req)
    {
        $editContent = AssetDB::whereId($req->aid)->first();
        return response()->json($editContent);
    }

    //Validation part for editing Asset Type
    public function editasset_check(Request $req, AssetDB $assetVar)
    {

        $rules = array(
            'assetname' => 'required|string|unique:asset_d_b_s',
        );

        $messages = array(
            'assetname.required' => 'Asset name is required',
            'assetname.string' => 'Invalid asset name',
            'assetname.unique' => 'Asset name already exists',
        );

        $error = Validator::make($req->all(), $rules, $messages);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'assetname' => $req->assetname,
        );

        AssetDB::whereId($req->aid)->update($form_data);

        return response()->json(['success' => 'Data is successfully updated']);
    }

    //Delete Asset
    public function delasset(Request $req)
    {
        $delContent = AssetDB::whereId($req->aid);
        $delContent->delete();
    }
}
