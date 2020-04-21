<?php

namespace App;

use App\Http\Requests\BranchRequest;
use App\Traits\MultiTenantTable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Branch
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $address
 * @property string $telephone
 * @property string $rfc
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Branch name($name = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Branch newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Branch newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Branch query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Branch whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Branch whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Branch whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Branch whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Branch whereRfc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Branch whereTelephone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Branch whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Branch whereUserId($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Branch ownerUser($userId = null)
 */
class Branch extends Model
{
    use MultiTenantTable;

    protected $guarded = [];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeOwnerUser(Builder $query, int $userId = null): Builder
    {
        return !is_null($userId)
            ? $query->where('user_id', $userId)
            : $query;
    }

    public function scopeName(Builder $query, string $name = null): Builder
    {
        return !is_null($name)
            ? $query->where('name', 'like', "%$name%")
            : $query;
    }

    public function createNewBranch(BranchRequest $request): Branch
    {
        $branch = $this->create([
            'name' => $request->get('name'),
            'address' => $request->get('address'),
            'user_id' => $request->user()->id,
            'rfc' => $request->get('rfc'),
            'telephone' => $request->get('telephone')
        ]);

        return $branch;
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
