<?php

namespace App\Repositories;

use App\Customer;

class CustomerRepository
{
    /**
     * Get all active customers
     *
     * @return array
     */
    public function all()
    {
        // Option 1. Use repository format().
//        return $customers = Customer::orderBy('name')
//            ->where('active', true)
//            ->with('user')
//            ->get()
//            ->map(function ($customer) {
//                return $this->format($customer);
//            });

        // Option 2. Place format() to model and use it.
        // Uses map() higher order messages instead of:
        //     ->map(function ($customer) {
        //         return $customer->format();
        //     });

        return $customers = Customer::orderBy('name')
            ->where('active', true)
            ->with('user')
            ->get()
            ->map->format();
    }

    /**
     * Get customer by id
     *
     * @param int $id
     * @return array
     */
    public function findById($id)
    {
        // Option 1. Use repository format().
//        $customer = Customer::where('id', $id)
//            ->where('active', true)
//            ->with('user')
//            ->firstOrFail();
//
//        return $this->format($customer);

        // Option 2. Place format() to model and use it.
        return Customer::where('id', $id)
            ->where('active', true)
            ->with('user')
            ->firstOrFail()
            ->format();
    }

    /**
     * Format customer's object to an array
     *
     * @param Customer $customer
     * @return array
     */
    public function format($customer)
    {
        return [
            'customer_id'  => $customer->id,
            'name'         => $customer->name,
            'created_by'   => $customer->user->email,
            'last_updated' => $customer->updated_at->diffForHumans()
        ];
    }
}