<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Response;
use Illuminate\Http\Response as IlluminateResponse;

class ApiController extends Controller
{
    protected $statusCode = IlluminateResponse::HTTP_OK;

    public function getStatusCode()
    {
        return $this->statusCode;
    }

    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    public function respondNotFound($message = 'Não encontrado')
    {
       return $this->setStatusCode(IlluminateResponse::HTTP_NOT_FOUND)->respondWithError($message);
    }

    public function respondCreated($data)
    {
       return $this->setStatusCode(IlluminateResponse::HTTP_CREATED)->respond($data);
    }

    public function respondNoContent()
    {
        return $this->setStatusCode(IlluminateResponse::HTTP_NO_CONTENT)->respond('');
    }

    public function respondBadRequest($message)
    {
       return $this->setStatusCode(IlluminateResponse::HTTP_BAD_REQUEST)->respondWithError($message);
    }

    public function respondUnauthorized($message)
    {
       return $this->setStatusCode(IlluminateResponse::HTTP_UNAUTHORIZED)->respondWithError($message);
    }

//    public function respondInternalError($message)
//    {
//       return $this->setStatusCode(IlluminateResponse::HTTP_INTERNAL_SERVER_ERROR)->respondWithError($message);
//    }

    public function respond($data, $headers = [])
    {
        return Response::json($data, $this->getStatusCode(), $headers);
    }

    public function respondWithError($message)
    {
        return $this->respond([
            'error' => [
                'message' => $message,
                'status_code' => $this->getStatusCode()
            ]
        ]);
    }
}
