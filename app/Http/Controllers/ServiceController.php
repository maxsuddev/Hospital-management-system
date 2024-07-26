<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ServiceController extends Controller
{
    public function index() {
        $services = Service::orderBy('created_at','DESC')->get();

        return view('service.list',[
            'services' => $services,

        ]);
    }
    public function create() {
        return view('service.create')->with([
            'categories' => Category::all()
        ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:5',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
        ]);


        $service = new Service();
        $service->name = $request->name;
        $service->price  = $request->price;
        $service->category_id = $request->category_id;

        $service->save();


        return redirect()->route('service.index')->with('success', 'Category added successfully.');
    }
    public function edit($id) {
        $service = Service::findOrFail($id);

        return view('service.edit',[
            'service' => $service,
            'categories' => Category::all()]);
    }
    public function update( Request $request, Service $service) {

        $validate = $request->validate([
            'name' => 'required|min:5',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
        ]);

        $service->update($validate);


        return redirect()->route('service.index')->with('success','Service updated successfully.');
    }

    public function destroy($id)
    {
        $service = Service::findOrFail($id);


            $service->delete();

            return redirect()->route('service.index')->with('success', 'Service deleted successfully.');

    }

}
