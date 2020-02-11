<?php

namespace App;

use App\Http\Requests\BranchRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    public function scopeName(Builder $query, string $name = null): Builder
    {
        return !is_null($name)
            ? $query->where('name', 'like', "%$name%")
            : $query;
    }

    public function createNewBranch(BranchRequest $request): Branch
    {
        $this->name = $request->get('name');
        $this->address = $request->get('address');
        $this->rfc = $request->get('rfc');
        $this->telephone = $request->get('telephone');
        $this->save();
        return $this;
    }

    public function updateBranch(BranchRequest $request): Branch
    {
        $this->name = $request->get('name');
        $this->address = $request->get('address');
        $this->rfc = $request->get('rfc');
        $this->telephone = $request->get('telephone');
        $this->save();
        return $this;
    }
}
