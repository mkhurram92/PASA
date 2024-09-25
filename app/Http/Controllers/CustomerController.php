<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateCustomerRequest;
use App\Http\Requests\StoreCustomerRequest;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        return view('page.customer.index', compact('customers'));
    }

    public function create()
    {
        $html = view("models.customer-create")->render();
        return response()->json(["status" => true, "html" => $html]);
    }

    public function store(StoreCustomerRequest $request)
    {
        $customer = Customer::create($request->validated());
        return response()->json(["status" => true, "message" => "Customer created"]);
    }

    public function show(Customer $customer)
    {
        $html = view("models.customer-view", compact('customer'))->render();
        return response()->json(["status" => true, "html" => $html]);
    }

    public function edit(Customer $customer)
    {
        $html = view("models.customer-update", compact('customer'))->render();
        return response()->json(["status" => true, "html" => $html]);
    }

    public function update(UpdateCustomerRequest $request, $customer)
    {
        $customer = Customer::find($customer)->update($request->validated());
        return response()->json(["status" => true, "message" => "Customer Updated"]);
    }

}
