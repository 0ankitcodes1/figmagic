<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Creator;
use App\Http\Resources\CreatorResource;
use App\Models\Collaborator;
use App\Http\Resources\CollaboratorResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\CreatorVerificationMail;
use App\Mail\DeletAccountMail;
use App\Mail\ForgotPasswordMail;
use Carbon\Carbon;

use App\Jobs\CreatorJob;
use App\Jobs\DeleteAccountJob;
use App\Jobs\ForgotPasswordJob;
use Laravel\Socialite\Facades\Socialite;

use Illuminate\Routing\Redirector;


class CreatorController extends Controller
{
    public function index() {
        if (Creator::all() === null) {
            return response([
                "message" => "Nothing Was Found"
            ], 201);
        }
        else {
            return CreatorResource::Collection(Creator::Paginate(100));
        }
    }

    public function show($id) {
        if (Creator::where('id', $id)->exists()) {
            return new CreatorResource(Creator::findOrFail($id));
        }
        else {
            return response([
                "message" => "Nothing Was Found"
            ], 201);
        }
    }

    public function create(Request $request) {
        $validator = \Validator::make($request->all(), [
            "name" => ["required", "string", "min:2" , "max:100"],
            "email" => ["required", "email", "unique:creators"],
            "password" => ["required", "string", "max:255", "confirmed"],
            // "status" => ["required", "string", "max:16"]
        ]);

        if ($validator->fails()) {
            return response([
                "response" => $validator->errors(),
                "message" => "Something went wrong"
            ], 201);
        }

        $tokenGenerator = Str::random(100);

        $identifierGenerator = Str::random(32);
        $email_token = Str::random(6);
        $pic_generator = env('APP_URL').'/images/profile/'.rand(1,9);

        Creator::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password),
            "companyName" => "Freelancer",
            "role" => "Web Designer",
            "token" => $tokenGenerator,
            "profilePic" => $pic_generator,
            "apiLimiter" => "100",
            "verificationCode" => Hash::make($email_token),
            "shareCount" => "5",
            "status" => "not verified",
            "identifier" => $identifierGenerator
        ]);


        $details = [
            "creator" => [
                "name" => $request->name,
                "email" => $request->email,
                "companyName" => "Freelancer",
                "role" => "Web Designer",
                "profilePic" => $pic_generator,
                "apiLimiter" => "100",
                "shareCount" => "1",
                "status" => "not verified",
                "identifier" => $identifierGenerator
            ],
            "email_token" => $email_token
        ];

        /* Add Job Dispatcher Here */
        CreatorJob::dispatch($details);
        /* *********************** */

        return response([
            "response" => [
                "name" => $request->name,
                "email" => $request->email,
                "companyName" => "Freelancer",
                "role" => "Web Designer",
                "profilePic" => $pic_generator,
                "token" => $tokenGenerator,
                "apiLimiter" => "100",
                "shareCount" => "1",
                "status" => "not verified",
                "identifier" => $identifierGenerator,
                "redirect_to" => env('APP_URL')."/login"
            ],
            "message" => "New User Added"
        ], 201);
    }

    public function update(Request $request) {
        if (Creator::where('token', $request->token)->exists()) {
            $query = Creator::where('token', $request->token)->first();
            $creator = Creator::find($query->id);

            if ($request->command == "change password") {
                $validator = \Validator::make($request->all(), [
                    "password" => ["required", "string", "max:255", "confirmed"]
                ]);
        
                if ($validator->fails()) {
                    return response([
                        "response" => $validator->errors(),
                        "message" => "Something went worng"
                    ], 201);
                } else {
                    $creator->password = Hash::make($request->password);
                    $creator->save();
    
                    return response([
                        "response" => new CreatorResource(Creator::findOrFail($query->id)),
                        "message" => "password changed"
                    ], 201);
                }
            }
            else if ($request->command == "change email") {
                $validator = \Validator::make($request->all(), [
                    "email" => ["required", "string", "email", "max:255", "unique:creators"],
                    "password" => ["required", "string", "max:255"]
                ]);
                if ($validator->fails()) {
                    return response([
                        "response" => $validator->errors(),
                        "message" => "Something went wrong"
                    ], 201);
                } else {
                    if (Hash::check($request->password, $query->password)) {
                        $creator->email = $request->email;
                        $creator->save();
        
                        return response([
                            "response" => new CreatorResource(Creator::findOrFail($query->id)),
                            "message" => "Email changed"
                        ], 201);
                    }
                    else {
                        return response([
                            "message" => "Incorrect password"
                        ], 201);
                    }
                }
            }
            else {
                $creator->name = is_null($request->name) ? $creator->name : $request->name;
                $creator->companyName = is_null($request->companyName) ? $creator->companyName : $request->companyName;
                $creator->role = is_null($request->role) ? $creator->role : $request->role;
                $creator->profilePic = is_null($request->profilePic) ? $creator->profilePic : $request->profilePic;
                $creator->apiLimiter = is_null($request->apiLimiter) ? $creator->apiLimiter : $request->apiLimiter;
                $creator->verificationCode = is_null($request->verificationCode) ? $creator->verificationCode : $request->verificationCode;
                $creator->shareCount = is_null($request->shareCount) ? $creator->shareCount : $request->shareCount;
                $creator->status = is_null($request->status) ? $creator->status : $request->status;

                $creator->save();

                return response([
                    "response" => new CreatorResource(Creator::findOrFail($query->id)),
                    "message" => "User Information Is Successfully Updated"
                ], 201);
            }
        }
        else if (Collaborator::where('token', $request->token)->exists()) {
            $query = Collaborator::where('token', $request->token)->first();
            $creator = Collaborator::find($query->id);

            $creator->name = is_null($request->name) ? $creator->name : $request->name;
            $creator->role = is_null($request->role) ? $creator->role : $request->role;
            // $creator->apiLimiter = is_null($request->apiLimiter) ? $creator->apiLimiter : $request->apiLimiter;

            $creator->save();

            return response([
                "response" => new CollaboratorResource(Collaborator::findOrFail($query->id)),
                "message" => "User Information Is Successfully Updated"
            ], 201);
        }
        else {
            return response([
                "response" => "User Not Found"
            ], 201);
        }
    }

    public function destroy(Request $request) {
        if(Creator::where('token', $request->token)->exists()) {
            $query = Creator::where('token', $request->token)->first();

            $details = [
                "creator" => [
                    "name" => $query->name,
                    "email" => $query->email,
                    "companyName" => $query->companyName,
                    "role" => $query->role,
                    "profilePic" => $query->profilePic,
                    "apiLimiter" => $query->apiLimiter,
                    "shareCount" => $query->shareCount,
                    "status" => $query->status,
                    "identifier" => $query->identifier
                ],
                "message" => "Deleting Account"
            ];
    
            // $email = $query->email;
    
            // $when = Carbon::now();
            // Mail::to($email)->later($when , new DeletAccountMail($details));

            /* Add Job Dispatcher Here */
            DeleteAccountJob::dispatch($details);
            /* *********************** */

            $user_identifier = $query->identifier;

            DB::table("permanents")->where("identifier", "=", $user_identifier)->delete();
            DB::table("temporaries")->where("identifier", "=", $user_identifier)->delete();

            // deleting account
            $creator = Creator::find($query->id);
            $creator->delete();

            return response([
                "message" => "Your account was deleted"
            ], 201)->withCookie(cookie()->forever('token_key', ""));
        } else {
            return response([
            "message" => "User Not Found"
            ], 201);
        }
    }

    public function login(Request $request) {
        $validator = \Validator::make($request->all(), [
            "email" => ["required", "email", "max:100"],
            "password" => ["required", "string", "max:255"]
        ]);

        if ($validator->fails()) {
            // return response()->json($validator->errors(), 201);
            return response([
                "response" => $validator->errors(),
                "message" => "Something went wrong"
            ], 201);
        }
        else {
            if(Creator::where('email', $request->email)->exists()) {
                $query = Creator::where('email', $request->email)->first();

                if (Hash::check($request->password, $query->password)) {
                    if ($request->goto == "web") {
                        return response([
                            "response" => [
                                "id" => $query->id,
                                "name" => $query->name,
                                "email" => $query->email,
                                "companyName" => $query->companyName,
                                "token" => $query->token,
                                "profilePic" => $query->profilePic,
                                "apiLimiter" => $query->apiLimiter,
                                "shareCount" => $query->shareCount,
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
                    return response(["message" => "Incorrect password"], 201);
                }
            }
            else {
                return response(["message" => "Email is not valid"], 201);
            }
        }
    }

    public function login_figma(Request $request) {
        $validator = \Validator::make($request->all(), [
            "email" => ["required", "email", "max:100"],
            "password" => ["required", "string", "max:255"]
        ]);

        if ($validator->fails()) {
            return response([
                "response" => $validator->errors(),
                "message" => "Something went wrong"
            ], 201);
        }
        else {
            if(Creator::where('email', $request->email)->exists()) {
                $query = Creator::where('email', $request->email)->first();

                if (Hash::check($request->password, $query->password)) {
                    return response([
                        "response" => [
                            "id" => $query->id,
                            "name" => $query->name,
                            "email" => $query->email,
                            "companyName" => $query->companyName,
                            "token" => $query->token,
                            "profilePic" => $query->profilePic,
                            "apiLimiter" => $query->apiLimiter,
                            "shareCount" => $query->shareCount,
                            "status" => $query->status,
                            "identifier" => $query->identifier
                        ],
                        "message" => "Successfully logged in"
                    ], 201);
                }
                else {
                    return response(["message" => "Incorrect password"], 201);
                }
            }
            else {
                return response(["message" => "Email is not valid"], 201);
            }
        }
    }

    public function logout_figma(Request $request) {
        if(Creator::where('token', $request->token)->exists()) {
            return response([
                "message" => "You have been logged out"
            ], 201);
        } else {
            return response([
                "message" => "Incorrect Logout Credentials"
            ], 201);
        }
    }
    
    public function logout(Request $request) {
        if(Creator::where('token', $request->token)->exists()) {
            // $query = Creator::where('token', $request->token);
            // $id = $query->first()->id;
            // Creator::where('id', $id)->update(['token' => '']);
            return response([
                "message" => "You have been logged out"
            ], 201)->withCookie(cookie()->forever('token_key', ""));
        } 
        else if(Collaborator::where('token', $request->token)->exists()) {
            return response([
                "message" => "You have been logged out"
            ], 201)->withCookie(cookie()->forever('token_key', ""));
        }
        else {
            return response([
                "message" => "Incorrect Logout Credentials"
            ], 201);
        }
    }

    public function verify(Request $request) {

        $validator = \Validator::make($request->all(), [
            "token" => ["required", "string", "min:100", "max:255"],
            "verification_code" => ["required", "min:6"]
        ]);

        if ($validator->fails()) {
            // return response()->json($validator->errors(), 201);
            return response([
                "response" => $validator->errors(),
                "message" => "Request Did Not Went Through"
            ], 201);
        }
        else {
            if(Creator::where('token', $request->token)->exists()) {
                $query = Creator::where("token", $request->token)->first();
                if (Hash::check($request->verification_code, $query->verificationCode)) {
                    $query->update(["status" => "verified"]);
                    $query->update(["verificationCode" => ""]);
                    return response([
                        "response" => "User Email Is Verified"
                    ], 201);
                }
                else {
                    return response([
                        "response" => "Wrong User"
                    ], 201);
                }
            }
            else {
                return response([
                    "message" => "Something Went Wrong"
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

        if (Creator::where('token', $request->token)->exists()) {
            $query = Creator::where('token', $request->token)->first();
            if ($query->status == "verified") {
                return response([
                    "response" => [
                        "id" => $query->id,
                        "name" => $query->name,
                        "email" => $query->email,
                        "companyName" => $query->companyName,
                        "role" => $query->role,
                        "profilePic" => $query->profilePic,
                        "apiLimiter" => $query->apiLimiter,
                        "shareCount" => $query->shareCount,
                        "status" => $query->status,
                        "identifier" => $query->identifier
                    ],
                    "message" => "Verified user found"
                ], 201);
            }
            else {
                return response([
                    "response" => [
                        "id" => $query->id,
                        "name" => $query->name,
                        "email" => $query->email,
                        "companyName" => $query->companyName,
                        "role" => $query->role,
                        "profilePic" => $query->profilePic,
                        "apiLimiter" => $query->apiLimiter,
                        "shareCount" => $query->shareCount,
                        "status" => $query->status,
                        "identifier" => $query->identifier,
                        "redirect_to" => env('APP_URL')."/confirm-email"
                    ],
                    "message" => "Unverified user found"
                ], 201);
            }
        }
        else if (Collaborator::where('token', $request->token)->exists()) {
                $query = Collaborator::where('token', $request->token)->first();
                return response([
                    "response" => [
                        "id" => $query->id,
                        "name" => $query->name,
                        "email" => $query->email,
                        "companyName" => $query->companyName,
                        "apiLimiter" => $query->apiLimiter,
                        "role" => $query->role,
                        "profilePic" => $query->profilePic,
                        "status" => $query->status,
                        "identifier" => $query->identifier
                    ],
                    "message" => "Verified user found",
                    "note" => "collaborator"
                ], 201);
            }
            else {
                return response([
                    "message" => "No User found with this token"
                ], 201);
            }
        
    }

    public function resend(Request $request) {
        $validator = \Validator::make($request->all(), [
            "token" => ["required", "string", "min:100"]
        ]);
        if ($validator->fails()) {
            return response([
                $validator->errors()
            ], 201);
        }
        if (Creator::where('token', $request->token)->exists()) {
            $query = Creator::where("token", $request->token)->first();
            if ($query->status == "verified") {
                return response([
                    "message" => "Already verified"
                ], 201);
            }
            else{
                $creator = Creator::find($query->id);

                $email_token = Str::random(6);

                $details = [
                    "creator" => [
                        "name" => $query->name,
                        "email" => $query->email,
                        "companyName" => $query->companyName,
                        "role" => $query->role,
                        "profilePic" => $query->profilePic,
                        "apiLimiter" => $query->apiLimiter,
                        "shareCount" => $query->shareCount,
                        "status" => $query->status,
                        "identifier" => $query->identifier
                    ],
                    "email_token" => $email_token
                ];
        
                /* Add Job Dispatcher Here */
                CreatorJob::dispatch($details);
                /* *********************** */

                $creator->verificationCode = Hash::make($email_token);
                $creator->status = "not verified";
                $creator->save();

                return response([
                    "message" => "Verify email resended"
                ], 201);
            }
        }
        else {
            return response([
                "message" => "No User found with this token"
            ], 201);
        }
    }

    public function forgotPassword(Request $request) {
        $validator = \Validator::make($request->all(), [
            "email" => ["required", "email", "max:100"]
        ]);

        if ($validator->fails()) {
            // return response()->json($validator->errors(), 201);
            return response([
                "response" => $validator->errors(),
                "message" => "Something went wrong"
            ], 201);
        }
        else {
            if(Creator::where('email', $request->email)->exists()) {
                $query = Creator::where('email', $request->email)->first();

                $details = [
                    "creator" => [
                        "name" => $query->name,
                        "email" => $query->email,
                        "companyName" => $query->companyName,
                        "role" => $query->role,
                        "token" => $query->token,
                        "profilePic" => $query->profilePic,
                        "apiLimiter" => $query->apiLimiter,
                        "shareCount" => $query->shareCount,
                        "status" => $query->status,
                        "identifier" => $query->identifier
                    ],
                    "message" => "sending mail"
                ];
        
                // $email = $query->email;
        
                // $when = Carbon::now();
                // Mail::to($email)->later($when , new ForgotPasswordMail($details));

                /* Add Job Dispatcher Here */
                ForgotPasswordJob::dispatch($details);
                /* *********************** */

                return response([
                    "message" => "Mail Sent With Reset Link"
                ], 201);
            }
            else {
                return response(["message" => "Email is not valid"], 201);
            }
        }
    }

    public function googleSignup() {

        $google = Socialite::driver('google')->stateless()->user();

        $email = $google->email;
        $name = $google->name;
        $avatar = $google->avatar;

        if (Creator::where('email', $email)->exists()) {
            // email exist sign them in

            $query = Creator::where('email', $email)->first();
            

            return redirect(env('APP_URL')."/dashboard")->withCookie(cookie()->forever('token_key', $query->token));
        }
        else {
            // email doesn't exist sign them up
            $tokenGenerator = Str::random(100);
            $passwordGenerator = Str::random(100);
    
            $identifierGenerator = Str::random(32);
    
            Creator::create([
                "name" => $name,
                "email" => $email,
                "password" => $passwordGenerator,
                "companyName" => "Freelancer",
                "role" => "Web Designer",
                "token" => $tokenGenerator,
                "profilePic" => $avatar,
                "apiLimiter" => "100",
                "verificationCode" => "",
                "shareCount" => 5,
                "status" => "verified",
                "identifier" => $identifierGenerator
            ]);

            return redirect(env('APP_URL')."/dashboard")->withCookie(cookie()->forever('token_key', $tokenGenerator));
        }
    }
}
