<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Creator;
use App\Models\Collaborator;
use App\Http\Resources\CollaboratorResource;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class CollaboratorController extends Controller
{
    public function index() {
        if (Collaborator::all() === null) {
            return response([
                "message" => "Nothing Was Found"
            ], 201);
        }
        else {
            return CollaboratorResource::Collection(Collaborator::Paginate(100));
        }
    }

    public function show($id) {
        if (Collaborator::where('id', $id)->exists()) {
            return new CollaboratorResource(Collaborator::findOrFail($id));
        }
        else {
            return response([
                "message" => "Nothing Was Found"
            ], 201);
        }
    }

    public function showSpecific(Request $request) {

        $validator = \Validator::make($request->all(), [
            "token" => ["required", "min:100", "string"],
        ]);

        if ($validator->fails()) {
            return response([
                "response" => $validator->errors(),
                "message" => "Something went wrong"
            ], 201);
        }
        if (Creator::where('token', $request->token)->exists()) {
            $query = Creator::where('token', $request->token)->first();

            if (Collaborator::where('link_to', $query->email)->exists()) {
                $query2 = Collaborator::where('link_to', $query->email)->get();
                return response([
                    "response" => $query2
                ], 201);
            }
            else {
                return response([
                    "message" => "No email found"
                ], 201);
            }
        }
        else {
            return response([
                "message" => "Invalid creator"
            ], 201);
        }
    }

    public function create(Request $request) {

        $validator = \Validator::make($request->all(), [
            "email" => ["required", "email", "unique:collaborators", "max:100"],
            "token" => ["required", "min:100", "string"]
        ]);

        if ($validator->fails()) {
            return response([
                "response" => $validator->errors(),
                "message" => "Something went wrong"
            ], 201);
        }

        if(Creator::where('token', $request->token)->exists()) {
            $query = Creator::where('token', $request->token)->first();

            $tokenGenerator = Str::random(100);
            $identifierGenerator = Str::random(32);
            $email_token = Str::random(6);
            $pic_generator = env('APP_URL').'/images/profile/'.rand(1,9);
    
            Collaborator::create([
                "name" => $request->name,
                "email" => $request->email,
                "link_to" => $query->email,
                "password" => "",
                "companyName" => $request->companyName,
                "role" => $request->role,
                "token" => $tokenGenerator,
                "profilePic" => $pic_generator,
                "apiLimiter" => "100",
                "status" => "verified",
                "identifier" => $identifierGenerator
            ]);
    
            return response([
                "response" => [
                    "name" => $request->name,
                    "email" => $request->email,
                    "companyName" => $request->companyName,
                    "role" => $request->role,
                    "profilePic" => $pic_generator,
                    "token" => $tokenGenerator,
                    "apiLimiter" => "100",
                    "status" => "verified",
                    "identifier" => $identifierGenerator,
                    "redirect_to" => env('APP_URL')."/login"
                ],
                "message" => "New User Added"
            ], 201);

        }
        else {
            return response([
                "message" => "User is not valid"
            ], 201);
        }
    }
    
    public function update(Request $request, $id) {
        if (Collaborator::where('id', $id)->exists()) {
            $collab = Collaborator::find($id);
            
            $collab->name = is_null($request->name) ? $collab->name : $request->name;
            $collab->role = is_null($request->role) ? $collab->role : $request->role;

            $collab->save();

            return response([
                "response" => new CreatorResource(Creator::findOrFail($query->id)),
                "message" => "User Information Is Successfully Updated"
            ], 201);
        }
        else {
            return response([
                "response" => "User Not Found"
            ], 201);
        }
    }

    public function login(Request $request) {
        $validator = \Validator::make($request->all(), [
            "email" => ["required", "email", "max:100"]
        ]);

        if ($validator->fails()) {
            return response([
                "response" => $validator->errors(),
                "message" => "Something went wrong"
            ], 201);
        }
        else {
            if(Collaborator::where('email', $request->email)->exists()) {
                $query = Collaborator::where('email', $request->email)->first();
                if ($request->goto == "web") {
                    return response([
                        "response" => [
                            "id" => $query->id,
                            "name" => $query->name,
                            "email" => $query->email,
                            "link_to" => $query->link_to,
                            "companyName" => $query->companyName,
                            "token" => $query->token,
                            "profilePic" => $query->profilePic,
                            "apiLimiter" => $query->apiLimiter,
                            "status" => $query->status,
                            "identifier" => $query->identifier
                        ],
                        "message" => "Successfully logged in"
                    ], 201);
                }
                else {
                    return redirect(env('APP_URL')."/dashboard")->withCookie(cookie()->forever('token_key', $query->token));
                }
            }
            else {
                return response([
                    "message" => "Email is not valid"
                ], 201);
            }
        }
    }

    public function checkuser(Request $request) {
        $validator = \Validator::make($request->all(), [
            "token" => ["required", "string", "min:100"]
        ]);

        if ($validator->fails()) {
            return response([
                $validator->errors()
            ], 201);
        }

        if (Collaborator::where('token', $request->token)->exists()) {
            $query = Collaborator::where('token', $request->token)->first();
                return response([
                    "response" => [
                        "id" => $query->id,
                        "name" => $query->name,
                        "email" => $query->email,
                        "companyName" => $query->companyName,
                        "role" => $query->role,
                        "profilePic" => $query->profilePic,
                        "status" => $query->status,
                        "identifier" => $query->identifier
                    ],
                    "message" => "Verified user found"
                ], 201);
        }
        else {
            return response([
                "message" => "No User found with this token"
            ], 201);
        }
    }

    public function logout(Request $request) {
        if(Collaborator::where('token', $request->token)->exists()) {
            return response([
                "message" => "You have been logged out"
            ], 201);
        } else {
            return response([
                "message" => "Incorrect Logout Credentials"
            ], 201);
        }
    }

    public function destroy(Request $request, $id) {
        $validator = \Validator::make($request->all(), [
            "token" => ["required", "min:100", "string"],
        ]);

        if ($validator->fails()) {
            return response([
                "response" => $validator->errors(),
                "message" => "Something went wrong"
            ], 201);
        }

        if(Creator::where('token', $request->token)->exists()) {
            $query = Creator::where('token', $request->token)->first();
            $query2 = Collaborator::where('id', $id)->first();
            if ($query->email == $query2->link_to) {
    
                $user_identifier = $query2->identifier;
    
                DB::table("permanents")->where("identifier", "=", $user_identifier)->delete();
                DB::table("temporaries")->where("identifier", "=", $user_identifier)->delete();
    
                // deleting account
                $collaborator = Collaborator::find($id);
                $collaborator->delete();

                return response([
                    "response" => "Email successfully deleted"
                ], 201);
            }
            else {
                return response([
                    "response" => "Collaborator belong to different user"
                ], 201);
            }
        }
        else {
            return response([
                "response" => "Invalid creator"
            ], 201);
        }
    }

    public function destroyContent(Request $request) {
        // first check for creator if not found
        // then check for collaborator

        $validator = \Validator::make($request->all(), [
            "token" => ["required", "min:100", "string"],
        ]);

        if ($validator->fails()) {
            return response([
                "response" => $validator->errors(),
                "message" => "Something went wrong"
            ], 201);
        }

        if (Creator::where("token", $request->token)->exists()) {
            $query = Creator::where("token", $request->token)->first();

            $user_identifier = $query->identifier;

            DB::table("permanents")->where("identifier", "=", $user_identifier)->delete();

            $query->apiLimiter = 100;

            $query->save();

            return response([
                "message" => "All data deleted"
            ], 201);
        }
        else if (Collaborator::where("token", $request->token)->exists()) {
            $query = Collaborator::where("token", $request->token)->first();

            $user_identifier = $query->identifier;

            DB::table("permanents")->where("identifier", "=", $user_identifier)->delete();

            $query->apiLimiter = 100;

            $query->save();

            return response([
                "message" => "All data deleted"
            ], 201);
        }
        else {
            return response([
                "message" => "Token was invalid"
            ], 201);
        }
    }
}
