<?php

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/


Broadcast::channel('App.User.{id}', function ($user, $id) {
//    return true;
    return (int) $user->id === (int) $id;
});
Broadcast::channel('App.Account.{id}', function ($user, $id) {
//    Log::info('websoket',[ $user, $id ]);
//    return true;
    $account  = \App\Account::findOrFail($id);
    return $user->isInAccount($account->id);
});
// 
Broadcast::channel('chat.{roomId}', function ($user, $roomId) {
    
    $account  = \App\Account::findOrFail($roomId);
    if($user->isInAccount($account->id)) {
        return ['id' => $user->id, 'email' => $user->email];
    }
});