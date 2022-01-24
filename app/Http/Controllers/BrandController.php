<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BrandController extends Controller
{

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

    public function store(Request $request)
    {
        $this->validateBrand($request);

        Brand::create([
            'name' => $request->input('name')
        ]);

        return $this->sendResponse('Brand was created');
    }

    public function update(Request $request, $id)
    {
        $this->validateBrand($request);

        $brand = Brand::find($id);
        if (!$brand) {
            return $this->sendError('Brand Not Found.', Response::HTTP_NOT_FOUND);
        }
        $brand->name = $request->input('name');
        $brand->save();

        return $this->sendResponse('Brand was updated');
    }

    public function destroy($id)
    {
        return Brand::destroy($id) ?
            $this->sendResponse('Brand was destroyed') :
            $this->sendError('Brand Not Found.', Response::HTTP_NOT_FOUND);
    }

    private function validateBrand(Request $request)
    {
        return $request->validate([
            'name' => 'required|unique:brands,name'
        ]);
    }
}
