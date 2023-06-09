<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\WelcomeMail;
use App\Models\DeletedUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    /**
     * API Register
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $data = json_decode($request->data);       

        
        $name = $data->name;
        $email    = $data->email;
        $password = $data->password;
        $phone = $data->phone;
        $address = $data->address;

        //let's check if the email is already taken
        $check = User::where('email', $email)->first();
        if ($check) {
            return response()->json(['message' => 'Email Already register with another user!']);
        }

        $user  = User::create([
                        'name' => $name,
                        'email' => $email, 
                        'phone' => $phone,
                        'address' => $address,
                        'password' => Hash::make($password)
                    ]);

        //email will be sent
        // Mail::send(new WelcomeMail($user));

        //generate jwt token
        $token = JWTAuth::fromUser($user);

        $details = array(
                "id" => $user->id, 
                "email" => $user->email, 
                "name" => $user->name,
                "phone" => $user->phone, 
                "address" => $user->address,
                "image" => $user->avatar,
            );
        
        // $result =  json_encode($details);
        // return $result;
        return response()->json([
                'token' => $token,
                'user' => $details
            ]);

    }

    public function login(Request $request){
        $data = json_decode($request->data);

        $email = $data->email;
        $password = $data->password;

        $auth = Auth::attempt([
            'email'=> $email, 
            'password'=> $password,
        ]);

        if ($auth) {
            $checkDelete = DeletedUser::where('user_id', auth()->user()->id)->first();
            if ($checkDelete) {
                return 'false';
            }
            
            $details = array(
                "id" => auth()->user()->id, 
                "name" => auth()->user()->name,
                "email" => auth()->user()->email,
                "phone" => auth()->user()->phone, 
                "address" => auth()->user()->address,
                "image" => auth()->user()->avatar,
            );

            $user = auth()->user();

            //generate jwt token
            $token = JWTAuth::fromUser($user);

            // $result =  json_encode($details);
            // return $result;
            return response()->json([
                'token' => $token,
                'user' => $details
            ]);
        }else{
            return 'false';
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * int $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $token = JWTAuth::parseToken();
        $user = $token->authenticate();
        // dd($user->id);
         // $user = User::find($id);

         $input = $request->except('password', 'password_confirmation');
         if (! $request->filled('password')) 
             {
                $user->fill($input)->save();
             }else{
                $user->password = bcrypt($request->password);
                $user->fill($input)->save();
             }

         

        if ($request->image != 'none') {

            if($request->hasFile('image')) {
                // dd($request->file('image'));
                // Get filename with the extension
                $filenameWithExt = $request->file('image')->getClientOriginalName();
                // Get just filename
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                // Get just ext
                $extension = $request->file('image')->getClientOriginalExtension();
                // Filename to store
                $fileNameToStore= $filename.'_'.time().'.'.$extension;
                // Upload Image
                $path = $request->file('image')->storeAs('public/users/', $fileNameToStore); 

                // resizing an uploaded file starts here  
                $width = Image::make($request->file('image'))->width();  
                $height = Image::make($request->file('image'))->height();  

                $d_width = round($width/2);
                $d_height = round($height/2); 
                // dd('width is: '.$width.' => '.$d_width.'Height is: '.$height.' => '.$d_height);      
                Image::make($request->file('image'))->orientate()->resize($d_height, $d_width)->save('storage/users/' . $fileNameToStore); 
                //resizing ends here  
                
                $userImage = 'users/'.$fileNameToStore;

                $d_user = User::find($id);
                $d_user->update([
                    'avatar' => $userImage,
                ]);
            }else{
                $userImage = $user->avatar;
            }
        }else{
            $userImage = $user->avatar;
        }    

        

        return response()->json(['image' => $userImage]);
    }



    public function deleteUser(){
        $token = JWTAuth::parseToken();
        $user = $token->authenticate();

        if ($user) {
            DeletedUser::create([
                'user_id' => $user->id,
            ]);
        }

        return response()->json(['messgae' => true]);
    }
}
