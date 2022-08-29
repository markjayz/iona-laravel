<?php

namespace App\Http\Controllers\Transformers;

class CatsAndDogImageTransformer
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
            foreach ($data as $value) {
                $result[] = [
                    'id' => $value['id'],
                    'url' => $value['url'],
                    'width' => $value['width'],
                    'height' => $value['height']
                ];
            }
        }else{
            $result[] = ['message' => 'No data found!'];
        }

        return [
            'page' => $page,
            'limit' => $limit,
            'result' => $result
        ];
    }
}
