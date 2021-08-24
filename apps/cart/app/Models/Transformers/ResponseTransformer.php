<?php namespace App\Models\Transformers;

use Illuminate\Http\JsonResponse;

class ResponseTransformer
{
    /**
     * @param int $statusCode
     * @param array|null $data
     * @return JsonResponse
     */
    public static function responseWithArray(int $statusCode, ?array $data): JsonResponse
    {
        $response = new JsonResponse();
        $response->setStatusCode($statusCode)->setData($data ?? []);

        return $response;
    }
}
