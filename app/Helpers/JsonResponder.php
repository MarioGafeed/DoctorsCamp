<?php

namespace App\Helpers;

class JsonResponder
{
    public static function make($payload = [], int $status = 200, array $errors = [])
    {
        return response()->json(array_filter([
            'data' => $payload,
            'errors' => $errors,
        ]), $status);
    }
}
