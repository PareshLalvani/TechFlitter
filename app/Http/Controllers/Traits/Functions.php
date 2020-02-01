<?php
namespace App\Http\Controllers\Traits;

trait Functions 
{

    public function jsonValidation($errors)
    {
        return $this->send(422, [
            'status'  => 'fail',
            'message' => $errors->messages()->first(),
            'errors'  => $errors->messages(),
        ]);
    }

    public function jsonSuccess(string $message = 'The request was successfully processed')
    {
        return $this->send(200, [
            'status'  => 'success',
            'message' => $message,
        ]);
    }

    public function jsonData($message, $data)
    {
        return $this->send(200, [
            'status'  => 'success',
            'message' => $message,
            'data'    =>  $data,
        ]);
    }

    public function jsonError(string $message = 'The server cannot process the request')
    {
        return $this->send(400, [
            'status'  => 'fail',
            'message' => $message,
        ]);
    }

    public function jsonAccessForbidden()
    {
        return $this->send(403, ["message"=>"Access Forbidden"]);
    }

    public function jsonMethodNotAllowed($message)
    {
        return $this->send(405, ["message"=>$message]);
    }

    public function jsonInternalServerError($message)
    {
        return $this->send(500, ["message"=>$message]);
    }

    protected function send($code, $content = [], $headers = [])
    {
        return response()->json($content, $code);
    }

}