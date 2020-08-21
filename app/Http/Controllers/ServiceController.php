<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->has('active'))
        {
            $active = request()->query('active');
            $services = Service::where('active', $active)->orderBy('name')->get();
        }
        else
        {
            $services = Service::orderBy('name')->get();
        }

        return view('services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('services.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        $data = $this->validatedData();

        $data['active'] = request()->has('active');

        $service = Service::create($data);

//        return redirect()->back();
        return redirect('/services/' . $service->id);
    }

    /**
     * Display the specified resource.
     *
     * @param Service $service
     */
    public function show(Service $service)
    {
        return view('services.show', compact('service'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit(Service $service)
    {
        return view('services.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function update(Service $service)
    {
        $data = $this->validatedData();

        $data['active'] = request()->has('active');

        $service->update($data);

        return redirect('/services');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function destroy(Service $service)
    {
        $service->delete();

        return redirect('/services');
    }

    /**
     * Validate form data
     */
    private function validatedData()
    {
        return request()->validate([
            'name' => 'required|min:2|max:255',
            // 'active' => 'accepted'  // checks if checkbox is checked
        ]);
    }
}
