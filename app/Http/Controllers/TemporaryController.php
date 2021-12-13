<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Creator;
use App\Models\Collaborator;
use App\Models\Temporary;
use App\Models\Permanent;
use App\Http\Resources\TemporaryResource;
use Illuminate\Support\Str;

class TemporaryController extends Controller
{
    public function index(Request $request) {
        $validator = \Validator::make($request->all(), [
            "token" => ["required", "string", "min:100", "max:255"]
        ]);

        if ($validator->fails()) {
            return response([
               "response" => $validator->errors()
            ], 201);
        }
        else {
            if (Creator::where('token', $request->token)->exists()) {
                $temp = Creator::where('token', $request->token)->first();
                $identifier = $temp->identifier;
                if (Temporary::where('identifier', $identifier)->exists()) {
                    return response([
                        "response" => TemporaryResource::Collection(Temporary::where("identifier", $identifier)->orderByRaw("created_at DESC")->get())
                    ], 201);
                }
                else {
                    return response([
                        "response" => "No data found"
                    ], 201);
                }
            }
            else if (Collaborator::where('token', $request->token)->exists()) {
                $temp = Collaborator::where('token', $request->token)->first();
                $identifier = $temp->identifier;
                if (Temporary::where('identifier', $identifier)->exists()) {
                    return response([
                        "response" => TemporaryResource::Collection(Temporary::where("identifier", $identifier)->orderByRaw("created_at DESC")->get())
                    ], 201);
                }
                else {
                    return response([
                        "response" => "No data found"
                    ], 201);
                }
            }
            else {
                return response([
                    "response" => "User Not Found"
                ], 201);
            }
        }
    }

    public function show($id) {
        if (Temporary::where('id', $id)->exists()) {
            return response([
                "response" => new TemporaryResource(Temporary::findOrFail($id))
            ], 201);
        }
        else {
            return response([
                "message" => "Nothing Was Found"
            ], 201);
        }
    }

    public function create(Request $request) {
        $validator = \Validator::make($request->all(), [
            "data" => ["required", "string", "min:1", "max:4294967295"],
            "type" => ["required", "string", "min:1", "max:255"],
            "url" => ["required", "string", "min:5", "max:65000"],
            "status" => ["required", "string", "max:16"],
            "token" => ["required", "string", "min:100", "max:255"]
        ]);

        if ($validator->fails()) {
            return response([
                "response" => $validator->errors()
            ], 201);
        }

        if (Creator::where('token', $request->token)->exists()) {
            $temp = Creator::where('token', $request->token)->first();
            $identifier = $temp->identifier;

            Temporary::create([
                "data" => $request->data,
                "type" => $request->type,
                "url" => $request->url,
                "status" => $request->status,
                "identifier" => $identifier,
            ]);
    
            return response([
                "response" => [
                    "data" => $request->data,
                    "type" => $request->type,
                    "url" => $request->url,
                    "status" => $request->status,
                    "message" => "New Record Added",
                ]
            ], 201);
        }
        else if (Collaborator::where('token', $request->token)->exists()) {
            $temp = Collaborator::where('token', $request->token)->first();
            $identifier = $temp->identifier;

            Temporary::create([
                "data" => $request->data,
                "type" => $request->type,
                "url" => $request->url,
                "status" => $request->status,
                "identifier" => $identifier,
            ]);
    
            return response([
                "response" => [
                    "data" => $request->data,
                    "type" => $request->type,
                    "url" => $request->url,
                    "status" => $request->status,
                    "message" => "New Record Added",
                ]
            ], 201);
        }
        else {
            return response([
                "response" => "User Not Found"
            ], 201);
        }
    }

    public function update(Request $request) {
        if (Creator::where('token', $request->token)->exists()) {
            $temp = Creator::where('token', $request->token)->first();
            $identifier = $temp->identifier;
            if (Temporary::where('identifier', $identifier)->exists()) {
                $temp->data = is_null($request->data) ? $temp->data : $request->data;
                $temp->type = is_null($request->type) ? $temp->type : $request->type;
                $temp->url = is_null($request->url) ? $temp->url : $request->url;
                $temp->status = is_null($request->status) ? $temp->status : $request->status;
                $temp->identifier = is_null($request->identifier) ? $temp->identifier : $request->identifier;
                $temp->save();
                return response([
                    "response" => [
                        "data" => $request->data,
                        "type" => $request->type,
                        "url" => $request->url,
                        "status" => $request->status,
                        "message" => "Record Updated Successfully"
                    ]
                ], 201);
            }
            else {
                return response([
                    "message" => "Record Not Found"
                ], 201);
            }
        }
        else if (Collaborator::where('token', $request->token)->exists()) {
            $temp = Collaborator::where('token', $request->token)->first();
            $identifier = $temp->identifier;
            if (Temporary::where('identifier', $identifier)->exists()) {
                $temp->data = is_null($request->data) ? $temp->data : $request->data;
                $temp->type = is_null($request->type) ? $temp->type : $request->type;
                $temp->url = is_null($request->url) ? $temp->url : $request->url;
                $temp->status = is_null($request->status) ? $temp->status : $request->status;
                $temp->identifier = is_null($request->identifier) ? $temp->identifier : $request->identifier;
                $temp->save();
                return response([
                    "response" => [
                        "data" => $request->data,
                        "type" => $request->type,
                        "url" => $request->url,
                        "status" => $request->status,
                        "message" => "Record Updated Successfully"
                    ]
                ], 201);
            }
            else {
                return response([
                    "message" => "Record Not Found"
                ], 201);
            }
        }
        else {
            return response([
                "response" => "User Not Found"
            ], 201);
        }
    }
    
