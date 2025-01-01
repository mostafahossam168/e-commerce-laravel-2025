<?php

namespace App\Traits;

trait ApiResponse
{
    function returnData($data, $message = null, $pagination = null)
    {
        $data = [
            'status' => true,
            'message' => $message,
            'data' => $data,
        ];
        if ($pagination) $data['pagination'] = $pagination;
        if (!$message) $data['message'] = "تم استرجاع البيانات بنجاح";
        return response()->json($data);
    }

    function returnSuccessMessage($message)
    {
        return response()->json([
            'status' => true,
            'message' => $message,
        ]);
    }

    function returnError($message, $status = 200)
    {
        return response()->json([
            'status' => false,
            'message' => $message,
        ], $status);
    }


    function returnValidationError($validator)
    {
        return response()->json([
            'status' => false,
            'message' =>  $validator->errors()->first()
        ]);
    }


    function make_pagination($items)
    {
        $response = [
            'current_page' => $items->currentPage(),
            'last_page' => $items->lastPage(),
            'per_page' => $items->perPage(),
            'from' => $items->firstItem(),
            'to' => $items->lastItem(),
            'total' => $items->total(),
        ];
        return $response;
    }
}
