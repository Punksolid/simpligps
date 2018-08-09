---
title: API Reference

language_tabs:
- bash
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.
[Get Postman Collection](http://localhost/docs/collection.json)

<!-- END_INFO -->

#general
<!-- START_080f3ecebb7bcc2f93284b8f5ae1ac3b -->
## Display a listing of the resource.

> Example request:

```bash
curl -X GET "http://localhost/api/v1/users" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/users",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "data": [
        {
            "name": "Zion Koch",
            "lastname": "default",
            "email": "vblanda@example.org",
            "username": "default"
        },
        {
            "name": "Nicola Ortiz",
            "lastname": "default",
            "email": "marge.howe@example.com",
            "username": "default"
        },
        {
            "name": "Ms. Alicia Wehner",
            "lastname": "default",
            "email": "peyton.wilkinson@example.org",
            "username": "default"
        },
        {
            "name": "Stanley Schroeder Sr.",
            "lastname": "default",
            "email": "hildegard09@example.com",
            "username": "default"
        },
        {
            "name": "Mr. Dylan Wyman Jr.",
            "lastname": "default",
            "email": "abbott.kolby@example.org",
            "username": "default"
        },
        {
            "name": "Modesto Goldner",
            "lastname": "default",
            "email": "caleb01@example.org",
            "username": "default"
        },
        {
            "name": "Cedrick Stehr",
            "lastname": "default",
            "email": "dicki.darren@example.com",
            "username": "default"
        },
        {
            "name": "Prof. Brant Watsica",
            "lastname": "default",
            "email": "smitchell@example.org",
            "username": "default"
        },
        {
            "name": "Prof. Emory Treutel",
            "lastname": "Donnelly",
            "email": "wbraun@gmail.com",
            "username": "goldner.demond"
        },
        {
            "name": "Rene Dicki",
            "lastname": "default",
            "email": "nhoppe@example.net",
            "username": "default"
        },
        {
            "name": "Oren Kreiger III",
            "lastname": "default",
            "email": "adrienne.herzog@example.com",
            "username": "default"
        },
        {
            "name": "Sadie Luettgen",
            "lastname": "default",
            "email": "arely.oconner@example.org",
            "username": "default"
        },
        {
            "name": "Lincoln Bernier",
            "lastname": "default",
            "email": "shanahan.wilmer@example.net",
            "username": "default"
        },
        {
            "name": "Leonie Ferry",
            "lastname": "default",
            "email": "bogisich.jayda@example.com",
            "username": "default"
        },
        {
            "name": "Monserrate Mayert",
            "lastname": "default",
            "email": "dax56@example.org",
            "username": "default"
        },
        {
            "name": "Monty O'Connell",
            "lastname": "default",
            "email": "ida56@example.net",
            "username": "default"
        },
        {
            "name": "Prof. Sheldon Hermann DDS",
            "lastname": "default",
            "email": "cora.bechtelar@example.net",
            "username": "default"
        },
        {
            "name": "Selmer Stehr DDS",
            "lastname": "default",
            "email": "johnston.willow@example.com",
            "username": "default"
        },
        {
            "name": "Mr. Jaydon Dicki Jr.",
            "lastname": "default",
            "email": "ryder95@example.com",
            "username": "default"
        },
        {
            "name": "Dr. Akeem Ledner",
            "lastname": "default",
            "email": "mariela89@example.net",
            "username": "default"
        },
        {
            "name": "Isaiah O'Keefe II",
            "lastname": "default",
            "email": "ccruickshank@example.org",
            "username": "default"
        },
        {
            "name": "Haven Sanford",
            "lastname": "default",
            "email": "stamm.magdalena@example.net",
            "username": "default"
        },
        {
            "name": "Prof. Kyla Bergstrom",
            "lastname": "default",
            "email": "hammes.jazmyne@example.com",
            "username": "default"
        },
        {
            "name": "Miss Verla Smith",
            "lastname": "default",
            "email": "wunsch.theodora@example.org",
            "username": "default"
        },
        {
            "name": "Prof. Avery Senger",
            "lastname": "default",
            "email": "immanuel.turcotte@example.org",
            "username": "default"
        },
        {
            "name": "Mr. Nicklaus Ankunding I",
            "lastname": "default",
            "email": "ollie83@example.net",
            "username": "default"
        },
        {
            "name": "Opal Kuhn",
            "lastname": "default",
            "email": "regan09@example.net",
            "username": "default"
        },
        {
            "name": "Dr. Karlee Rau",
            "lastname": "default",
            "email": "pherman@example.org",
            "username": "default"
        },
        {
            "name": "Deven Rogahn",
            "lastname": "default",
            "email": "corbin.bernhard@example.com",
            "username": "default"
        },
        {
            "name": "Maxie Senger Sr.",
            "lastname": "default",
            "email": "gislason.oscar@example.net",
            "username": "default"
        },
        {
            "name": "Liza Buckridge",
            "lastname": "default",
            "email": "reinger.mason@example.net",
            "username": "default"
        },
        {
            "name": "David Block Jr.",
            "lastname": "default",
            "email": "acormier@example.net",
            "username": "default"
        },
        {
            "name": "Rebekah Hilpert",
            "lastname": "default",
            "email": "mia43@example.com",
            "username": "default"
        },
        {
            "name": "Dr. Destini Mayert II",
            "lastname": "default",
            "email": "donavon.johns@example.net",
            "username": "default"
        },
        {
            "name": "Dr. Carrie Bartell PhD",
            "lastname": "default",
            "email": "jdonnelly@example.com",
            "username": "default"
        },
        {
            "name": "Yolanda Adams",
            "lastname": "default",
            "email": "osborne54@example.net",
            "username": "default"
        },
        {
            "name": "Nikki Collins DVM",
            "lastname": "default",
            "email": "mariam94@example.com",
            "username": "default"
        },
        {
            "name": "Queenie Connelly",
            "lastname": "default",
            "email": "una02@example.net",
            "username": "default"
        },
        {
            "name": "Bernadine Kulas III",
            "lastname": "default",
            "email": "halvorson.elmira@example.com",
            "username": "default"
        },
        {
            "name": "Hailee Dach",
            "lastname": "default",
            "email": "otha64@example.org",
            "username": "default"
        },
        {
            "name": "Prof. Alia Bosco IV",
            "lastname": "default",
            "email": "sfadel@example.net",
            "username": "default"
        },
        {
            "name": "Miss Adele Jenkins",
            "lastname": "default",
            "email": "gladys07@example.net",
            "username": "default"
        },
        {
            "name": "Jolie Schumm",
            "lastname": "default",
            "email": "arely91@example.org",
            "username": "default"
        },
        {
            "name": "Prof. Annette Padberg V",
            "lastname": "default",
            "email": "mann.felicita@example.net",
            "username": "default"
        },
        {
            "name": "Wilfredo Morar",
            "lastname": "default",
            "email": "nconroy@example.org",
            "username": "default"
        },
        {
            "name": "Ned Jones",
            "lastname": "default",
            "email": "keagan.roberts@example.net",
            "username": "default"
        },
        {
            "name": "Reese McLaughlin",
            "lastname": "default",
            "email": "tyler90@example.com",
            "username": "default"
        },
        {
            "name": "Angelina Ratke",
            "lastname": "default",
            "email": "oral.ebert@example.org",
            "username": "default"
        },
        {
            "name": "Prof. Nyah Kulas",
            "lastname": "default",
            "email": "towne.mekhi@example.org",
            "username": "default"
        },
        {
            "name": "Ms. Aliyah Heidenreich I",
            "lastname": "default",
            "email": "stacy.mills@example.net",
            "username": "default"
        },
        {
            "name": "Iva O'Kon",
            "lastname": "default",
            "email": "christiansen.kallie@example.org",
            "username": "default"
        },
        {
            "name": "Alvera Stamm PhD",
            "lastname": "default",
            "email": "travis89@example.net",
            "username": "default"
        },
        {
            "name": "Dr. Cornelius Kuphal MD",
            "lastname": "default",
            "email": "ablock@example.net",
            "username": "default"
        },
        {
            "name": "Dr. Khalil Marquardt",
            "lastname": "default",
            "email": "nbernier@example.com",
            "username": "default"
        },
        {
            "name": "Albertha Von",
            "lastname": "default",
            "email": "joseph36@example.org",
            "username": "default"
        },
        {
            "name": "Miss Rachael Rosenbaum Sr.",
            "lastname": "default",
            "email": "prosacco.genevieve@example.com",
            "username": "default"
        },
        {
            "name": "Prof. Angelo Wilderman Jr.",
            "lastname": "default",
            "email": "shayne.damore@example.org",
            "username": "default"
        },
        {
            "name": "Susanna Hagenes II",
            "lastname": "default",
            "email": "leslie.lynch@example.net",
            "username": "default"
        },
        {
            "name": "Angeline Welch",
            "lastname": "default",
            "email": "laverna40@example.org",
            "username": "default"
        },
        {
            "name": "Johnny Gaylord PhD",
            "lastname": "default",
            "email": "dale49@example.org",
            "username": "default"
        },
        {
            "name": "Maureen Boyle",
            "lastname": "default",
            "email": "albin.ondricka@example.org",
            "username": "default"
        },
        {
            "name": "Linwood Dach",
            "lastname": "default",
            "email": "kassulke.paul@example.org",
            "username": "default"
        },
        {
            "name": "Brionna Considine",
            "lastname": "default",
            "email": "bhoppe@example.net",
            "username": "default"
        },
        {
            "name": "Derrick Huel",
            "lastname": "default",
            "email": "morton.doyle@example.com",
            "username": "default"
        },
        {
            "name": "Marge Howell",
            "lastname": "default",
            "email": "zaltenwerth@example.org",
            "username": "default"
        },
        {
            "name": "Cheyenne O'Connell",
            "lastname": "default",
            "email": "sarina.wyman@example.net",
            "username": "default"
        },
        {
            "name": "Taurean Donnelly",
            "lastname": "default",
            "email": "volkman.roderick@example.com",
            "username": "default"
        },
        {
            "name": "Maryse Volkman",
            "lastname": "default",
            "email": "bdenesik@example.com",
            "username": "default"
        },
        {
            "name": "Prof. Abbie Steuber II",
            "lastname": "default",
            "email": "dickinson.melba@example.com",
            "username": "default"
        },
        {
            "name": "Prof. Megane Mertz MD",
            "lastname": "default",
            "email": "cletus68@example.org",
            "username": "default"
        },
        {
            "name": "Hadley Mueller Sr.",
            "lastname": "default",
            "email": "vking@example.org",
            "username": "default"
        },
        {
            "name": "Alayna Predovic",
            "lastname": "default",
            "email": "lkoch@example.org",
            "username": "default"
        },
        {
            "name": "Makayla Schuppe II",
            "lastname": "default",
            "email": "trippin@example.net",
            "username": "default"
        },
        {
            "name": "Noemi Toy",
            "lastname": "default",
            "email": "qbergstrom@example.org",
            "username": "default"
        },
        {
            "name": "Joanny Heaney",
            "lastname": "default",
            "email": "dkessler@example.com",
            "username": "default"
        },
        {
            "name": "Lela Maggio",
            "lastname": "default",
            "email": "princess.erdman@example.org",
            "username": "default"
        },
        {
            "name": "Dr. Makenzie Carroll",
            "lastname": "default",
            "email": "jmayert@example.com",
            "username": "default"
        },
        {
            "name": "Thurman O'Reilly",
            "lastname": "default",
            "email": "ncummings@example.net",
            "username": "default"
        },
        {
            "name": "Citlalli Morissette",
            "lastname": "default",
            "email": "vharris@example.org",
            "username": "default"
        },
        {
            "name": "Mrs. Lauretta Hills",
            "lastname": "default",
            "email": "renner.billie@example.org",
            "username": "default"
        },
        {
            "name": "Kianna Braun",
            "lastname": "default",
            "email": "bud77@example.com",
            "username": "default"
        },
        {
            "name": "Denis Mohr",
            "lastname": "default",
            "email": "gondricka@example.com",
            "username": "default"
        },
        {
            "name": "Dr. Sigrid Davis",
            "lastname": "default",
            "email": "icollins@example.org",
            "username": "default"
        },
        {
            "name": "Maybell Greenholt",
            "lastname": "default",
            "email": "runolfsson.keely@example.org",
            "username": "default"
        },
        {
            "name": "Thora Brakus",
            "lastname": "default",
            "email": "flatley.abbey@example.org",
            "username": "default"
        },
        {
            "name": "Arne Wolff",
            "lastname": "default",
            "email": "fstiedemann@example.com",
            "username": "default"
        },
        {
            "name": "Della Bailey",
            "lastname": "default",
            "email": "rspencer@example.org",
            "username": "default"
        },
        {
            "name": "Sarina Miller",
            "lastname": "default",
            "email": "hintz.carrie@example.net",
            "username": "default"
        }
    ]
}
```

### HTTP Request
`GET api/v1/users`

`HEAD api/v1/users`


<!-- END_080f3ecebb7bcc2f93284b8f5ae1ac3b -->

<!-- START_4194ceb9a20b7f80b61d14d44df366b4 -->
## Store a newly created resource in storage.

> Example request:

```bash
curl -X POST "http://localhost/api/v1/users" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/users",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/users`


<!-- END_4194ceb9a20b7f80b61d14d44df366b4 -->

<!-- START_25ea8f1ee2eceb341b680b3c0eb89723 -->
## Actualiza los permisos individuales de un usuario

> Example request:

```bash
curl -X PUT "http://localhost/api/v1/permissions/user_sync/{user}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/permissions/user_sync/{user}",
    "method": "PUT",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`PUT api/v1/permissions/user_sync/{user}`


<!-- END_25ea8f1ee2eceb341b680b3c0eb89723 -->

<!-- START_12c77c0afe8dfd7d5653b62a33eb1954 -->
## Display a listing of the resource.

> Example request:

```bash
curl -X GET "http://localhost/api/v1/permissions" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/permissions",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "data": [
        {
            "name": "list-users"
        },
        {
            "name": "add-user"
        }
    ]
}
```

### HTTP Request
`GET api/v1/permissions`

`HEAD api/v1/permissions`


<!-- END_12c77c0afe8dfd7d5653b62a33eb1954 -->

<!-- START_953afc9014630b1a7b008b86bde4414e -->
## api/v1/roles/{role}/user

> Example request:

```bash
curl -X POST "http://localhost/api/v1/roles/{role}/user" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/roles/{role}/user",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/roles/{role}/user`


