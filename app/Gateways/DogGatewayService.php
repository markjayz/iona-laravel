<?php
namespace App\Gateways;

use App\Gateways\Interfaces\DogGatewayServiceInterface;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;

class DogGatewayService implements DogGatewayServiceInterface
{
    /**
     * @var mixed
     */
    private $config;

    /**
     * Constructor
     * @param array $config 
     */
    public function __construct()
    {
    }
    
    /**
     * Retrieves the person information from IMS.
     * @return array
     */
    public function getByBreeds(): array
    {
        $response = Http::withHeaders([
            'x-api-key' => Config::get('services.dogapi.secret'),
        ])->get(Config::get('services.dogapi.base_url') . '/breeds');
 
        if($response->json()){
            return [];
        }

        return $response->json();
    }

    /**
     * Retrieves the person information from IMS.
     * @param  string $breed
     * @return array
     */
    public function searchByBreeds($breed): array
    {
        $response = Http::withHeaders([
            'x-api-key' => Config::get('services.dogapi.secret'),
        ])->get(Config::get('services.dogapi.base_url') . '/images/search?breed_ids='.$breed);
 
        $response->throw();

        return $response->json();
    }

     /**
     * Get all Cats by Breed
     * @param  string $image_id
     * @return mixed
     */
    public function getImageByImageID($image_id)
    {
        $response = Http::withHeaders([
            'x-api-key' => Config::get('services.dogapi.secret'),
        ])->get(Config::get('services.dogapi.base_url') . '/images/'.$image_id);

        return $response->json();
    }

}
