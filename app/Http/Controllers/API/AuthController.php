<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;

class AuthController extends BaseController
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        
        if($request->file('profile_photo_path') == '') {
            $profile_photo_path = NULL;
        } else {
            $file = $request->file('profile_photo_path');
            $acak  = $file->getClientOriginalExtension();
            $fileName = rand(11111,99999).'-'.'.'.$acak; 
            $request->file('profile_photo_path')->move("user", $fileName);
            $profile_photo_path = $fileName;
        }
        


        $input = $request->all();
        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => bcrypt($input['password']),
            'profile_photo_path' => $profile_photo_path
        ]);

        $token['token'] =  $user->createToken('MyApp')->accessToken;
        $success['name'] =  $user->name;
        $success['email'] = $user->email;
        $success['profile_photo_path'] = $profile_photo_path;
        $success['id'] = $user->id;
        
        return $this->sendResponseAuth($token, $success, 'User register successfully.');
    }
   
    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
            $user = Auth::user(); 
            $token['token'] =  $user->createToken('MyApp')-> accessToken; 
            $success['name'] =  $user->name;
            $success['email'] = $user->email;
            $success['id'] = $user->id;
            $success['profile_photo_path'] = $user->profile_photo_path;
            
   
            // return $this->sendResponse($success, );
            return $this->sendResponseAuth($token, $success,'User login successfully.');
        } 
        else{ 
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        } 
    }

    public function logout(Request $request)
    {
        $logout = $request->user()->token()->revoke();
        if($logout){
            return response()->json([
                'message' => 'Successfully logged out'
            ]);
        }
    }

    public function fetch(Request $request){
        $user = Auth::user();
        return response()->json(['success' => $user]);
    }

    public function updateProfile(Request $request)
    {
        $data = $request->all();
        
        $user = Auth::user();
        $user->update($data);

        return $this->sendResponseAuth($user, 'User update successfully.');
    }

    public function updatePhoto(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'file' => 'requires|image|max::2048'
        ]);


        if($validator->fails()){
            return ResponseFormatter::error(
                ['error' => $validator->errors()],
                'Update photo fails', 401
            );
        }
        
        // if ($request->file('file')) {
        //     // $file = $request->file->store('assets/user', 'public');
            
        //     //simpan foto ke database(url)
        //     $update = User::where('id', $id)->update([
        //         'name' => $request->name,
        //         'email'   => $request->email,
        //         'password'  => $request->password,
        //         'profile_photo_path' => asset('assets/user'.$file),
        //     ]);
        //     // $user = Auth::user();
        //     // $user->profile_photo_path = $file;
        //     // $user->update();

        //     return $this->sendResponse(['gggg'], 'Create Perusahaan Successfully.');
        // }

        if ($request->file('file')) {

            $file = $request->file->store('assets/user', 'public');

            //store your file into database
            $user = Auth::user();
            $user->profile_photo_path = $file;
            $user->update();

            return $this->sendResponse([$file], 'Create Perusahaan Successfully.');
        }
    }
}
