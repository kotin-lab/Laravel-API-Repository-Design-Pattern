<?php

if (!function_exists('jsonResponse')) {
    /**
     * API Json Response Format
     * 
     * @param mixed $data Default null
     * @param int $statusCode Default 200
     * @param string $message Default empty string
     * @param mixed $errors Default null
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    function jsonResponse(mixed $data = null, int $statusCode = 200, string $message = '', mixed $errors = null)
    {
        $responseData = [
            'statusCode' => $statusCode,
            'results' => $data,
            'message' => $message,
        ];

        if (!empty($errors)) {
            $responseData['errors'] = $errors;
        }

        return response()->json($responseData, $statusCode);
    }
}