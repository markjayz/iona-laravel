<?php
namespace App\Gateways;

use App\Gateways\Interfaces\CatGatewayServiceInterface;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use SebastianBergmann\Type\NullType;

class CatGatewayService implements CatGatewayServiceInterface
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
     * Get All List of Cats
     * @param  int $page
     * @return array
     */
    public function getByBreeds(): array
    {
        $response = Http::withHeaders([
            'x-api-key' => Config::get('services.catapi.secret'),
        ])->get(Config::get('services.catapi.base_url') . '/breeds');

        return $response->json();
    }

    /**
     * Get all Cats by Breed
     * @param  string $breed
     * @return array
     */
    public function searchByBreeds($breed): array
    {
        $response = Http::withHeaders([
            'x-api-key' => Config::get('services.catapi.secret'),
        ])->get(Config::get('services.catapi.base_url') . '/images/search?breed_ids='.$breed);

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
            'x-api-key' => Config::get('services.catapi.secret'),
        ])->get(Config::get('services.catapi.base_url') . '/images/'.$image_id);
        
        return $response->json();
    }

    
}
