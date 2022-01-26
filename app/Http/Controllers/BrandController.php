<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBrandRequest;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BrandController extends Controller
{

    /**
     * @OA\Get(
     *      path="/brand",
     *      operationId="getBrandsList",
     *      tags={"Brands"},
     *      summary="Get list of brands",
     *      description="Returns paginated list of brands",
     *      security={
     *         {"apiAuth": {}}
     *     },
     *     @OA\Parameter(
     *          name="search",
     *          description="Search Brand by brand ora car name",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Brand")
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
    public function index(Request $request)
    {
        $brands = (new Brand)->newQuery();

        if ($request->has('search')) {
            $keyword = $request->input('search');
            $brands = $brands->where('name', 'LIKE', '%' . $keyword . '%');
            $brands = $brands->orWhereHas('cars',
                function ($query) use ($keyword) {
                    $query->where('name', 'LIKE', '%' . $keyword . '%');
                }
            );
        }

        return $this->sendResponse([
            'brands' => $brands->paginate()
        ]);
    }

    /**
     * @OA\Post(
     *      path="/brand",
     *      operationId="storeBrand",
     *      tags={"Brands"},
     *      summary="Store new brand",
     *      description="Returns brand data",
     *      security={
     *         {"apiAuth": {}}
     *      },
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StoreBrandRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Brand")
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
    public function store(StoreBrandRequest $request)
    {
        $request->validated();

        $brand = Brand::create([
            'name' => $request->input('name')
        ]);

        return $this->sendResponse($brand);
    }

    /**
     * @OA\Put(
     *      path="/brand/{id}",
     *      operationId="updateBrand",
     *      tags={"Brands"},
     *      summary="Update existing brand",
     *      description="Returns updated car data",
     *      security={
     *         {"apiAuth": {}}
     *      },
     *      @OA\Parameter(
     *          name="id",
     *          description="Brand id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StoreBrandRequest")
     *      ),
     *      @OA\Response(
     *          response=202,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Brand")
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
    public function update(StoreBrandRequest $request, $id)
    {
        $request->validated();

        $brand = Brand::findOrFail($id);
        $brand->name = $request->input('name');
        $brand->save();

        return $this->sendResponse($brand);
    }

    /**
     * @OA\Delete(
     *      path="/brand/{id}",
     *      operationId="deleteBrand",
     *      tags={"Brands"},
     *      summary="Delete existing brand",
     *      description="Deletes a record and returns message",
     *      security={
     *         {"apiAuth": {}}
     *      },
     *      @OA\Parameter(
     *          name="id",
     *          description="Brand id",
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
        return Brand::destroy($id) ?
            $this->sendResponse('Brand was destroyed') :
            $this->sendError('Brand Not Found.', Response::HTTP_NOT_FOUND);
    }
}
