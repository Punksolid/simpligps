<?php

Route::put("stringvacio", function (){

    dd(request()->input("hola"));
   dd(request()->all());
});