<!-- END_953afc9014630b1a7b008b86bde4414e -->

<!-- START_d97fba8dbd0d0033960fdc6a25fca8d9 -->
## Display a listing of the resource.

> Example request:

```bash
curl -X GET "http://localhost/api/v1/roles" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/roles",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
[
    {
        "id": 1,
        "name": "monitorista",
        "guard_name": "web",
        "created_at": "2018-08-06 19:44:50",
        "updated_at": "2018-08-06 19:44:50"
    },
    {
        "id": 2,
        "name": "Cullen",
        "guard_name": "web",
        "created_at": "2018-08-06 19:44:54",
        "updated_at": "2018-08-06 19:44:54"
    },
    {
        "id": 3,
        "name": "vvolkman",
        "guard_name": "web",
        "created_at": "2018-08-06 19:44:54",
        "updated_at": "2018-08-06 19:44:54"
    },
    {
        "id": 4,
        "name": "wlehner",
        "guard_name": "web",
        "created_at": "2018-08-06 19:44:54",
        "updated_at": "2018-08-06 19:44:54"
    },
    {
        "id": 5,
        "name": "wbalistreri",
        "guard_name": "web",
        "created_at": "2018-08-06 19:44:54",
        "updated_at": "2018-08-06 19:44:54"
    },
    {
        "id": 6,
        "name": "cschroeder",
        "guard_name": "web",
        "created_at": "2018-08-07 11:38:12",
        "updated_at": "2018-08-07 11:38:12"
    },
    {
        "id": 7,
        "name": "cristian06",
        "guard_name": "web",
        "created_at": "2018-08-07 11:38:29",
        "updated_at": "2018-08-07 11:38:29"
    }
]
```

