<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;
use App\Http\Resources\PageResource;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function index() {
        if (Page::all() === null) {
            return response([
                "message" => "Nothing Was Found"
            ], 201);
        }
        else {
            return PageResource::Collection(Page::all());
        }
    }

    public function show($id) {
        if (Page::where('id', $id)->exists()) {
            return new WebInfoResource(Page::findOrFail($id));
        }
        else {
            return response([
                "message" => "Nothing Was Found"
            ], 201);
        }
    }

    public function create(Request $request) {
        $validator = \Validator::make($request->all(), [
            "name" => ["required", "string", "min:2", "max:255"],
            "information" => ["required", "string", "min:2", "max:4294967295"]
        ]);

        if ($validator->fails()) {
            return response([
                $validator->errors()
            ], 201);
        }

        Page::create([
            "name" => $request->name,
            "information" => $request->information
        ]);

        return response([
            "response" => [
                "name" => $request->name,
                "information" => $request->information
            ]
        ], 201);
    }
    
    public function update(Request $request, $id) {
        if (Page::where('id', $id)->exists()) {
            $page = Page::find($id);
            $page->name = is_null($request->name) ? $page->name : $request->name;
            $page->information = is_null($request->information) ? $page->information : $request->information;
            $page->save();

            return response([
                "response" => [
                    "name" => $page->name,
                    "information" => $page->information
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
        if(Page::where('id', $id)->exists()) {
            $page = Page::find($id);
            $page->delete();

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
