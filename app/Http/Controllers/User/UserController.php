<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\EditUserRequest;
use App\Http\Traits\GeneralTrait;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    use GeneralTrait;
    public function EditUser(EditUserRequest $request)
    {
        $data = $request->validated();
        $user = User::find($data['id']);
        $user->update($data);
        return $this->returnData('Edited', 'user', $user);
    }
    public function GetCountUser()
    {
        $users = User::where('user_type', 'Passenger')->count();
        return $this->returnCollection('count', $users);
    }

    public function GetCountDriver()
    {
        $users = User::where('user_type', 'Driver')->count();
        return $this->returnCollection('count', $users);
    }
}