### HTTP Request
`GET api/v1/roles`

`HEAD api/v1/roles`


<!-- END_d97fba8dbd0d0033960fdc6a25fca8d9 -->

<!-- START_5f753b2bffb6b34b6136ddfe1be7bcce -->
## Store a newly created resource in storage.

> Example request:

```bash
curl -X POST "http://localhost/api/v1/roles" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/roles",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/roles`


<!-- END_5f753b2bffb6b34b6136ddfe1be7bcce -->

<!-- START_f47a034257a009b731160db044157715 -->
## Display the specified resource.

> Example request:

```bash
curl -X GET "http://localhost/api/v1/roles/{role}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/roles/{role}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "name": "monitorista",
    "permissions": []
}
```

### HTTP Request
`GET api/v1/roles/{role}`

`HEAD api/v1/roles/{role}`


<!-- END_f47a034257a009b731160db044157715 -->

<!-- START_81ac9047f8db2b92092c5a7f13e5d28d -->
## Update the specified resource in storage.

> Example request:

```bash
curl -X PUT "http://localhost/api/v1/roles/{role}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/roles/{role}",
    "method": "PUT",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`PUT api/v1/roles/{role}`

`PATCH api/v1/roles/{role}`


<!-- END_81ac9047f8db2b92092c5a7f13e5d28d -->

<!-- START_04c524fc2f0ea8c793406426144b4c71 -->
## Elimina rol aka perfiles de permisos

> Example request:

```bash
curl -X DELETE "http://localhost/api/v1/roles/{role}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/roles/{role}",
    "method": "DELETE",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`DELETE api/v1/roles/{role}`


