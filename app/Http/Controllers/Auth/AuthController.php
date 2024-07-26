<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\AddUserRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Traits\GeneralTrait;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    use GeneralTrait;

    public function Login(LoginRequest $request)
    {

        $data = $request->validated();
        $user = User::where('username', $data['username'])->first();
        if ($user) {
            if (!Hash::check($data['password'], $user->password)) {
                return $this->returnError('incorrect password', 402);
            } else {
                $token = $user->createToken('auth_token')->plainTextToken;
                return $this->returnLogin('login successfuly', $token, $user->user_type);
            }
        } else {
            return $this->returnError('incorrect username', 402);
        }
    }
    public function RegisterPassenger(AddUserRequest $request)
    {
        $data = $request->validated();
        $data['user_type'] = 'Passenger';
        $user = User::create($data);
        return $this->returnRegister('passenger', 'Registered successfuly');
    }
    public function RegisterDriver(AddUserRequest $request)
    {
        $data = $request->validated();
        $data['user_type'] = 'Driver';
        $user = User::create($data);
        return $this->returnRegister('driver', 'Registered successfuly');
    }

    public function RegisterAdmin(AddUserRequest $request)
    {
        $data = $request->validated();
        $data['user_type'] = 'Admin';
        $user = User::create($data);
        return $this->returnRegister('admin', 'Registered successfuly');
    }
}
