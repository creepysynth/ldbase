<?php

namespace App\Http\Controllers;

use App\Repositories\CustomerRepository;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * @var CustomerRepository
     */
    private $customerRepository;

    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function index()
    {
        // 1. 101 queries
//        $customers = Customer::all();
        // 2. 2 queries
//        $customers = Customer::with('user')->get();

        $customers = $this->customerRepository->all();

        \Debugbar::disable();

        return json_encode($customers);

//        return view('customer.index', compact('customers'));
    }

    public function show($id)
    {
        $customer = $this->customerRepository->findById($id);

        \Debugbar::disable();

        return json_encode($customer);
    }
}
