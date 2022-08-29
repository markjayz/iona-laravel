<?php

namespace App\Http\Controllers;

use App\Exceptions\NotExistException;
use App\Http\Controllers\Transformers\CatsAndDogImageTransformer;
use App\Http\Controllers\Transformers\CatsAndDogTransformer;
use App\Http\Controllers\Transformers\ImageTransformer;
use App\Services\CatServices;
use App\Services\DogServices;
use App\Traits\PaginationTrait;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Symfony\Component\HttpKernel\Exception\HttpException;

class CatAndDogController extends BaseController
{
    use PaginationTrait;
    /**
     * @var CatServices
     */
    private $catServices;

    /**
     * @var CatsAndDogTransformer
     */
    private $catsAndDogTransformer;

     /**
     * @var DogServices
     */
    private $dogServices;

    /**
     * @var CatsAndDogImageTransformer
     */
    private $catsAndDogImageTransformer;

    /**
     * @var ImageTransformer
     */
    private $imageTransformer;

    /**
     * CatAndDogController constructor.
     * @param CatServices $catServices
     * @param DogServices $dogServices
     */
    public function __construct(
        CatServices $catServices,
        CatsAndDogTransformer $catsAndDogTransformer,
        DogServices $dogServices,
        CatsAndDogImageTransformer $catsAndDogImageTransformer,
        ImageTransformer $imageTransformer,
    ) {
        $this->catServices = $catServices;
        $this->catsAndDogTransformer = $catsAndDogTransformer;
        $this->dogServices = $dogServices;
        $this->catsAndDogImageTransformer = $catsAndDogImageTransformer;
        $this->imageTransformer = $imageTransformer;
    }

    /**
     * Returns a list of records.
     * @param  Request $request Request object.
     * @return array
     */
    public function breeds(Request $request)
    {
        $data = $request->toArray();
        $page = isset($data['page']) ? $data['page'] : 1;
        $limit = isset($data['limit']) ? $data['limit'] : 25;

        try {
            $cats =  $this->catServices->getByBreeds();
            $dogs =  $this->dogServices->getByBreeds();
            $result = array_merge($cats, $dogs);

            $result = $this->paginate($result, $limit, $page);
            
            $response = $this->catsAndDogTransformer->transform($page, $limit, $result);

            return  $response;
            
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Returns a list of Cats and Dogs images.
     * @param  Request $request Request object.
     * @param string $breed
     *  @return array
     */
    public function images(Request $request, $breed)
    {
        $data = $request->toArray();
        $page = isset($data['page']) ? $data['page'] : 1;
        $limit = isset($data['limit']) ? $data['limit'] : 25;

        try {
            $cats =  $this->catServices->getImageByBreeds($breed);
            $dogs =  $this->dogServices->getImageByBreeds($breed);
           
            $merge = array_merge(!empty($cats) ? $cats : [], !empty($dogs) ? $dogs : []);
           
            $result = !empty($merge) ?? $this->paginate($merge, $limit, $page);
            
            return $this->catsAndDogImageTransformer->transform($page, $limit, $result);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Returns a list of Cats and Dogs images.
     * @param  Request $request Request object.
     *  @return array
     */
    public function list(Request $request)
    {
        $data = $request->toArray();
        $page = isset($data['page']) ? $data['page'] : 1;
        $limit = isset($data['limit']) ? $data['limit'] : 25;

        try {
            $cats =  $this->catServices->getByBreeds();
            $dogs =  $this->dogServices->getByBreeds();
           
            $merge = array_merge($cats, $dogs);

            $result = $this->paginate($merge, $limit, $page);
            
            return  $result;
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Returns a list of Cats and Dogs images.
     * @param  Request $request Request object.
     * @param string $image_id
     *  @return array
     */
    public function getImageByID(Request $request, $image_id)
    {
        $data = $request->toArray();
        $page = isset($data['page']) ? $data['page'] : 1;
        $limit = isset($data['limit']) ? $data['limit'] : 25;
       
        try {
            $cats =  $this->catServices->getImageByImageID($image_id);
            $dogs =  $this->dogServices->getImageByImageID($image_id);
            if ($cats) {
                return $this->imageTransformer->transform($page, $limit, $cats);
            } else {
                return $this->imageTransformer->transform($page, $limit, $dogs);
           }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
