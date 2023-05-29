<?php

namespace App\Models\User\Country;

use App\Models\User\UserInformation;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Country extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    protected $visible = [
        'name',
    ];

    public function userInformation(): BelongsToMany
    {
        return $this->belongsToMany(UserInformation::class);
    }
}