    public function destroy(Request $request) {
        if(Creator::where('token', $request->token)->exists()) {
            $temp = Creator::where('token', $request->token)->first();
            $identifier = $temp->identifier;
            if (Temporary::where('identifier', $identifier)->exists()) {
                // deleting account
                $del = Temporary::where('identifier', $identifier);
                $del->delete();

                return response([
                "message" => "Record Deleted Successfully"
                ], 201);
            }
            else {
                return response([
                    "message" => "Record Not Found"
                ], 201);
            }
        }
        else if(Collaborator::where('token', $request->token)->exists()) {
            $temp = Collaborator::where('token', $request->token)->first();
            $identifier = $temp->identifier;
            if (Temporary::where('identifier', $identifier)->exists()) {
                // deleting account
                $del = Temporary::where('identifier', $identifier);
                $del->delete();

                return response([
                "message" => "Record Deleted Successfully"
                ], 201);
            }
            else {
                return response([
                    "message" => "Record Not Found"
                ], 201);
            }
        }
        else {
            return response([
                "response" => "User Not Found"
            ], 201);
        }
    }

    public function transfer(Request $request) {
        if (Creator::where('token', $request->token)->exists()) {
            $temp = Creator::where('token', $request->token)->first();
            $identifier = $temp->identifier;
            if (Temporary::where('identifier', $identifier)->exists()) {
                $tempquery= Temporary::where('identifier', $identifier)->get();
                foreach($tempquery as $query) {
                    $data = $query->data;
                    $type = $query->type;
                    $url = $query->url;
                    $status = "permanent";
                    $identifier = $query->identifier;
                    Permanent::create([
                        "data" => $data,
                        "type" => $type,
                        "url" => $url,
                        "status" => $status,
                        "identifier" => $identifier
                    ]);
                }
                // clearing out temporary
                Temporary::where('identifier', $identifier)->delete();


                $permanent = Permanent::where('identifier', $identifier)->get();

                $permanentCount = (int)$permanent->count();

                // decrement apiCount
                // $temp->apiLimiter = $temp->apiLimiter - $permanentCount;
                $temp->apiLimiter = 100 - $permanentCount;
                $temp->save();

                return response([
                    "message" => "Data transfer from temporary to permanent"
                ], 201);
            }
            else {
                return response([
                    "message" => "Record Not Found"
                ], 201);
            }
        }
        else if (Collaborator::where('token', $request->token)->exists()) {
            $temp = Collaborator::where('token', $request->token)->first();
            $identifier = $temp->identifier;
            if (Temporary::where('identifier', $identifier)->exists()) {
                $tempquery= Temporary::where('identifier', $identifier)->get();
                foreach($tempquery as $query) {
                    $data = $query->data;
                    $type = $query->type;
                    $url = $query->url;
                    $status = "permanent";
                    $identifier = $query->identifier;
                    Permanent::create([
                        "data" => $data,
                        "type" => $type,
                        "url" => $url,
                        "status" => $status,
                        "identifier" => $identifier
                    ]);
                }
                // clearing out temporary
                Temporary::where('identifier', $identifier)->delete();


                $permanent = Permanent::where('identifier', $identifier)->get();

                $permanentCount = (int)$permanent->count();

                // decrement apiCount
                // $temp->apiLimiter = $temp->apiLimiter - $permanentCount;
                $temp->apiLimiter = 100 - $permanentCount;
                $temp->save();

                return response([
                    "message" => "Data transfer from temporary to permanent"
                ], 201);
            }
            else {
                return response([
                    "message" => "Record Not Found"
                ], 201);
            }
        }
        else {
            return response([
                "response" => "User Not Found"
            ], 201);
        }
    }
}
