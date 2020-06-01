<?php

namespace App\Http\Controllers;

use App\Account;
use App\Http\Requests\UserRequest;
use App\Http\Resources\AccountResource;
use App\Http\Resources\InternalNotificationResource;
use App\Http\Resources\UsersResource;
use App\User;
use http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        } catch (\Exception $exception) {
            \Log::error('Failed mark as read', $exception->getMessage());

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
     * @OA\Get(
     *     path="/api/v1/me/accounts",
     *     security={
     *      {
     *       "passport": {}
     *      }
     *     },
     *       @OA\Response(
     *         response=200,
     *         description="Devuelve todas las cuentas de un usuario, necesario para el login y la especificacion del tenant.",
     *         @OA\MediaType(
     *             mediaType="application/json"
     *         ),
     *         @OA\Schema(
     *             type="json",
     *             @OA\Items(type="string"),
     *         )
     *     )
     * )
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

    /**
     * @todo Considerar mover para otro controlador para mantener consistencia sobre encapsulacion
     * al seleccionar la cuenta en lugar de ponerlo en una tabla general debe de almacenarse en la 
     * base de datos tenant, por lo que la seleccion del environment podria estar en otro controlador
     * mas acoplado al tenant y no al mecontroller que debe de ser preferentemente para asuntos del usuario
     */
    public function enterAccountSession(Request $request)
    {
        

        // if ($request->tenant_account) {
        $account = Account::where('uuid', $request->uuid)->firstOrFail();
        $environment = app(\Hyn\Tenancy\Environment::class);
        $environment->tenant($account);
        activity('access_log')
            ->causedBy(auth()->user())
            ->performedOn($account)
            ->log('User Access');
        // ->withProperties(['key' => 'value'])
        

        return AccountResource::make($account);
    }

    /**
     * Update the info of the authenticated user
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function updatePersonalInfo(UserRequest $request)
    {
        $user = Auth::user();
        $user->update($request->all());
        $user->save();

        return UsersResource::make($user->fresh());
    }
}
