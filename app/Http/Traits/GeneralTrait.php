<?php
namespace App\Http\Traits;

trait GeneralTrait
{
    public function returnData($msg, $tital, $data)
    {
        $message = [
            'msg' => $msg,
            'errNum' => '200',
            'state' => 'success',
            $tital => $data,
        ];
        return response()->json($message, 200);
    }
    public function returnAccept($msg)
    {
        $message = [
            'msg' => $msg,
            'errNum' => '200',
            'state' => 'success',
        ];
        return response()->json($message, 200);
    }
    public function returnCollection($tital,$data)
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
}

?>