<!-- END_04c524fc2f0ea8c793406426144b4c71 -->

<!-- START_8c0e48cd8efa861b308fc45872ff0837 -->
## Login user and create token

> Example request:

```bash
curl -X POST "http://localhost/api/v1/login" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/login",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/login`


<!-- END_8c0e48cd8efa861b308fc45872ff0837 -->

<!-- START_2ef1df3705c0d699701afe474d776f42 -->
## Send a reset link to the given user.

> Example request:

```bash
curl -X POST "http://localhost/api/v1/password/send_email" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/password/send_email",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/password/send_email`


<!-- END_2ef1df3705c0d699701afe474d776f42 -->

<!-- START_9b9936e5bc62f136bc41e777ce4ee24a -->
## api/v1/password/change

> Example request:

```bash
curl -X POST "http://localhost/api/v1/password/change" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/password/change",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/password/change`


<!-- END_9b9936e5bc62f136bc41e777ce4ee24a -->

<!-- START_91973ca96008e504988ff054eace4d66 -->
## Subir archivo excel

> Example request:

```bash
curl -X POST "http://localhost/api/v1/trips/upload" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/trips/upload",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/trips/upload`


<!-- END_91973ca96008e504988ff054eace4d66 -->

<!-- START_b0bfe967e103764914eff25d075c572c -->
## Creación de nuevo viaje

