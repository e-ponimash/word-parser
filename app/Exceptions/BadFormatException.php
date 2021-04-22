<?php

namespace App\Exceptions;

use Exception;

class BadFormatException extends Exception
{
    /**
     * Render the exception as an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function render($request)
    {
        return response()->json([
            'error' => true,
            'message' => $this->getMessage()
        ], 400);
    }
}
