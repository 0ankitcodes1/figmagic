<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;
use App\Http\Resources\FileResource;
use Illuminate\Support\Str;

class FileController extends Controller
{
    public function index() {
        if (File::all() === null) {
            return response([
                "message" => "Nothing Was Found"
            ], 404);
        }
        else {
            return FileResource::Collection(File::all());
        }
    }

    public function show($id) {
        if (File::where('id', $id)->exists()) {
            return new FileResource(File::findOrFail($id));
        }
        else {
            return response([
                "message" => "Nothing Was Found"
            ], 404);
        }
    }

    public function create(Request $request) {
        $validator = \Validator::make($request->all(), [
            "name" => ["required", "string", "min:2", "max:100", "files:unique"],
            "creator_identifier" => ["required", "string", "min:32"],
            "from" => ["required", "string", "max:32"],
            "resource_identifier" => ["required", "string", "min:32"],
        ]);

        if ($validator->fails()) {
            return response([
                $validator->errors()
            ], 404);
        }
    
        $identifier_gen = Str::random(32);

        File::create([
            "name" => $request->initiator_identifier,
            "creator_identifier" => $request->user_identifier,
            "from" => $request->from,
            "identifier" => $identifier_gen,
            "status" => "null",
        ]);

        return response([
            "response" => [
                "name" => $request->name,
                "creator_identifier" => $request->creator_identifier,
                "from" => $request->from,
                "identifier" => $identifier_gen,
                "message" => "File is created",
            ]
        ], 201);
    }
    
    public function update(Request $request, $id) {
        if (File::where('id', $id)->exists()) {
            $file = File::find($id);
            $file->name = is_null($request->name) ? $file->name : $request->name;
            $file->creator_identifier = is_null($request->creator_identifier) ? $file->creator_identifier : $request->creator_identifier;
            $file->from = is_null($request->from) ? $file->from : $request->from;
            $file->status = is_null($request->status) ? $file->status : $request->status;
            $file->save();

            return response([
                "response" => [
                    "id" => $file->id,
                    "name" => $file->name,
                    "creator_identifier" => $file->creator_identifier,
                    "from" => $file->from,
                    "status" => $file->status,
                    "identifier" => $file->identifier
                ],
                "message" => "Record Updated Successfully"
            ], 201);
        }
        else {
            return response([
                "message" => "Record Not Found"
            ]);
        }
    }
    
    public function destroy($id) {
        if(File::where('id', $id)->exists()) {
            $file = File::find($id);
            $file->delete();

            return response([
            "message" => "Record Deleted Successfully"
            ], 201);
        } else {
            return response([
            "message" => "Record Not Found"
            ], 404);
        }
    }
}
