<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Creator;
use App\Models\Collaborator;
use App\Models\Permanent;
use App\Http\Resources\PermanentResource;
use Illuminate\Support\Str;

class PermanentController extends Controller
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
                $per = Creator::where('token', $request->token)->first();
                $identifier = $per->identifier;
                if (Permanent::where('identifier', $identifier)->exists()) {
                    return response([
                        "response" => PermanentResource::Collection(Permanent::where("identifier", $identifier)->orderByRaw("created_at DESC")->get())
                    ], 201);
                }
                else {
                    return response([
                        "response" => "No data found"
                    ], 201);
                }
            }
            else if (Collaborator::where('token', $request->token)->exists()) {
                $per = Collaborator::where('token', $request->token)->first();
                $identifier = $per->identifier;
                if (Permanent::where('identifier', $identifier)->exists()) {
                    return response([
                        "response" => PermanentResource::Collection(Permanent::where("identifier", $identifier)->orderByRaw("created_at DESC")->get())
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

    public function show(Request $request) {
        if (Permanent::where('id', $request->id)->exists()) {
            return response([
                "response" => new PermanentResource(Permanent::findOrFail($request->id))
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
            $per = Creator::where('token', $request->token)->first();
            $identifier = $per->identifier;

            Permanent::create([
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
            $per = Collaborator::where('token', $request->token)->first();
            $identifier = $per->identifier;

            Permanent::create([
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
            $per= Creator::where('token', $request->token)->first();
            $identifier = $per->identifier;
            if (Permanent::where('identifier', $identifier)->exists()) {
                $per->data = is_null($request->data) ? $per->data : $request->data;
                $per->type = is_null($request->type) ? $per->type : $request->type;
                $per->url = is_null($request->url) ? $per->url : $request->url;
                $per->status = is_null($request->status) ? $per->status : $request->status;
                $per->identifier = is_null($request->identifier) ? $per->identifier : $request->identifier;
                $per->save();
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
            $per= Collaborator::where('token', $request->token)->first();
            $identifier = $per->identifier;
            if (Permanent::where('identifier', $identifier)->exists()) {
                $per->data = is_null($request->data) ? $per->data : $request->data;
                $per->type = is_null($request->type) ? $per->type : $request->type;
                $per->url = is_null($request->url) ? $per->url : $request->url;
                $per->status = is_null($request->status) ? $per->status : $request->status;
                $per->identifier = is_null($request->identifier) ? $per->identifier : $request->identifier;
                $per->save();
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
    
    // public function destroy(Request $request) {
    //     if(Creator::where('token', $request->token)->exists()) {
    //         $per = Creator::where('token', $request->token)->first();
    //         $identifier = $per->identifier;
    //         if (Permanent::where('identifier', $identifier)->exists()) {
    //             // deleting account
    //             $del = Permanent::where('identifier', $identifier);
    //             $del->delete();

    //             return response([
    //             "message" => "Record Deleted Successfully"
    //             ], 201);
    //         }
    //         else {
    //             return response([
    //                 "message" => "Record Not Found"
    //             ], 201);
    //         }
    //     }
    //     else {
    //         return response([
    //             "response" => "User Not Found"
    //         ], 201);
    //     }
    // }

    public function destroy(Request $request) {
        if(Creator::where('token', $request->token)->exists()) {
            $per = Creator::where('token', $request->token)->first();
            $identifier = $per->identifier;
            if (Permanent::where('identifier', $identifier)->exists()) {
                // deleting account
                $del = Permanent::where('identifier', $identifier)->where('id', $request->id);
                $del->delete();

                $permanent = Permanent::where('identifier', $identifier)->get();
                $permanentCount = (int)$permanent->count();
                $per->apiLimiter = 100 - $permanentCount;
                $per->save();

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
        else if (Collaborator::where('token', $request->token)->exists()) {
            $per = Collaborator::where('token', $request->token)->first();
            $identifier = $per->identifier;
            if (Permanent::where('identifier', $identifier)->exists()) {
                // deleting account
                $del = Permanent::where('identifier', $identifier)->where('id', $request->id);
                $del->delete();

                $permanent = Permanent::where('identifier', $identifier)->get();
                $permanentCount = (int)$permanent->count();
                $per->apiLimiter = 100 - $permanentCount;
                $per->save();

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
}
