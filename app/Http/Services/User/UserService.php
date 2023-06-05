<?php

namespace App\Http\Services\User;

use App\Http\Resources\User\UserResource;
use App\Models\User\Country\Country;
use App\Models\User\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserService
{
    public function getWhoToFollow(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return UserResource::collection(User::where('id', '!=', Auth::id())->inRandomOrder()->limit(3)->get());
    }

    public function getUser(string $id, $collection = false): UserResource
    {
        return new UserResource(User::with(['information', 'information.country'])->findOrFail($id));
    }

    public function getUserByName(string $name, $collection = false): UserResource
    {
        return new UserResource(User::with(['information', 'information.userCountry', 'followers'])->where('name', $name)->firstOrFail());
    }

    public function getCountryByName(string $name)
    {
        $country = Country::where('name', $name)->firstOrFail();

        return $country->id;
    }

    public function storeAvatar(array|\Illuminate\Http\UploadedFile|null $avatar, UserResource $user): bool
    {
        $defaultAvatarPattern = '/^(http|https):\/\/[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(([0-9]{1,5})?\/.*)?$/i';

        if (! preg_match($defaultAvatarPattern, $user->avatar) && ! Storage::exists($user->avatar)) {
            Storage::delete('public/avatars/'.$user->avatar);
        }

        $extension = $avatar->getClientOriginalExtension();
        $filename = 'avatar-'.$user->id.'.'.$extension;

        $avatar->storeAs('public/avatars', $filename);

        return $user->update([
            'avatar' => $filename,
        ]);
    }

    public function getCountries(): \Illuminate\Database\Eloquent\Collection
    {
        return Country::all();
    }
}
