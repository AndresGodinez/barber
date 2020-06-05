<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Type;
use Carbon\Carbon;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return ResponseFactory|Response
     */
    public function index(Request $request)
    {
        $name = $request->get('name');

        $customers = Customer::orderByDesc('created_at')
            ->name($name)
            ->paginate();

        return response(view('customers/index', compact('customers')));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $types = Type::get();
        return response(view('customers/create', compact('types')));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function store(Request $request)
    {
        Customer::create([
            'name' => $request->get('name'),
            'last_name' => $request->get('last_name'),
            'telephone' => $request->get('telephone'),
            'email' => $request->get('email'),
            'expiration' => Carbon::now()->addMonth(),
            'type_id' => $request->get('type_id')
        ]);

        return redirect(route('customers.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param Customer $customer
     * @return ResponseFactory|Response
     */
    public function show(Customer $customer)
    {
        return response(view('customers/show', compact($customer)));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Customer $customer
     * @return Response
     */
    public function edit(Customer $customer)
    {
        $types = Type::get();
        return \response(view('customer/edit', compact('customer', 'types')));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Customer $customer
     * @return Response
     */
    public function update(Request $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Customer $customer
     * @return Response
     */
    public function destroy(Customer $customer, Request $request)
    {
        $customer->active = 0;
        $customer->$request->get('comment');
        $customer->save();
        return \response(redirect(route('customers.index')));
    }
}
