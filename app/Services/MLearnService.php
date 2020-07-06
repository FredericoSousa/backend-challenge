<?php

namespace App\Services;

use App\User;
use Illuminate\Support\Facades\Http;

class MLearnService
{
    public static function headers()
    {
        return [
            'Authorization' => 'Bearer ' . env('MLEARN_AUTH_TOKEN'),
            'service-id' => env('MLEARN_SERVICE_ID'),
            'app-users-group-id' => env('MLEARN_GROUP_ID')
        ];
    }

    public static function baseUrl()
    {
        return env('MLEARN_API_URL') . '/integrator/' . env('MLEARN_SERVICE_ID');
    }

    public static function createUser(User $user)
    {
        $response = Http::withHeaders(static::headers())
            ->post(static::baseUrl() . '/users', [
                'msisdn' => '+55' . $user->phone,
                'name' => $user->name,
                'access_level' => $user->level == 'F' ? 'free' : 'premium',
                'external_id' => $user->id
            ]);
        if ($response->status() == 200) {
            $user->external_id = $response->json()['data']['id'];
            $user->save();
        }
        return $user;
    }

    public static function changeUserLevel(User $user, string $action)
    {
        $response = Http::withHeaders(static::headers())
            ->put(static::baseUrl() . '/users/' . $user->external_id . '/' . $action);
        if ($response->status() == 200) {
            $user = $user->changeLevel($action);
        }
        return $user;
    }
}
