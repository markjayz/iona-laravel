<?php

namespace App\Gateways\Interfaces;

interface DogGatewayServiceInterface
{
    /**
     * Get List of Dogs
     * @return array
     */
    public function getByBreeds(): array;

    /**
     * Get List images of Dogs by breed
     * @param  string $breed
     * @return array
     */
    public function searchByBreeds($breed): array;

    /**
     * Get images by image_id
     * @param  string $image_id
     * @return mixed
     */
    public function getImageByImageID($image_id);
}
