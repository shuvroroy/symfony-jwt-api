<?php

declare(strict_types=1);

namespace App\Traits;

use Symfony\Component\HttpFoundation\JsonResponse;

trait HasJsonResponse
{
    /**
     * @var array
     */
    private $response = [];

    /**
     * @param string $message
     * @param int $code
     * @param array $data
     *
     * @return JsonResponse
     */
    public function createResponse(string $message, int $code, array $data = []): JsonResponse
    {
        $this->response['message'] = $message;

        if (!empty($data)) {
            foreach ($data as $key => $value) {
                $this->response[$key] = $value;
            }
        }

        return $this->json([
            'data' => $this->response
        ], $code);
    }
}
