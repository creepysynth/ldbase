<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
//use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
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
     * @return Application|RedirectResponse|Redirector
     */
    public function store()
    {
        $data = $this->validatedData();

        // Lesson 18. We don't need this if we set default "active" attribute (see Service model)
//        $data['active'] = request()->has('active');

        $service = Service::create($data);

//        return redirect()->back();
        return redirect('/services/' . $service->id);
    }

    /**
     * Display the specified resource.
     *
     * @param Service $service
     * @return Application|Factory|View
     */
    public function show(Service $service)
    {
        return view('services.show', compact('service'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Service $service
     * @return Application|Factory|View
     */
    public function edit(Service $service)
    {
        return view('services.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Service $service
     * @return Application|RedirectResponse|Redirector
     */
    public function update(Service $service)
    {
        $data = $this->validatedData();

        $data['active'] = request()->has('active');

        $service->update($data);

        // Tutorial From Scratch - e20 - Flashing Data to Session & Conditional Alerts in View.
        // Option 1. Using "with".
//        return redirect('/services')->with('message', 'Service has been updated.');

        // Option 2. Using session helper.
        session()->flash('message', 'Service has been updated.');

        return redirect('/services');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Service $service
     * @return Application|RedirectResponse|Redirector
     * @throws \Exception
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
