<?php

namespace App\Services;

use App\Gateways\DogGatewayService;

class DogServices
{
    /**
     * @var DogGatewayService
     */
    private $dogGatewayServices;

    /**
     * DogGatewayService constructor.
     * @param DogGatewayService $dogGatewayServices
     */
    public function __construct(DogGatewayService $dogGatewayServices)
    {
        $this->dogGatewayServices = $dogGatewayServices;
    }

    /**
     * GET Dogs Breeds
     * @param 
     */
    public function getByBreeds()
    {
        return $this->dogGatewayServices->getByBreeds();
    }

    /**
     * GET Dogs by Breeds
     * @param string $breeds
     * @return array 
     */
    public function getImageByBreeds($breeds)
    {
        return $this->dogGatewayServices->searchByBreeds($breeds);
    }

    /**
     * GET Dogs image by image_id
     * @param string $image_id
     */
    public function getImageByImageID($image_id)
    {
        return $this->dogGatewayServices->getImageByImageID($image_id);
    }
}
