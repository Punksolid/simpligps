<?php

namespace App\Http\Controllers;

use App\Account;
use App\Http\Resources\AccountResource;
use App\Http\Resources\InternalNotificationResource;
use App\Http\Resources\UsersResource;
use App\User;
use http\Client\Response;
use Illuminate\Http\Request;

/**
 * Class MeController.
 *
 * @resource Me
 */
class MeController extends Controller
{
    /**
     * Logged user information.
     *
     * @return UsersResource
     */
    public function meInfo()
    {
        $user = auth()->user();

        return UsersResource::make($user);
    }

    /**
     * Devuelve las notificaciones internas del sistema del usuario, las estandar de Laravel.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getNotifications()
    {
        $account = \request()->header('X-Tenant-Id', null);

        $notifications = auth()
            ->user()
            ->unreadNotifications()
            ->where('data->X-Tenant-Id', $account)
            ->paginate(100);

        return InternalNotificationResource::collection($notifications);
    }

    public function markAsRead($uuid)
    {
        try {
            auth()->user()->notifications()->where('id', $uuid)->first()->markAsRead();

            return \response()->json(['data' => 'ok']);
        } catch (\Exception $e) {
            \Log::error('Failed mark as read', $e->getMessage());

            return response()->json([
                'message' => 'An error occurred',
            ]);
        }
    }

    /**
     * Cambia la contraseña del usuario loggeado, solo es necesario password y pasword_confirmation.
     */
    public function changePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed',
        ]);
        $user = auth()->user();
        $user->password = bcrypt($request->password);

        return response()->json($user->save());
    }

    /*
     * @respons
     */
    public function permissions()
    {
        return response()->json(
            [
                'data' => auth()->user()->getAllPermissions(),
            ]
        );
    }

    /**
     * Devuelve todas las cuentas de un usuario, necesario para el login y la especificacion del tenant.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function accounts()
    {
        return AccountResource::collection(auth()->user()->accounts);
    }

    /**
     * Returns the details of an account.
     *
     * @param $uuid
     *
     * @return AccountResource
     */
    public function getIdOfAccount($uuid)
    {
        $account = Account::where('uuid', $uuid)->firstOrFail();

        return AccountResource::make($account);
    }

    public function enterAccountSession(Request $request)
    {
        $account = Account::where('uuid', $request->uuid)->firstOrFail();
        activity('access_log')
            ->causedBy(auth()->user())
            ->performedOn($account)
            ->log('User Access');
        // ->withProperties(['key' => 'value'])

        return AccountResource::make($account);
    }
}
