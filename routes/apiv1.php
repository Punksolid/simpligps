<?php

use App\Http\Middleware\IdentifyTenantConnection;
use App\Http\Middleware\IsUserPermittedInAccountMiddleware;
use App\Http\Middleware\ProfilingTestMiddleware;
use App\Http\Middleware\RefreshPersonalAccessTokenMiddleware;
use App\Http\Middleware\SetWialonTokenMiddleware;
use Illuminate\Support\Facades\Route;

//ecommerce
Route::any('ecommerce/1234567890', 'PurchaseController@storeFromEcommerce');

Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout');
Route::post('password/send_email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
Route::post('password/change', 'Auth\ResetPasswordController@reset');
Route::post('continue_registration', 'Auth\RegisterController@continueRegistration');

//@todo proteger con autenticacion
Route::post('webhook/alert', 'WebhookNotificationController@simpleAlert');
// api/v1/$tenant_uuid/alert/trips/".$this->id
Route::post('{tennant_id}/alert/trips/{trip}', 'WebhookNotificationController@tripAlert');

Route::group(
    [
        'middleware' => [
//    "verified",
            'auth:api',
            RefreshPersonalAccessTokenMiddleware::class,
            ProfilingTestMiddleware::class,
        ],
    ],
    function () { //@todo Documentar/aclarar/encontrar por que funciona con auth:web y no con auth:api
        //Laravel Normal Notifications Access
        Route::get('me/notifications', 'MeController@getNotifications');
        Route::post('me/notifications/{id}/mark_as_read', 'MeController@markAsRead');
        Route::get('/me', 'MeController@meInfo');

        Route::get('/me/permissions', 'MeController@permissions');
        Route::get('/me/accounts', 'MeController@accounts');
        Route::get('/me/accounts/{uuid}', 'MeController@getIdOfAccount');
        Route::post('/me/set_account', 'MeController@enterAccountSession');
        Route::post('/me/change_password', 'MeController@changePassword');

        Route::group(
            [
                'middleware' => [
                    IdentifyTenantConnection::class,
                    'limit_expired_license_access',
                    IsUserPermittedInAccountMiddleware::class,
                    SetWialonTokenMiddleware::class,
                    'limit_simoultaneous_access',
                ],
            ],
            function () {
                //region Account Notifications
                Route::get('account/access_logs', 'AccountController@accessLogs');
                Route::get('account/notifications', 'AccountNotificationsController@getNotifications');
                Route::post('account/notifications/{id}/mark_as_read', 'AccountNotificationsController@markAsRead');
                Route::post('account/notifications/resolve', 'AccountNotificationsController@resolve');

                //endregion
                // Dashboard
                Route::get('dashboard', 'DashboardController@resume');
                //Devices
                Route::get('devices/search', 'DevicesController@search');
                Route::get('devices/{device}/logs', 'DeviceLogsController@index');
                Route::post('devices/{device}/logs', 'DeviceLogsController@store');
                Route::post('devices/{device}/link_unit', 'DevicesController@linkUnit');
                Route::resource('devices', 'DevicesController')->except(['create', 'edit']);

                //Tags
                Route::get('tags', 'TagsController@index');

                //Clients
                Route::get('clients/search', 'ClientController@search');
                Route::resource('clients', 'ClientController')->except(['create', 'edit']);
                //Contacts
                Route::get('contacts/filter_tags', 'ContactController@filterTags');
                Route::post('contacts/{contact}/tags', 'ContactController@attachtags');
                Route::resource('contacts', 'ContactController')->except(['create', 'edit']);

                //PERMISSIONS
                Route::put('permissions/user_sync/{user}', 'PermissionController@userSync');
                Route::resource('permissions', 'PermissionController', ['only' => ['index']]);
                Route::post('roles/{role}/user', 'RolesController@assignToUser');
                Route::resource('roles', 'RolesController', ['except' => ['edit', 'create']]);

                //region Trucks
                Route::get('trucks/search', 'TruckTractController@search')->name('trucks.search');
                Route::resource('trucks', 'TruckTractController')->except(['create', 'edit']);
                Route::resource('trailers', 'TrailerBoxController')->except(['create', 'edit', 'show']);
                //endregion

                //region Situations
                Route::resource('situations', 'SituationController')->except(['create', 'edit', 'show']);
                Route::resource('cancelation_reasons', 'CancelationReasonController')
                    ->except(['create', 'edit', 'show']);
                //endregion
                //region Trips
                Route::any('reports', 'TripsReportsController@index');
                //CONVOYS
                Route::post('trips/convoys', 'ConvoyController@store');
                Route::get('trips/convoys', 'ConvoyController@index');
                Route::get('trips/convoys/{convoy}', 'ConvoyController@show');
                //Checkpoints
                Route::patch('checkpoints/{timeline}', "TripTimelineController@patch");
                //TRIPS
                Route::patch('trips/{trip}', "TripsController@patch");

                Route::put('trips/{trip}', "TripsController@update");
                Route::get('trips/{trip}/logs', 'TripsEventsController@index');
                Route::post('trips/{trip}/logs', 'TripsEventsController@store');
                Route::post('trips/upload', 'TripsController@upload');
                Route::post('trips/{trip}/tags', 'TripsController@assignTag');
                Route::post('trips/filtered_with_tags', 'TripsController@filteredWithTags');
                Route::resource('trips/{trip}/traces', 'TraceController')->only(['index', 'store', 'show']);
                Route::post('trips/{trip}/give_exit', "TripActionsController@giveExit");
                Route::delete('trips/{trip}/automatic_updates', "TripActionsController@destroy");
                Route::delete('trips/{trip}/close_trip', "TripActionsController@closeTrip");
                Route::resource(
                    'trips',
                    'TripsController',
                    [
                        'except' => ['create', 'edit', 'update'],
                    ]
                );
                //endregion
                //OPERATORS
                Route::get('operators/search', 'OperatorsController@search');
                Route::resource(
                    'operators',
                    'OperatorsController',
                    [
                        'except' => ['edit', 'create'],
                    ]
                );

                //Carriers
                Route::get('carriers/search', 'CarriersController@search');
                Route::resource('carriers', 'CarriersController')->except(['edit', 'create']);

                //`Places` (origenes y destinos)
                Route::get('places/search', 'PlaceController@search');
                Route::resource('places', 'PlaceController')->except(['edit', 'create']);

                Route::group(
                    ['middleware' => SetWialonTokenMiddleware::class],
                    function () {
                        //Units
                        Route::get('units', 'UnitsController@listUnits');
                        Route::get('units/with_localization', 'UnitsController@listUnitsLocalization');

                        //WIALON SECTION
                        Route::get('wialon/resources', 'WialonController@getResources');
                        Route::get('wialon/units', 'WialonController@getUnits');
                        Route::get('wialon/geofences', 'WialonGeofencesController@index');
                        Route::get('wialon/notifications', 'WialonNotificationsController@index');
                        Route::post('wialon/notifications', 'WialonNotificationsController@store');
                        Route::delete('wialon/notifications/{id}', 'WialonNotificationsController@destroy');

                        //Region NOTIFICATIONS
                        Route::delete(
                            'activated_notification_triggers/{id}',
                            'ActivatedNotificationTriggerController@destroy'
                        );
                        Route::post('activated_notification_triggers', 'ActivatedNotificationTriggerController@store');
                        Route::resource(
                            'notification_triggers',
                            'NotificationTriggersController',
                            [
                                'only' => ['index', 'store', 'update', 'destroy'],
                            ]
                        );
                        //endregion
                    }
                );

                Route::resource('users', 'UsersController', ['except' => ['edit', 'create']]);

                // GEOFENCES
                Route::post('wialon/geofences', 'WialonGeofencesController@store');

                // Settings
                Route::post('settings', 'SettingsController@general');
                Route::get('settings', 'SettingsController@getSettings');

                Route::group(
                    [
                        'prefix' => 'external/',
                    ],
                    function () {
                        //Units
                        Route::post('devices', 'DevicesController@storeExternal');
                        Route::get('devices', 'DevicesController@listDevices');
                    }
                );
            }
        );
    }
);