> Example request:

```bash
curl -X POST "http://localhost/api/v1/trips" \
-H "Accept: application/json" \
    -d "rp"="provident" \
    -d "invoice"="provident" \
    -d "client"="provident" \
    -d "origin"="provident" \
    -d "destination"="provident" \
    -d "mon_type"="provident" \
    -d "line"="provident" \
    -d "scheduled_load"="1995-10-19" \
    -d "scheduled_departure"="Wednesday, 31-Dec-69 00:00:00 UTC" \
    -d "scheduled_arrival"="Friday, 02-Jan-70 00:00:00 UTC" \
    -d "scheduled_unload"="Friday, 02-Jan-70 00:00:00 UTC" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/trips",
    "method": "POST",
    "data": {
        "rp": "provident",
        "invoice": "provident",
        "client": "provident",
        "origin": "provident",
        "destination": "provident",
        "mon_type": "provident",
        "line": "provident",
        "scheduled_load": "1995-10-19",
        "scheduled_departure": "Wednesday, 31-Dec-69 00:00:00 UTC",
        "scheduled_arrival": "Friday, 02-Jan-70 00:00:00 UTC",
        "scheduled_unload": "Friday, 02-Jan-70 00:00:00 UTC"
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/trips`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    rp | string |  required  | 
    invoice | string |  required  | 
    client | string |  required  | 
    origin | string |  required  | 
    destination | string |  required  | 
    mon_type | string |  required  | 
    line | string |  required  | 
    scheduled_load | date |  required  | 
    scheduled_departure | date |  required  | Must be a date preceding: `Thursday, 01-Jan-70 00:00:00 UTC`
    scheduled_arrival | date |  required  | Must be a date after: `Thursday, 01-Jan-70 00:00:00 UTC`
    scheduled_unload | date |  required  | Must be a date after: `Thursday, 01-Jan-70 00:00:00 UTC`

