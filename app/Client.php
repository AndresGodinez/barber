<?php

namespace App;

use App\Http\Requests\ClientStoreRequest;
use App\Http\Requests\ClientUpdateRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    public function scopeName(Builder $query, string $name = null): Builder
    {
        return !is_null($name)
            ? $query->where('name', 'like', "%$name%")
            : $query;
    }

    public function createAClient(ClientStoreRequest $request): Client
    {
        $this->name = $request->get('name');
        $this->email = $request->get('email');
        $this->telephone = $request->get('telephone');
        $this->save();
        return $this;
    }

    public function updateInformation(ClientUpdateRequest $request)
    {
        $this->name = $request->get('name');
        $this->email = $request->get('email');
        $this->telephone = $request->get('telephone');
        $this->save();
        return $this;
    }
}
