<?php

namespace App\Http\Controllers;

use App\Events\NewServiceCreated;
use App\Models\Service;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
//use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ServiceController extends Controller
{
    /**
     * Class constructor
     */
    public function __construct()
    {
        // Laravel 5.8 Tutorial From Scratch - e22 - Artisan Authentication Restricting Access with Middleware
        // Option 1. Restrict access for unauthenticated users to all methods except index method.
//        $this->middleware('auth')->except('index');

        // Option 2. Restrict access for unauthenticated users to listed methods.
        $this->middleware('auth')->only([
            'create',
            'store',
            'destroy'
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        if (request()->has('active'))
        {
            // Method "query" is used to get URI parameter value
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

//    /**
//     * Store a newly created resource in storage.
//     *
//     * @return Application|RedirectResponse|Redirector
//     */
//    public function store()
//    {
//        $data = $this->validatedData();
//
//        // Method "get" is used to get post parameter value
//        if (request()->has('active') && (request()->get('active') === 'on') )
//        {
//            $data['active'] = 1;
//        }
//        else
//        {
//            $data['active'] = 0;
//        }
//
//        $service = Service::create($data);
//
////        return redirect()->back();
//        return redirect(route('services.show', ['service' => $service]));
//    }

     /**
     * Laravel 5.8 Tutorial From Scratch - e28 - Events & Listeners
     * Laravel 5.8 Tutorial From Scratch - e29 - Queues: Database Driver
     */
    public function store()
    {
        $data = $this->validatedData();

        // Method "get" is used to get post parameter value
        if (request()->has('active') && (request()->get('active') === 'on') )
        {
            $data['active'] = 1;
        }
        else
        {
            $data['active'] = 0;
        }

        $service = Service::create($data);

        dump('First message');

        // We have to provide user's object or we get error:
        // ErrorException: Trying to get property 'email' of non-object.
        // See App\Listeners\NewServiceSendEmail
        event(new NewServiceCreated($service, Auth::user()));
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
