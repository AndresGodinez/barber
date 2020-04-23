<?php

namespace App\Http\Controllers;

use App\Staff;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $name = $request->get('name');

        $staff = Staff::orderByDesc('id')
            ->name($name)
            ->onlyBelongsToCustomer($request->user())
            ->paginate();

        return response(view('staff.index', compact('staff')));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        Staff::create([
            'name' => $request->get('name'),
            'username' => $request->get('username'),
            'email' => $request->get('email'),
            'customer_id' => $request->user()->customer->id,
            'commission_percent' => $request->get('commission_percent')
        ]);

        return response(redirect(route('staff.index')));
    }

    /**
     * Display the specified resource.
     *
     * @param Staff $staff
     * @return Response
     * @throws AuthorizationException
     */
    public function show(Staff $staff)
    {
        $this->authorize('pass', $staff);
        return \response(view('staff.show', compact('staff')));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Staff $staff
     * @return Response
     */
    public function edit(Staff $staff)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param Staff $staff
     * @return Response
     */
    public function update(Request $request, Staff $staff)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Staff $staff
     * @return Response
     */
    public function destroy(Staff $staff)
    {
        //
    }
}
