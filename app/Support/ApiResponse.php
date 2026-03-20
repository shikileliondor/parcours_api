<?php

namespace App\Support;

use Illuminate\Http\JsonResponse;

class ApiResponse
{
    /**
     * @param  mixed  $data
     * @param  array<string, mixed>|null  $meta
     */
    public static function success(mixed $data, string $message = 'OK', ?array $meta = null, int $status = 200): JsonResponse
    {
        $payload = [
            'data' => $data,
            'message' => $message,
        ];

        if ($meta !== null) {
            $payload['meta'] = $meta;
        }

        return response()->json($payload, $status);
    }

    /**
     * @param  array<string, mixed>|null  $details
     */
    public static function error(string $code, string $message, ?array $details = null, int $status = 400): JsonResponse
    {
        return response()->json([
            'error' => [
                'code' => $code,
                'message' => $message,
                'details' => $details ?? (object) [],
            ],
        ], $status);
    }
}
