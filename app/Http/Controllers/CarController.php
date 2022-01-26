<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCarRequest;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CarController extends Controller
{

    /**
     * @OA\Get(
     *      path="/car",
     *      operationId="getCarsList",
     *      tags={"Cars"},
     *      summary="Get list of cars",
     *      description="Returns paginated list of cars",
     *      security={
     *         {"apiAuth": {}}
     *      },
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Car")
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *     )
     */
    public function index()
    {
        $cars = Car::paginate();
        return $this->sendResponse([
            'cars' => $cars
        ]);
    }

    /**
     * @OA\Post(
     *      path="/car",
     *      operationId="storeCar",
     *      tags={"Cars"},
     *      summary="Store new car",
     *      description="Returns car data",
     *      security={
     *         {"apiAuth": {}}
     *      },
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StoreCarRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Car")
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     */
    public function store(StoreCarRequest $request)
    {
        $request->validated();

        Car::create([
            'name' => $request->input('name'),
            'brand_id' => $request->input('brand_id')
        ]);

        return $this->sendResponse('Car was created');
    }

    /**
     * @OA\Put(
     *      path="/car/{id}",
     *      operationId="updateCar",
     *      tags={"Cars"},
     *      summary="Update existing car",
     *      description="Returns updated car data",
     *      security={
     *         {"apiAuth": {}}
     *      },
     *      @OA\Parameter(
     *          name="id",
     *          description="Car id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StoreCarRequest")
     *      ),
     *      @OA\Response(
     *          response=202,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Car")
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
     */
    public function update(StoreCarRequest $request, $id)
    {
        $request->validated();

        $car = Car::findOrFail($id);
        $car->name = $request->input('name');
        $car->save();

        return $this->sendResponse($car);
    }

    /**
     * @OA\Delete(
     *      path="/car/{id}",
     *      operationId="deleteCar",
     *      tags={"Cars"},
     *      summary="Delete existing car",
     *      description="Deletes a record and returns message",
     *      security={
     *         {"apiAuth": {}}
     *      },
     *      @OA\Parameter(
     *          name="id",
     *          description="Car id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=204,
     *          description="Successful operation",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
     */
    public function destroy($id)
    {
        return Car::destroy($id) ?
            $this->sendResponse('Car was destroyed') :
            $this->sendError('Car Not Found.', Response::HTTP_NOT_FOUND);
    }
}
