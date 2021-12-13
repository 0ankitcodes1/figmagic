<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WebInfo;
use App\Http\Resources\WebInfoResource;
use Illuminate\Support\Str;

class WebInfoController extends Controller
{
    public function index() {
        if (WebInfo::all() === null) {
            return response([
                "message" => "Nothing Was Found"
            ], 201);
        }
        else {
            return WebInfoResource::Collection(WebInfo::all());
        }
    }

    public function show($id) {
        if (WebInfo::where('id', $id)->exists()) {
            return new WebInfoResource(WebInfo::findOrFail($id));
        }
        else {
            return response([
                "message" => "Nothing Was Found"
            ], 201);
        }
    }

    public function create(Request $request) {
        $validator = \Validator::make($request->all(), [
            "type" => ["required", "string", "min:2", "max:255"],
            "name" => ["required", "string", "min:2", "max:255"],
            "information" => ["required", "string", "min:2", "max:255"]
        ]);

        if ($validator->fails()) {
            return response([
                $validator->errors()
            ], 201);
        }

        WebInfo::create([
            "type" => $request->type,
            "name" => $request->name,
            "information" => $request->information
        ]);

        return response([
            "response" => [
                "type" => $request->type,
                "name" => $request->name,
                "information" => $request->information
            ]
        ], 201);
    }
    
    public function update(Request $request, $id) {
        if (WebInfo::where('id', $id)->exists()) {
            $web = WebInfo::find($id);
            $web->type = is_null($request->type) ? $web->type : $request->type;
            $web->name = is_null($request->name) ? $web->name : $request->name;
            $web->information = is_null($request->information) ? $web->information : $request->information;
            $web->save();

            return response([
                "response" => [
                    "type" => $web->type,
                    "name" => $web->name,
                    "information" => $web->information
                ],
                "message" => "Record Updated Successfully"
            ], 201);
        }
        else {
            return response([
                "message" => "Record Not Found"
            ], 201);
        }
    }
    
    public function destroy($id) {
        if(WebInfo::where('id', $id)->exists()) {
            $web = WebInfo::find($id);
            $web->delete();

            return response([
                "message" => "Record Deleted Successfully"
            ], 201);
        } else {
            return response([
                "message" => "Record Not Found"
            ], 201);
        }
    }
}
