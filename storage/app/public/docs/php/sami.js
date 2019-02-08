
window.projectVersion = 'master';

(function(root) {

    var bhIndex = null;
    var rootPath = '';
    var treeHtml = '        <ul>                <li data-name="namespace:App" class="opened">                    <div style="padding-left:0px" class="hd">                        <span class="glyphicon glyphicon-play"></span><a href="App.html">App</a>                    </div>                    <div class="bd">                                <ul>                <li data-name="namespace:App_Console" class="opened">                    <div style="padding-left:18px" class="hd">                        <span class="glyphicon glyphicon-play"></span><a href="App/Console.html">Console</a>                    </div>                    <div class="bd">                                <ul>                <li data-name="class:App_Console_Kernel" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="App/Console/Kernel.html">Kernel</a>                    </div>                </li>                </ul></div>                </li>                            <li data-name="namespace:App_Exceptions" class="opened">                    <div style="padding-left:18px" class="hd">                        <span class="glyphicon glyphicon-play"></span><a href="App/Exceptions.html">Exceptions</a>                    </div>                    <div class="bd">                                <ul>                <li data-name="class:App_Exceptions_Handler" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="App/Exceptions/Handler.html">Handler</a>                    </div>                </li>                </ul></div>                </li>                            <li data-name="namespace:App_Http" class="opened">                    <div style="padding-left:18px" class="hd">                        <span class="glyphicon glyphicon-play"></span><a href="App/Http.html">Http</a>                    </div>                    <div class="bd">                                <ul>                <li data-name="namespace:App_Http_Controllers" >                    <div style="padding-left:36px" class="hd">                        <span class="glyphicon glyphicon-play"></span><a href="App/Http/Controllers.html">Controllers</a>                    </div>                    <div class="bd">                                <ul>                <li data-name="namespace:App_Http_Controllers_Auth" >                    <div style="padding-left:54px" class="hd">                        <span class="glyphicon glyphicon-play"></span><a href="App/Http/Controllers/Auth.html">Auth</a>                    </div>                    <div class="bd">                                <ul>                <li data-name="class:App_Http_Controllers_Auth_ForgotPasswordController" >                    <div style="padding-left:80px" class="hd leaf">                        <a href="App/Http/Controllers/Auth/ForgotPasswordController.html">ForgotPasswordController</a>                    </div>                </li>                            <li data-name="class:App_Http_Controllers_Auth_LoginController" >                    <div style="padding-left:80px" class="hd leaf">                        <a href="App/Http/Controllers/Auth/LoginController.html">LoginController</a>                    </div>                </li>                            <li data-name="class:App_Http_Controllers_Auth_RegisterController" >                    <div style="padding-left:80px" class="hd leaf">                        <a href="App/Http/Controllers/Auth/RegisterController.html">RegisterController</a>                    </div>                </li>                            <li data-name="class:App_Http_Controllers_Auth_ResetPasswordController" >                    <div style="padding-left:80px" class="hd leaf">                        <a href="App/Http/Controllers/Auth/ResetPasswordController.html">ResetPasswordController</a>                    </div>                </li>                </ul></div>                </li>                            <li data-name="class:App_Http_Controllers_Controller" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="App/Http/Controllers/Controller.html">Controller</a>                    </div>                </li>                            <li data-name="class:App_Http_Controllers_HomeController" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="App/Http/Controllers/HomeController.html">HomeController</a>                    </div>                </li>                            <li data-name="class:App_Http_Controllers_PermissionController" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="App/Http/Controllers/PermissionController.html">PermissionController</a>                    </div>                </li>                            <li data-name="class:App_Http_Controllers_PlaceController" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="App/Http/Controllers/PlaceController.html">PlaceController</a>                    </div>                </li>                            <li data-name="class:App_Http_Controllers_RolesController" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="App/Http/Controllers/RolesController.html">RolesController</a>                    </div>                </li>                            <li data-name="class:App_Http_Controllers_TripsController" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="App/Http/Controllers/TripsController.html">TripsController</a>                    </div>                </li>                            <li data-name="class:App_Http_Controllers_UsersController" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="App/Http/Controllers/UsersController.html">UsersController</a>                    </div>                </li>                </ul></div>                </li>                            <li data-name="namespace:App_Http_Middleware" >                    <div style="padding-left:36px" class="hd">                        <span class="glyphicon glyphicon-play"></span><a href="App/Http/Middleware.html">Middleware</a>                    </div>                    <div class="bd">                                <ul>                <li data-name="class:App_Http_Middleware_EncryptCookies" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="App/Http/Middleware/EncryptCookies.html">EncryptCookies</a>                    </div>                </li>                            <li data-name="class:App_Http_Middleware_RedirectIfAuthenticated" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="App/Http/Middleware/RedirectIfAuthenticated.html">RedirectIfAuthenticated</a>                    </div>                </li>                            <li data-name="class:App_Http_Middleware_TrimStrings" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="App/Http/Middleware/TrimStrings.html">TrimStrings</a>                    </div>                </li>                            <li data-name="class:App_Http_Middleware_TrustProxies" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="App/Http/Middleware/TrustProxies.html">TrustProxies</a>                    </div>                </li>                            <li data-name="class:App_Http_Middleware_VerifyCsrfToken" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="App/Http/Middleware/VerifyCsrfToken.html">VerifyCsrfToken</a>                    </div>                </li>                </ul></div>                </li>                            <li data-name="namespace:App_Http_Requests" >                    <div style="padding-left:36px" class="hd">                        <span class="glyphicon glyphicon-play"></span><a href="App/Http/Requests.html">Requests</a>                    </div>                    <div class="bd">                                <ul>                <li data-name="class:App_Http_Requests_TripRequest" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="App/Http/Requests/TripRequest.html">TripRequest</a>                    </div>                </li>                </ul></div>                </li>                            <li data-name="namespace:App_Http_Resources" >                    <div style="padding-left:36px" class="hd">                        <span class="glyphicon glyphicon-play"></span><a href="App/Http/Resources.html">Resources</a>                    </div>                    <div class="bd">                                <ul>                <li data-name="class:App_Http_Resources_PermissionResource" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="App/Http/Resources/PermissionResource.html">PermissionResource</a>                    </div>                </li>                            <li data-name="class:App_Http_Resources_UsersResource" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="App/Http/Resources/UsersResource.html">UsersResource</a>                    </div>                </li>                </ul></div>                </li>                            <li data-name="class:App_Http_Kernel" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="App/Http/Kernel.html">Kernel</a>                    </div>                </li>                </ul></div>                </li>                            <li data-name="namespace:App_Providers" class="opened">                    <div style="padding-left:18px" class="hd">                        <span class="glyphicon glyphicon-play"></span><a href="App/Providers.html">Providers</a>                    </div>                    <div class="bd">                                <ul>                <li data-name="class:App_Providers_AppServiceProvider" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="App/Providers/AppServiceProvider.html">AppServiceProvider</a>                    </div>                </li>                            <li data-name="class:App_Providers_AuthServiceProvider" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="App/Providers/AuthServiceProvider.html">AuthServiceProvider</a>                    </div>                </li>                            <li data-name="class:App_Providers_BroadcastServiceProvider" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="App/Providers/BroadcastServiceProvider.html">BroadcastServiceProvider</a>                    </div>                </li>                            <li data-name="class:App_Providers_EventServiceProvider" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="App/Providers/EventServiceProvider.html">EventServiceProvider</a>                    </div>                </li>                            <li data-name="class:App_Providers_RouteServiceProvider" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="App/Providers/RouteServiceProvider.html">RouteServiceProvider</a>                    </div>                </li>                </ul></div>                </li>                            <li data-name="class:App_Permission" class="opened">                    <div style="padding-left:26px" class="hd leaf">                        <a href="App/Permission.html">Permission</a>                    </div>                </li>                            <li data-name="class:App_Place" class="opened">                    <div style="padding-left:26px" class="hd leaf">                        <a href="App/Place.html">Place</a>                    </div>                </li>                            <li data-name="class:App_Profile" class="opened">                    <div style="padding-left:26px" class="hd leaf">                        <a href="App/Profile.html">Profile</a>                    </div>                </li>                            <li data-name="class:App_Trip" class="opened">                    <div style="padding-left:26px" class="hd leaf">                        <a href="App/Trip.html">Trip</a>                    </div>                </li>                            <li data-name="class:App_User" class="opened">                    <div style="padding-left:26px" class="hd leaf">                        <a href="App/User.html">User</a>                    </div>                </li>                </ul></div>                </li>                </ul>';

    var searchTypeClasses = {
        'Namespace': 'label-default',
        'Class': 'label-info',
        'Interface': 'label-primary',
        'Trait': 'label-success',
        'Method': 'label-danger',
        '_': 'label-warning'
    };

    var searchIndex = [
                    
            {"type": "Namespace", "link": "App.html", "name": "App", "doc": "Namespace App"},{"type": "Namespace", "link": "App/Console.html", "name": "App\\Console", "doc": "Namespace App\\Console"},{"type": "Namespace", "link": "App/Exceptions.html", "name": "App\\Exceptions", "doc": "Namespace App\\Exceptions"},{"type": "Namespace", "link": "App/Http.html", "name": "App\\Http", "doc": "Namespace App\\Http"},{"type": "Namespace", "link": "App/Http/Controllers.html", "name": "App\\Http\\Controllers", "doc": "Namespace App\\Http\\Controllers"},{"type": "Namespace", "link": "App/Http/Controllers/Auth.html", "name": "App\\Http\\Controllers\\Auth", "doc": "Namespace App\\Http\\Controllers\\Auth"},{"type": "Namespace", "link": "App/Http/Middleware.html", "name": "App\\Http\\Middleware", "doc": "Namespace App\\Http\\Middleware"},{"type": "Namespace", "link": "App/Http/Requests.html", "name": "App\\Http\\Requests", "doc": "Namespace App\\Http\\Requests"},{"type": "Namespace", "link": "App/Http/Resources.html", "name": "App\\Http\\Resources", "doc": "Namespace App\\Http\\Resources"},{"type": "Namespace", "link": "App/Providers.html", "name": "App\\Providers", "doc": "Namespace App\\Providers"},
            
            {"type": "Class", "fromName": "App\\Console", "fromLink": "App/Console.html", "link": "App/Console/Kernel.html", "name": "App\\Console\\Kernel", "doc": "&quot;&quot;"},
                                                        {"type": "Method", "fromName": "App\\Console\\Kernel", "fromLink": "App/Console/Kernel.html", "link": "App/Console/Kernel.html#method_schedule", "name": "App\\Console\\Kernel::schedule", "doc": "&quot;Define the application&#039;s command schedule.&quot;"},
                    {"type": "Method", "fromName": "App\\Console\\Kernel", "fromLink": "App/Console/Kernel.html", "link": "App/Console/Kernel.html#method_commands", "name": "App\\Console\\Kernel::commands", "doc": "&quot;Register the commands for the application.&quot;"},
            
            {"type": "Class", "fromName": "App\\Exceptions", "fromLink": "App/Exceptions.html", "link": "App/Exceptions/Handler.html", "name": "App\\Exceptions\\Handler", "doc": "&quot;&quot;"},
                                                        {"type": "Method", "fromName": "App\\Exceptions\\Handler", "fromLink": "App/Exceptions/Handler.html", "link": "App/Exceptions/Handler.html#method_report", "name": "App\\Exceptions\\Handler::report", "doc": "&quot;Report or log an exception.&quot;"},
                    {"type": "Method", "fromName": "App\\Exceptions\\Handler", "fromLink": "App/Exceptions/Handler.html", "link": "App/Exceptions/Handler.html#method_render", "name": "App\\Exceptions\\Handler::render", "doc": "&quot;Render an exception into an HTTP response.&quot;"},
            
            {"type": "Class", "fromName": "App\\Http\\Controllers\\Auth", "fromLink": "App/Http/Controllers/Auth.html", "link": "App/Http/Controllers/Auth/ForgotPasswordController.html", "name": "App\\Http\\Controllers\\Auth\\ForgotPasswordController", "doc": "&quot;&quot;"},
                                                        {"type": "Method", "fromName": "App\\Http\\Controllers\\Auth\\ForgotPasswordController", "fromLink": "App/Http/Controllers/Auth/ForgotPasswordController.html", "link": "App/Http/Controllers/Auth/ForgotPasswordController.html#method___construct", "name": "App\\Http\\Controllers\\Auth\\ForgotPasswordController::__construct", "doc": "&quot;Create a new controller instance.&quot;"},
            
            {"type": "Class", "fromName": "App\\Http\\Controllers\\Auth", "fromLink": "App/Http/Controllers/Auth.html", "link": "App/Http/Controllers/Auth/LoginController.html", "name": "App\\Http\\Controllers\\Auth\\LoginController", "doc": "&quot;&quot;"},
                                                        {"type": "Method", "fromName": "App\\Http\\Controllers\\Auth\\LoginController", "fromLink": "App/Http/Controllers/Auth/LoginController.html", "link": "App/Http/Controllers/Auth/LoginController.html#method___construct", "name": "App\\Http\\Controllers\\Auth\\LoginController::__construct", "doc": "&quot;Create a new controller instance.&quot;"},
                    {"type": "Method", "fromName": "App\\Http\\Controllers\\Auth\\LoginController", "fromLink": "App/Http/Controllers/Auth/LoginController.html", "link": "App/Http/Controllers/Auth/LoginController.html#method_login", "name": "App\\Http\\Controllers\\Auth\\LoginController::login", "doc": "&quot;Login user and create token&quot;"},
            
            {"type": "Class", "fromName": "App\\Http\\Controllers\\Auth", "fromLink": "App/Http/Controllers/Auth.html", "link": "App/Http/Controllers/Auth/RegisterController.html", "name": "App\\Http\\Controllers\\Auth\\RegisterController", "doc": "&quot;&quot;"},
                                                        {"type": "Method", "fromName": "App\\Http\\Controllers\\Auth\\RegisterController", "fromLink": "App/Http/Controllers/Auth/RegisterController.html", "link": "App/Http/Controllers/Auth/RegisterController.html#method___construct", "name": "App\\Http\\Controllers\\Auth\\RegisterController::__construct", "doc": "&quot;Create a new controller instance.&quot;"},
                    {"type": "Method", "fromName": "App\\Http\\Controllers\\Auth\\RegisterController", "fromLink": "App/Http/Controllers/Auth/RegisterController.html", "link": "App/Http/Controllers/Auth/RegisterController.html#method_validator", "name": "App\\Http\\Controllers\\Auth\\RegisterController::validator", "doc": "&quot;Get a validator for an incoming registration request.&quot;"},
                    {"type": "Method", "fromName": "App\\Http\\Controllers\\Auth\\RegisterController", "fromLink": "App/Http/Controllers/Auth/RegisterController.html", "link": "App/Http/Controllers/Auth/RegisterController.html#method_create", "name": "App\\Http\\Controllers\\Auth\\RegisterController::create", "doc": "&quot;Create a new user instance after a valid registration.&quot;"},
            
            {"type": "Class", "fromName": "App\\Http\\Controllers\\Auth", "fromLink": "App/Http/Controllers/Auth.html", "link": "App/Http/Controllers/Auth/ResetPasswordController.html", "name": "App\\Http\\Controllers\\Auth\\ResetPasswordController", "doc": "&quot;&quot;"},
                                                        {"type": "Method", "fromName": "App\\Http\\Controllers\\Auth\\ResetPasswordController", "fromLink": "App/Http/Controllers/Auth/ResetPasswordController.html", "link": "App/Http/Controllers/Auth/ResetPasswordController.html#method___construct", "name": "App\\Http\\Controllers\\Auth\\ResetPasswordController::__construct", "doc": "&quot;Create a new controller instance.&quot;"},
                    {"type": "Method", "fromName": "App\\Http\\Controllers\\Auth\\ResetPasswordController", "fromLink": "App/Http/Controllers/Auth/ResetPasswordController.html", "link": "App/Http/Controllers/Auth/ResetPasswordController.html#method_reset", "name": "App\\Http\\Controllers\\Auth\\ResetPasswordController::reset", "doc": "&quot;Reset the given user&#039;s password.&quot;"},
            
            {"type": "Class", "fromName": "App\\Http\\Controllers", "fromLink": "App/Http/Controllers.html", "link": "App/Http/Controllers/Controller.html", "name": "App\\Http\\Controllers\\Controller", "doc": "&quot;&quot;"},
                    
            {"type": "Class", "fromName": "App\\Http\\Controllers", "fromLink": "App/Http/Controllers.html", "link": "App/Http/Controllers/HomeController.html", "name": "App\\Http\\Controllers\\HomeController", "doc": "&quot;&quot;"},
                                                        {"type": "Method", "fromName": "App\\Http\\Controllers\\HomeController", "fromLink": "App/Http/Controllers/HomeController.html", "link": "App/Http/Controllers/HomeController.html#method___construct", "name": "App\\Http\\Controllers\\HomeController::__construct", "doc": "&quot;Create a new controller instance.&quot;"},
                    {"type": "Method", "fromName": "App\\Http\\Controllers\\HomeController", "fromLink": "App/Http/Controllers/HomeController.html", "link": "App/Http/Controllers/HomeController.html#method_index", "name": "App\\Http\\Controllers\\HomeController::index", "doc": "&quot;Show the application dashboard.&quot;"},
            
            {"type": "Class", "fromName": "App\\Http\\Controllers", "fromLink": "App/Http/Controllers.html", "link": "App/Http/Controllers/PermissionController.html", "name": "App\\Http\\Controllers\\PermissionController", "doc": "&quot;&quot;"},
                                                        {"type": "Method", "fromName": "App\\Http\\Controllers\\PermissionController", "fromLink": "App/Http/Controllers/PermissionController.html", "link": "App/Http/Controllers/PermissionController.html#method_index", "name": "App\\Http\\Controllers\\PermissionController::index", "doc": "&quot;Display a listing of the resource.&quot;"},
                    {"type": "Method", "fromName": "App\\Http\\Controllers\\PermissionController", "fromLink": "App/Http/Controllers/PermissionController.html", "link": "App/Http/Controllers/PermissionController.html#method_create", "name": "App\\Http\\Controllers\\PermissionController::create", "doc": "&quot;Show the form for creating a new resource.&quot;"},
                    {"type": "Method", "fromName": "App\\Http\\Controllers\\PermissionController", "fromLink": "App/Http/Controllers/PermissionController.html", "link": "App/Http/Controllers/PermissionController.html#method_store", "name": "App\\Http\\Controllers\\PermissionController::store", "doc": "&quot;Store a newly created resource in storage.&quot;"},
                    {"type": "Method", "fromName": "App\\Http\\Controllers\\PermissionController", "fromLink": "App/Http/Controllers/PermissionController.html", "link": "App/Http/Controllers/PermissionController.html#method_show", "name": "App\\Http\\Controllers\\PermissionController::show", "doc": "&quot;Display the specified resource.&quot;"},
                    {"type": "Method", "fromName": "App\\Http\\Controllers\\PermissionController", "fromLink": "App/Http/Controllers/PermissionController.html", "link": "App/Http/Controllers/PermissionController.html#method_edit", "name": "App\\Http\\Controllers\\PermissionController::edit", "doc": "&quot;Show the form for editing the specified resource.&quot;"},
                    {"type": "Method", "fromName": "App\\Http\\Controllers\\PermissionController", "fromLink": "App/Http/Controllers/PermissionController.html", "link": "App/Http/Controllers/PermissionController.html#method_userSync", "name": "App\\Http\\Controllers\\PermissionController::userSync", "doc": "&quot;Actualiza los permisos individuales de un usuario&quot;"},
                    {"type": "Method", "fromName": "App\\Http\\Controllers\\PermissionController", "fromLink": "App/Http/Controllers/PermissionController.html", "link": "App/Http/Controllers/PermissionController.html#method_destroy", "name": "App\\Http\\Controllers\\PermissionController::destroy", "doc": "&quot;Remove the specified resource from storage.&quot;"},
            
            {"type": "Class", "fromName": "App\\Http\\Controllers", "fromLink": "App/Http/Controllers.html", "link": "App/Http/Controllers/PlaceController.html", "name": "App\\Http\\Controllers\\PlaceController", "doc": "&quot;&quot;"},
                                                        {"type": "Method", "fromName": "App\\Http\\Controllers\\PlaceController", "fromLink": "App/Http/Controllers/PlaceController.html", "link": "App/Http/Controllers/PlaceController.html#method_index", "name": "App\\Http\\Controllers\\PlaceController::index", "doc": "&quot;Display a listing of the resource.&quot;"},
                    {"type": "Method", "fromName": "App\\Http\\Controllers\\PlaceController", "fromLink": "App/Http/Controllers/PlaceController.html", "link": "App/Http/Controllers/PlaceController.html#method_create", "name": "App\\Http\\Controllers\\PlaceController::create", "doc": "&quot;Show the form for creating a new resource.&quot;"},
                    {"type": "Method", "fromName": "App\\Http\\Controllers\\PlaceController", "fromLink": "App/Http/Controllers/PlaceController.html", "link": "App/Http/Controllers/PlaceController.html#method_store", "name": "App\\Http\\Controllers\\PlaceController::store", "doc": "&quot;Store a newly created resource in storage.&quot;"},
                    {"type": "Method", "fromName": "App\\Http\\Controllers\\PlaceController", "fromLink": "App/Http/Controllers/PlaceController.html", "link": "App/Http/Controllers/PlaceController.html#method_show", "name": "App\\Http\\Controllers\\PlaceController::show", "doc": "&quot;Display the specified resource.&quot;"},
                    {"type": "Method", "fromName": "App\\Http\\Controllers\\PlaceController", "fromLink": "App/Http/Controllers/PlaceController.html", "link": "App/Http/Controllers/PlaceController.html#method_edit", "name": "App\\Http\\Controllers\\PlaceController::edit", "doc": "&quot;Show the form for editing the specified resource.&quot;"},
                    {"type": "Method", "fromName": "App\\Http\\Controllers\\PlaceController", "fromLink": "App/Http/Controllers/PlaceController.html", "link": "App/Http/Controllers/PlaceController.html#method_update", "name": "App\\Http\\Controllers\\PlaceController::update", "doc": "&quot;Update the specified resource in storage.&quot;"},
                    {"type": "Method", "fromName": "App\\Http\\Controllers\\PlaceController", "fromLink": "App/Http/Controllers/PlaceController.html", "link": "App/Http/Controllers/PlaceController.html#method_destroy", "name": "App\\Http\\Controllers\\PlaceController::destroy", "doc": "&quot;Remove the specified resource from storage.&quot;"},
            
            {"type": "Class", "fromName": "App\\Http\\Controllers", "fromLink": "App/Http/Controllers.html", "link": "App/Http/Controllers/RolesController.html", "name": "App\\Http\\Controllers\\RolesController", "doc": "&quot;&quot;"},
                                                        {"type": "Method", "fromName": "App\\Http\\Controllers\\RolesController", "fromLink": "App/Http/Controllers/RolesController.html", "link": "App/Http/Controllers/RolesController.html#method_index", "name": "App\\Http\\Controllers\\RolesController::index", "doc": "&quot;Display a listing of the resource.&quot;"},
                    {"type": "Method", "fromName": "App\\Http\\Controllers\\RolesController", "fromLink": "App/Http/Controllers/RolesController.html", "link": "App/Http/Controllers/RolesController.html#method_store", "name": "App\\Http\\Controllers\\RolesController::store", "doc": "&quot;Store a newly created resource in storage.&quot;"},
                    {"type": "Method", "fromName": "App\\Http\\Controllers\\RolesController", "fromLink": "App/Http/Controllers/RolesController.html", "link": "App/Http/Controllers/RolesController.html#method_show", "name": "App\\Http\\Controllers\\RolesController::show", "doc": "&quot;Display the specified resource.&quot;"},
                    {"type": "Method", "fromName": "App\\Http\\Controllers\\RolesController", "fromLink": "App/Http/Controllers/RolesController.html", "link": "App/Http/Controllers/RolesController.html#method_update", "name": "App\\Http\\Controllers\\RolesController::update", "doc": "&quot;Update the specified resource in storage.&quot;"},
                    {"type": "Method", "fromName": "App\\Http\\Controllers\\RolesController", "fromLink": "App/Http/Controllers/RolesController.html", "link": "App/Http/Controllers/RolesController.html#method_destroy", "name": "App\\Http\\Controllers\\RolesController::destroy", "doc": "&quot;Elimina rol aka perfiles de permisos&quot;"},
                    {"type": "Method", "fromName": "App\\Http\\Controllers\\RolesController", "fromLink": "App/Http/Controllers/RolesController.html", "link": "App/Http/Controllers/RolesController.html#method_assignToUser", "name": "App\\Http\\Controllers\\RolesController::assignToUser", "doc": "&quot;&quot;"},
            
            {"type": "Class", "fromName": "App\\Http\\Controllers", "fromLink": "App/Http/Controllers.html", "link": "App/Http/Controllers/TripsController.html", "name": "App\\Http\\Controllers\\TripsController", "doc": "&quot;&quot;"},
                                                        {"type": "Method", "fromName": "App\\Http\\Controllers\\TripsController", "fromLink": "App/Http/Controllers/TripsController.html", "link": "App/Http/Controllers/TripsController.html#method_index", "name": "App\\Http\\Controllers\\TripsController::index", "doc": "&quot;Display a listing of the resource.&quot;"},
                    {"type": "Method", "fromName": "App\\Http\\Controllers\\TripsController", "fromLink": "App/Http/Controllers/TripsController.html", "link": "App/Http/Controllers/TripsController.html#method_store", "name": "App\\Http\\Controllers\\TripsController::store", "doc": "&quot;Creaci\u00f3n de nuevo viaje&quot;"},
                    {"type": "Method", "fromName": "App\\Http\\Controllers\\TripsController", "fromLink": "App/Http/Controllers/TripsController.html", "link": "App/Http/Controllers/TripsController.html#method_upload", "name": "App\\Http\\Controllers\\TripsController::upload", "doc": "&quot;Subir archivo excel&quot;"},
                    {"type": "Method", "fromName": "App\\Http\\Controllers\\TripsController", "fromLink": "App/Http/Controllers/TripsController.html", "link": "App/Http/Controllers/TripsController.html#method_show", "name": "App\\Http\\Controllers\\TripsController::show", "doc": "&quot;Display the specified resource.&quot;"},
                    {"type": "Method", "fromName": "App\\Http\\Controllers\\TripsController", "fromLink": "App/Http/Controllers/TripsController.html", "link": "App/Http/Controllers/TripsController.html#method_update", "name": "App\\Http\\Controllers\\TripsController::update", "doc": "&quot;Editar viaje&quot;"},
                    {"type": "Method", "fromName": "App\\Http\\Controllers\\TripsController", "fromLink": "App/Http/Controllers/TripsController.html", "link": "App/Http/Controllers/TripsController.html#method_destroy", "name": "App\\Http\\Controllers\\TripsController::destroy", "doc": "&quot;Remove the specified resource from storage.&quot;"},
            
            {"type": "Class", "fromName": "App\\Http\\Controllers", "fromLink": "App/Http/Controllers.html", "link": "App/Http/Controllers/UsersController.html", "name": "App\\Http\\Controllers\\UsersController", "doc": "&quot;&quot;"},
                                                        {"type": "Method", "fromName": "App\\Http\\Controllers\\UsersController", "fromLink": "App/Http/Controllers/UsersController.html", "link": "App/Http/Controllers/UsersController.html#method_index", "name": "App\\Http\\Controllers\\UsersController::index", "doc": "&quot;Display a listing of the resource.&quot;"},
                    {"type": "Method", "fromName": "App\\Http\\Controllers\\UsersController", "fromLink": "App/Http/Controllers/UsersController.html", "link": "App/Http/Controllers/UsersController.html#method_store", "name": "App\\Http\\Controllers\\UsersController::store", "doc": "&quot;Store a newly created resource in storage.&quot;"},
                    {"type": "Method", "fromName": "App\\Http\\Controllers\\UsersController", "fromLink": "App/Http/Controllers/UsersController.html", "link": "App/Http/Controllers/UsersController.html#method_changePassword", "name": "App\\Http\\Controllers\\UsersController::changePassword", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "App\\Http\\Controllers\\UsersController", "fromLink": "App/Http/Controllers/UsersController.html", "link": "App/Http/Controllers/UsersController.html#method_show", "name": "App\\Http\\Controllers\\UsersController::show", "doc": "&quot;Display the specified resource.&quot;"},
                    {"type": "Method", "fromName": "App\\Http\\Controllers\\UsersController", "fromLink": "App/Http/Controllers/UsersController.html", "link": "App/Http/Controllers/UsersController.html#method_update", "name": "App\\Http\\Controllers\\UsersController::update", "doc": "&quot;Update the specified resource in storage.&quot;"},
                    {"type": "Method", "fromName": "App\\Http\\Controllers\\UsersController", "fromLink": "App/Http/Controllers/UsersController.html", "link": "App/Http/Controllers/UsersController.html#method_destroy", "name": "App\\Http\\Controllers\\UsersController::destroy", "doc": "&quot;Remove the specified resource from storage.&quot;"},
            
            {"type": "Class", "fromName": "App\\Http", "fromLink": "App/Http.html", "link": "App/Http/Kernel.html", "name": "App\\Http\\Kernel", "doc": "&quot;&quot;"},
                    
            {"type": "Class", "fromName": "App\\Http\\Middleware", "fromLink": "App/Http/Middleware.html", "link": "App/Http/Middleware/EncryptCookies.html", "name": "App\\Http\\Middleware\\EncryptCookies", "doc": "&quot;&quot;"},
                    
            {"type": "Class", "fromName": "App\\Http\\Middleware", "fromLink": "App/Http/Middleware.html", "link": "App/Http/Middleware/RedirectIfAuthenticated.html", "name": "App\\Http\\Middleware\\RedirectIfAuthenticated", "doc": "&quot;&quot;"},
                                                        {"type": "Method", "fromName": "App\\Http\\Middleware\\RedirectIfAuthenticated", "fromLink": "App/Http/Middleware/RedirectIfAuthenticated.html", "link": "App/Http/Middleware/RedirectIfAuthenticated.html#method_handle", "name": "App\\Http\\Middleware\\RedirectIfAuthenticated::handle", "doc": "&quot;Handle an incoming request.&quot;"},
            
            {"type": "Class", "fromName": "App\\Http\\Middleware", "fromLink": "App/Http/Middleware.html", "link": "App/Http/Middleware/TrimStrings.html", "name": "App\\Http\\Middleware\\TrimStrings", "doc": "&quot;&quot;"},
                    
            {"type": "Class", "fromName": "App\\Http\\Middleware", "fromLink": "App/Http/Middleware.html", "link": "App/Http/Middleware/TrustProxies.html", "name": "App\\Http\\Middleware\\TrustProxies", "doc": "&quot;&quot;"},
                    
            {"type": "Class", "fromName": "App\\Http\\Middleware", "fromLink": "App/Http/Middleware.html", "link": "App/Http/Middleware/VerifyCsrfToken.html", "name": "App\\Http\\Middleware\\VerifyCsrfToken", "doc": "&quot;&quot;"},
                    
            {"type": "Class", "fromName": "App\\Http\\Requests", "fromLink": "App/Http/Requests.html", "link": "App/Http/Requests/TripRequest.html", "name": "App\\Http\\Requests\\TripRequest", "doc": "&quot;&quot;"},
                                                        {"type": "Method", "fromName": "App\\Http\\Requests\\TripRequest", "fromLink": "App/Http/Requests/TripRequest.html", "link": "App/Http/Requests/TripRequest.html#method_authorize", "name": "App\\Http\\Requests\\TripRequest::authorize", "doc": "&quot;Determine if the user is authorized to make this request.&quot;"},
                    {"type": "Method", "fromName": "App\\Http\\Requests\\TripRequest", "fromLink": "App/Http/Requests/TripRequest.html", "link": "App/Http/Requests/TripRequest.html#method_rules", "name": "App\\Http\\Requests\\TripRequest::rules", "doc": "&quot;Get the validation rules that apply to the request.&quot;"},
            
            {"type": "Class", "fromName": "App\\Http\\Resources", "fromLink": "App/Http/Resources.html", "link": "App/Http/Resources/PermissionResource.html", "name": "App\\Http\\Resources\\PermissionResource", "doc": "&quot;&quot;"},
                                                        {"type": "Method", "fromName": "App\\Http\\Resources\\PermissionResource", "fromLink": "App/Http/Resources/PermissionResource.html", "link": "App/Http/Resources/PermissionResource.html#method_toArray", "name": "App\\Http\\Resources\\PermissionResource::toArray", "doc": "&quot;Transform the resource into an array.&quot;"},
            
            {"type": "Class", "fromName": "App\\Http\\Resources", "fromLink": "App/Http/Resources.html", "link": "App/Http/Resources/UsersResource.html", "name": "App\\Http\\Resources\\UsersResource", "doc": "&quot;&quot;"},
                                                        {"type": "Method", "fromName": "App\\Http\\Resources\\UsersResource", "fromLink": "App/Http/Resources/UsersResource.html", "link": "App/Http/Resources/UsersResource.html#method_toArray", "name": "App\\Http\\Resources\\UsersResource::toArray", "doc": "&quot;Transform the resource into an array.&quot;"},
            
            {"type": "Class", "fromName": "App", "fromLink": "App.html", "link": "App/Permission.html", "name": "App\\Permission", "doc": "&quot;&quot;"},
                    
            {"type": "Class", "fromName": "App", "fromLink": "App.html", "link": "App/Place.html", "name": "App\\Place", "doc": "&quot;&quot;"},
                    
            {"type": "Class", "fromName": "App", "fromLink": "App.html", "link": "App/Profile.html", "name": "App\\Profile", "doc": "&quot;&quot;"},
                                                        {"type": "Method", "fromName": "App\\Profile", "fromLink": "App/Profile.html", "link": "App/Profile.html#method_user", "name": "App\\Profile::user", "doc": "&quot;&quot;"},
            
            {"type": "Class", "fromName": "App\\Providers", "fromLink": "App/Providers.html", "link": "App/Providers/AppServiceProvider.html", "name": "App\\Providers\\AppServiceProvider", "doc": "&quot;&quot;"},
                                                        {"type": "Method", "fromName": "App\\Providers\\AppServiceProvider", "fromLink": "App/Providers/AppServiceProvider.html", "link": "App/Providers/AppServiceProvider.html#method_boot", "name": "App\\Providers\\AppServiceProvider::boot", "doc": "&quot;Bootstrap any application services.&quot;"},
                    {"type": "Method", "fromName": "App\\Providers\\AppServiceProvider", "fromLink": "App/Providers/AppServiceProvider.html", "link": "App/Providers/AppServiceProvider.html#method_register", "name": "App\\Providers\\AppServiceProvider::register", "doc": "&quot;Register any application services.&quot;"},
            
            {"type": "Class", "fromName": "App\\Providers", "fromLink": "App/Providers.html", "link": "App/Providers/AuthServiceProvider.html", "name": "App\\Providers\\AuthServiceProvider", "doc": "&quot;&quot;"},
                                                        {"type": "Method", "fromName": "App\\Providers\\AuthServiceProvider", "fromLink": "App/Providers/AuthServiceProvider.html", "link": "App/Providers/AuthServiceProvider.html#method_boot", "name": "App\\Providers\\AuthServiceProvider::boot", "doc": "&quot;Register any authentication \/ authorization services.&quot;"},
            
            {"type": "Class", "fromName": "App\\Providers", "fromLink": "App/Providers.html", "link": "App/Providers/BroadcastServiceProvider.html", "name": "App\\Providers\\BroadcastServiceProvider", "doc": "&quot;&quot;"},
                                                        {"type": "Method", "fromName": "App\\Providers\\BroadcastServiceProvider", "fromLink": "App/Providers/BroadcastServiceProvider.html", "link": "App/Providers/BroadcastServiceProvider.html#method_boot", "name": "App\\Providers\\BroadcastServiceProvider::boot", "doc": "&quot;Bootstrap any application services.&quot;"},
            
            {"type": "Class", "fromName": "App\\Providers", "fromLink": "App/Providers.html", "link": "App/Providers/EventServiceProvider.html", "name": "App\\Providers\\EventServiceProvider", "doc": "&quot;&quot;"},
                                                        {"type": "Method", "fromName": "App\\Providers\\EventServiceProvider", "fromLink": "App/Providers/EventServiceProvider.html", "link": "App/Providers/EventServiceProvider.html#method_boot", "name": "App\\Providers\\EventServiceProvider::boot", "doc": "&quot;Register any events for your application.&quot;"},
            
            {"type": "Class", "fromName": "App\\Providers", "fromLink": "App/Providers.html", "link": "App/Providers/RouteServiceProvider.html", "name": "App\\Providers\\RouteServiceProvider", "doc": "&quot;&quot;"},
                                                        {"type": "Method", "fromName": "App\\Providers\\RouteServiceProvider", "fromLink": "App/Providers/RouteServiceProvider.html", "link": "App/Providers/RouteServiceProvider.html#method_boot", "name": "App\\Providers\\RouteServiceProvider::boot", "doc": "&quot;Define your route model bindings, pattern filters, etc.&quot;"},
                    {"type": "Method", "fromName": "App\\Providers\\RouteServiceProvider", "fromLink": "App/Providers/RouteServiceProvider.html", "link": "App/Providers/RouteServiceProvider.html#method_map", "name": "App\\Providers\\RouteServiceProvider::map", "doc": "&quot;Define the routes for the application.&quot;"},
                    {"type": "Method", "fromName": "App\\Providers\\RouteServiceProvider", "fromLink": "App/Providers/RouteServiceProvider.html", "link": "App/Providers/RouteServiceProvider.html#method_mapWebRoutes", "name": "App\\Providers\\RouteServiceProvider::mapWebRoutes", "doc": "&quot;Define the \&quot;web\&quot; routes for the application.&quot;"},
                    {"type": "Method", "fromName": "App\\Providers\\RouteServiceProvider", "fromLink": "App/Providers/RouteServiceProvider.html", "link": "App/Providers/RouteServiceProvider.html#method_mapApiRoutes", "name": "App\\Providers\\RouteServiceProvider::mapApiRoutes", "doc": "&quot;Define the \&quot;api\&quot; routes for the application.&quot;"},
            
            {"type": "Class", "fromName": "App", "fromLink": "App.html", "link": "App/Trip.html", "name": "App\\Trip", "doc": "&quot;&quot;"},
                    
            {"type": "Class", "fromName": "App", "fromLink": "App.html", "link": "App/User.html", "name": "App\\User", "doc": "&quot;&quot;"},
                                                        {"type": "Method", "fromName": "App\\User", "fromLink": "App/User.html", "link": "App/User.html#method_profile", "name": "App\\User::profile", "doc": "&quot;&quot;"},
            
            
                                        // Fix trailing commas in the index
        {}
    ];

    /** Tokenizes strings by namespaces and functions */
    function tokenizer(term) {
        if (!term) {
            return [];
        }

        var tokens = [term];
        var meth = term.indexOf('::');

        // Split tokens into methods if "::" is found.
        if (meth > -1) {
            tokens.push(term.substr(meth + 2));
            term = term.substr(0, meth - 2);
        }

        // Split by namespace or fake namespace.
        if (term.indexOf('\\') > -1) {
            tokens = tokens.concat(term.split('\\'));
        } else if (term.indexOf('_') > 0) {
            tokens = tokens.concat(term.split('_'));
        }

        // Merge in splitting the string by case and return
        tokens = tokens.concat(term.match(/(([A-Z]?[^A-Z]*)|([a-z]?[^a-z]*))/g).slice(0,-1));

        return tokens;
    };

    root.Sami = {
        /**
         * Cleans the provided term. If no term is provided, then one is
         * grabbed from the query string "search" parameter.
         */
        cleanSearchTerm: function(term) {
            // Grab from the query string
            if (typeof term === 'undefined') {
                var name = 'search';
                var regex = new RegExp("[\\?&]" + name + "=([^&#]*)");
                var results = regex.exec(location.search);
                if (results === null) {
                    return null;
                }
                term = decodeURIComponent(results[1].replace(/\+/g, " "));
            }

            return term.replace(/<(?:.|\n)*?>/gm, '');
        },

        /** Searches through the index for a given term */
        search: function(term) {
            // Create a new search index if needed
            if (!bhIndex) {
                bhIndex = new Bloodhound({
                    limit: 500,
                    local: searchIndex,
                    datumTokenizer: function (d) {
                        return tokenizer(d.name);
                    },
                    queryTokenizer: Bloodhound.tokenizers.whitespace
                });
                bhIndex.initialize();
            }

            results = [];
            bhIndex.get(term, function(matches) {
                results = matches;
            });

            if (!rootPath) {
                return results;
            }

            // Fix the element links based on the current page depth.
            return $.map(results, function(ele) {
                if (ele.link.indexOf('..') > -1) {
                    return ele;
                }
                ele.link = rootPath + ele.link;
                if (ele.fromLink) {
                    ele.fromLink = rootPath + ele.fromLink;
                }
                return ele;
            });
        },

        /** Get a search class for a specific type */
        getSearchClass: function(type) {
            return searchTypeClasses[type] || searchTypeClasses['_'];
        },

        /** Add the left-nav tree to the site */
        injectApiTree: function(ele) {
            ele.html(treeHtml);
        }
    };

    $(function() {
        // Modify the HTML to work correctly based on the current depth
        rootPath = $('body').attr('data-root-path');
        treeHtml = treeHtml.replace(/href="/g, 'href="' + rootPath);
        Sami.injectApiTree($('#api-tree'));
    });

    return root.Sami;
})(window);

$(function() {

    // Enable the version switcher
    $('#version-switcher').change(function() {
        window.location = $(this).val()
    });

    
        // Toggle left-nav divs on click
        $('#api-tree .hd span').click(function() {
            $(this).parent().parent().toggleClass('opened');
        });

        // Expand the parent namespaces of the current page.
        var expected = $('body').attr('data-name');

        if (expected) {
            // Open the currently selected node and its parents.
            var container = $('#api-tree');
            var node = $('#api-tree li[data-name="' + expected + '"]');
            // Node might not be found when simulating namespaces
            if (node.length > 0) {
                node.addClass('active').addClass('opened');
                node.parents('li').addClass('opened');
                var scrollPos = node.offset().top - container.offset().top + container.scrollTop();
                // Position the item nearer to the top of the screen.
                scrollPos -= 200;
                container.scrollTop(scrollPos);
            }
        }

    
    
        var form = $('#search-form .typeahead');
        form.typeahead({
            hint: true,
            highlight: true,
            minLength: 1
        }, {
            name: 'search',
            displayKey: 'name',
            source: function (q, cb) {
                cb(Sami.search(q));
            }
        });

        // The selection is direct-linked when the user selects a suggestion.
        form.on('typeahead:selected', function(e, suggestion) {
            window.location = suggestion.link;
        });

        // The form is submitted when the user hits enter.
        form.keypress(function (e) {
            if (e.which == 13) {
                $('#search-form').submit();
                return true;
            }
        });

    
});


