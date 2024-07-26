<?php

namespace App\Http\Traits;

trait GeneralTrait
{
    public function returnData($msg, $tital, $data)
    {
        $message = [
            'msg' => $msg,
            'state' => 'success',
            $tital => $data,
        ];
        return response()->json($message, 200);
    }
    public function returnAccept($msg)
    {
        $message = [
            'msg' => $msg,
            'state' => 'success',
        ];
        return response()->json($message, 200);
    }
    public function returnCollection($tital, $data)
    {
        $message = [
            $tital => $data
        ];
        return response()->json($message, 200);
    }
    public function returnError($msg, $errNum)
    {
        $message = [
            'msg' => $msg,
            'errNum' => $errNum,
            'state' => 'failuer',
        ];
        return response()->json($message, $errNum);
    }
    public function returnLogin($msg, $token, $role)
    {
        $message = [
            'msg' => $msg,
            'token' => $token,
            'role' => $role,
            'date' => now()->format('Y-M-d H:i:s'),
            'state' => 'success',
        ];
        return response()->json($message, 200);
    }
    public function returnRegister($role, $msg)
    {
        $message = [
            'message' => ucfirst($role) . ' ' . strtolower($msg),
            'state' => 'success',
        ];
        return response()->json($message, 200);
    }
}
