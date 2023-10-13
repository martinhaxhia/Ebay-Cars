<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCarRequest;
use App\Http\Requests\UpdateCarRequest;

use App\Services\MediaService;
use App\Services\CarService;

use App\Models\Car;
use Illuminate\Http\Request;


class CarController extends Controller
{

    private $carService;
    private $mediaService;

    /**
     * @param CarService $carService
     */
    public function __construct(CarService $carService,MediaService $mediaService)
    {
        $this->carService = $carService;
        $this->mediaService = $mediaService;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $cars = Car::latest()->get();
        return view('cars.index', compact('cars'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return  view ('admin.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function search(Request $request)
    {
        $brand = $request->input('brand');
        $engineSize = $request->input('engine_size');
        $price = $request->input('price');
        $query = Car::query();

        if ($brand) {
            $query->where('brand', 'like', "%$brand%");
        }

        if ($engineSize) {
            $query->where('engine_size', $engineSize);
        }

        if ($price) {
            $query->where('price', $price);
        }

        $results = $query->get();

        return view('cars.search', compact('results'));
    }

    /**
     * @param StoreCarRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function store(StoreCarRequest $request)
    {
        $file = $request->file('image');

        $validated = $request->validated();

        $data = $request->all();

        $data['image'] = $file;

        $car = $this->carService->create($data);

        return back();

    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show()
    {
        $cars = Car::get();
        $trashed = Car::onlyTrashed()->get();
        return view('admin.cars', compact('cars',"trashed"));
    }

    /**
     * @param Car $car
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit( Car $car)
    {
        return view('admin.edit',compact('car'));
    }

    /**
     * @param UpdateCarRequest $request
     * @param Car $car
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateCarRequest $request, Car $car)
    {
        if ($request->hasFile('image')) {

            $file = $request->file('image');

            $validated = $request->validated();

            $data = $request->all();

            $data['image'] = $this->mediaService->imageUpdate($file);

            try {

                $newImage = $this->mediaService->delete($car);

                $newCar = $this->carService->updateCar($car, $data);

                return back();


            } catch (\Throwable $th) {

            }
        } else {

            $data = $request->all();

            $newCar = $this->carService->updateCar($car, $data);

            return back();

        }

    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function delete($id)
    {
        $car = Car::find($id);

        return view('cars.delete', compact('car'));
    }

    /**
     * @param Car $car
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy( Car $car)
    {
        $car->delete();

        return back();

    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore($id)
    {
        Car::withTrashed()->find($id)->restore();

        return back();
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restoreAll()
    {
        Car::onlyTrashed()->restore();

        return back();
    }

}