<!-- END_b0bfe967e103764914eff25d075c572c -->

<!-- START_18a55de27e6b4e429ded5fdedbab7cf4 -->
## Editar viaje

> Example request:

```bash
curl -X PUT "http://localhost/api/v1/trips/{trip}" \
-H "Accept: application/json" \
    -d "rp"="commodi" \
    -d "invoice"="commodi" \
    -d "client"="commodi" \
    -d "origin"="commodi" \
    -d "destination"="commodi" \
    -d "mon_type"="commodi" \
    -d "line"="commodi" \
    -d "scheduled_load"="1987-08-28" \
    -d "scheduled_departure"="Wednesday, 31-Dec-69 00:00:00 UTC" \
    -d "scheduled_arrival"="Friday, 02-Jan-70 00:00:00 UTC" \
    -d "scheduled_unload"="Friday, 02-Jan-70 00:00:00 UTC" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/trips/{trip}",
    "method": "PUT",
    "data": {
        "rp": "commodi",
        "invoice": "commodi",
        "client": "commodi",
        "origin": "commodi",
        "destination": "commodi",
        "mon_type": "commodi",
        "line": "commodi",
        "scheduled_load": "1987-08-28",
        "scheduled_departure": "Wednesday, 31-Dec-69 00:00:00 UTC",
        "scheduled_arrival": "Friday, 02-Jan-70 00:00:00 UTC",
        "scheduled_unload": "Friday, 02-Jan-70 00:00:00 UTC"
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`PUT api/v1/trips/{trip}`

`PATCH api/v1/trips/{trip}`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    rp | string |  required  | 
    invoice | string |  required  | 
    client | string |  required  | 
    origin | string |  required  | 
    destination | string |  required  | 
    mon_type | string |  required  | 
    line | string |  required  | 
    scheduled_load | date |  required  | 
    scheduled_departure | date |  required  | Must be a date preceding: `Thursday, 01-Jan-70 00:00:00 UTC`
    scheduled_arrival | date |  required  | Must be a date after: `Thursday, 01-Jan-70 00:00:00 UTC`
    scheduled_unload | date |  required  | Must be a date after: `Thursday, 01-Jan-70 00:00:00 UTC`

<!-- END_18a55de27e6b4e429ded5fdedbab7cf4 -->

<!-- START_819b84a295a6859066bc63328b8e8eff -->
## Remove the specified resource from storage.

> Example request:

```bash
curl -X DELETE "http://localhost/api/v1/trips/{trip}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/trips/{trip}",
    "method": "DELETE",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`DELETE api/v1/trips/{trip}`


<!-- END_819b84a295a6859066bc63328b8e8eff -->

