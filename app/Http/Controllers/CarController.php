<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CarController extends Controller
{

    public function index()
    {
        $cars = Car::paginate();
        return $this->sendResponse([
            'cars' => $cars
        ]);
    }

    public function store(Request $request)
    {
        $this->validateCar($request);

        Car::create([
            'name' => $request->input('name'),
            'brand_id' => $request->input('brand_id')
        ]);

        return $this->sendResponse('Car was created');
    }

    public function update(Request $request, $id)
    {
        $this->validateCar($request);

        $car = Car::find($id);
        if (!$car) {
            return $this->sendError('Car Not Found.', Response::HTTP_NOT_FOUND);
        }
        $car->name = $request->input('name');
        $car->save();

        return $this->sendResponse('Car was updated');
    }

    public function destroy($id)
    {
        return Car::destroy($id) ?
            $this->sendResponse('Car was destroyed') :
            $this->sendError('Car Not Found.', Response::HTTP_NOT_FOUND);
    }

    private function validateCar(Request $request)
    {
        return $request->validate([
            'name' => 'required|unique:brands,name',
            'brand_id' => 'required|exists:brands,id'
        ]);
    }
}
