<?php

namespace App\Http\Controllers\Transformers;

class ImageTransformer
{
    /**
     * Formats the response.
     * @param object $data
     * @param int $page
     * @param int $limit
     * @return array
     */
    public function transform($page, $limit, $data): array
    {
        if ($data) {
            $result[] = [
                'id' => $data['id'],
                'url' => $data['url'],
                'width' => $data['width'],
                'height' => $data['height']
            ];
        }else {
            $result[] = ['message' => 'No data found!'];
        }

        return [
            'page' => $page,
            'limit' => $limit,
            'result' => $result
        ];
    }
}
