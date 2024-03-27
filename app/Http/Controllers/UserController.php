<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
class UserController extends Controller
{

    public function getUser($id){
        $user = User::find($id);
        $response=[$user];
          
          return response($response,200); 
    }
    public function register(UserRequest $request){

        $user=User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone_number' => $request->phone_number,
            'address' => $request->address,
        ]);
    
        $token=$user->createToken('myapptoken')->plainTextToken;
       
    
        $response=[
            'message'=>'User Created Succefully',
            'user' =>[
                "id"=>$user->id,
                'name' => $user->name,
                'email' => $user->email,
                "profile" => $user->profile,
            ],
            'token'=>$token,
        ];
        
        return response($response,200);
        
    
    }
    
     public function login(Request $request)
        {
    $fields=$request->validate([
        'email'=>'required',
        'password'=>'required'
    ]);
    $user=User::where('email',$fields['email'])->first();
    
    if(!$user){
        return response([
            'message'=>"Unregisterd user"
        ],400);
    }
    if(!$user || !Hash::check($fields['password'],$user->password) ){
    return response([
        'message'=>'credentials not correct',
    
    ],401);
    }
    $token=$user->createToken('myapptoken')->plainTextToken;
    
 
    $response=[
        'message'=>'You Are logged In',
        'user'=>[ 
             'id'=> $user->id,
             'name' => $user->name,
             'email' => $user->email,
             'profile'=>$user->profile
            ],
        'token'=>$token,
    ];
    
    return response($response,200);
    
        }
    public function editProfile(Request $request, $id){
        $user= User::find($id);
        $user->profile= $request->profile;
        $user->save();
        $response=[
            'message'=>'Profile Edited Succefully',
            'user' =>[
                'profile' => $user->profile,
            ],
        ];
        
        return response($response,200);


    }
        public function logout(Request $request){
            auth()->user()->tokens()->delete();
    
       
          $message="logged Out";
          return response($message,200);
        }
    
   
          
}
