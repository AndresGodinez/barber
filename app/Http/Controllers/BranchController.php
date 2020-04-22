<?php

namespace App\Http\Controllers;

use App\Branch;
use App\Http\Requests\BranchRequest;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;

class BranchController extends Controller
{

    public function index(Request $request)
    {
        $name = $request->get('name');

        $branches = Branch::orderBy('id', 'desc')
            ->onlyBelongsToCustomer($request->user())
            ->name($name)
            ->paginate();

        return view('branches.index', compact('branches'));
    }


    public function create()
    {
        return view('branches.create');
    }


    public function store(BranchRequest $request)
    {
        $branch = new Branch();
        $branch->createNewBranch($request);
        return redirect(route('branches.index'));
    }


    public function show(Branch $branch)
    {
        try {
            $this->authorize('pass', $branch);
            return view('branches.show', compact('branch'));

        } catch (AuthorizationException $e) {
            return response($e->getMessage(), 403);
        }
    }


    public function edit(Branch $branch)
    {
        try {
            $this->authorize('pass', $branch);
            return view('branches.edit', compact('branch'));

        } catch (AuthorizationException $e) {
            return response('Unauthorized action.', 403);

        }


    }


    public function update(BranchRequest $request, Branch $branch)
    {
        try {
            $this->authorize('pass', $branch);
            $branch->updateBranch($request);
            return redirect(route('branches.index'));

        } catch (AuthorizationException $e) {
            return response($e->getMessage(), 403);
        }
    }

    public function destroy(Branch $branch)
    {
        try {
            $this->authorize('pass', $branch);
            $branch->update([
                'active' => 0
            ]);

            return redirect(route('branches.index'));

        } catch (AuthorizationException $e) {
            return response($e->getMessage(), 403);
        }
    }


}
