<?php

namespace App\Models\User;

use App\Models\User\Country\Country;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserInformation extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $keyType = 'uuid';

    public $incrementing = false;

    protected $fillable = [
        'user_id',
        'description',
        'dob',
        'country_id',
        'website',
    ];

    protected $table = 'user_information';

    public function userCountry()
    {
        return $this->hasOne(Country::class, 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }
}
