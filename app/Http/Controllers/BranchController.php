<?php

namespace App\Http\Controllers;

use App\Branch;
use App\Http\Requests\BranchRequest;
use Illuminate\Http\Request;

class BranchController extends Controller
{

    public function index(Request $request)
    {
        $name = $request->get('name');

        $branches = Branch::orderBy('id', 'desc')->name($name)->paginate();

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
        return view('branches.show', compact('branch'));
    }


    public function edit(Branch $branch)
    {
        return view('branches.edit', compact('branch'));
    }


    public function update(BranchRequest $request, Branch $branch)
    {
        $branch->updateBranch($request);
        return redirect(route('branches.index'));
    }


}
