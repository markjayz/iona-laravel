<?php

namespace App\Gateways\Interfaces;

interface CatGatewayServiceInterface
{
    /**
     * Get List of Cats
     * @return array
     */
    public function getByBreeds(): array;

    /**
     * Get List images of Cats by breed
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
