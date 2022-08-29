<?php

namespace App\Http\Controllers\Transformers;

class CatsAndDogTransformer
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
                    'name' => $value['name'],
                    'temperament' => $value['temperament'],
                    'origin' => $value['origin'],
                    'country_code' => $value['country_code'],
                    'description' => $value['description'],
                    'image' => $value['image']
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
