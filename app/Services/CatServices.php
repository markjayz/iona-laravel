<?php

namespace App\Services;

use App\Exceptions\NotExistException;
use App\Gateways\CatGatewayService;

class CatServices
{
    /**
     * @var CatGatewayService
     */
    private $catGatewayServices;

    /**
     * CatAndDogController constructor.
     * @param CatGatewayService $catGatewayServices
     */
    public function __construct(CatGatewayService $catGatewayServices)
    {
        $this->catGatewayServices = $catGatewayServices;
    }

    /**
     * GET Cats Breeds
     * @param 
     */
    public function getByBreeds()
    {
        return $this->catGatewayServices->getByBreeds();
    }

    /**
     * GET Cats by Breeds
     * @param string $breeds
     */
    public function getImageByBreeds($breeds)
    {
        return $this->catGatewayServices->searchByBreeds($breeds);
    }

    /**
     * GET Cats image by image_id
     * @param string $image_id
     */
    public function getImageByImageID($image_id)
    {
        return $this->catGatewayServices->getImageByImageID($image_id);
    }
}
