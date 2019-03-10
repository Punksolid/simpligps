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
[Get Postman Collection](http://localhost/storage/app/public/docs/admin//collection.json)

<!-- END_INFO -->

#Accounts|Cuentas
<!-- START_8b356485d39cfe95f221d1ed76013fd0 -->
## Agrega datos fiscales

> Example request:

```bash
curl -X PUT "http://localhost:8000/api/sysadmin/v1/accounts/{account}/fiscal" \
    -H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/sysadmin/v1/accounts/{account}/fiscal",
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
`PUT api/sysadmin/v1/accounts/{account}/fiscal`


<!-- END_8b356485d39cfe95f221d1ed76013fd0 -->

<!-- START_2ed090ea6e0172d12ea5df687c97856e -->
## Devuelve un listado de cuentas activas por su lapse

> Example request:

```bash
curl -X GET -G "http://localhost:8000/api/sysadmin/v1/accounts/active_accounts" \
    -H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/sysadmin/v1/accounts/active_accounts",
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
            "id": 3,
            "easyname": "aut",
            "uuid": "379fafe3-809a-36c1-9eb9-ea717fd061c9"
        },
        {
            "id": 5,
            "easyname": "ipsa",
            "uuid": "35dd9813-1de8-31fa-bf0d-44add2fbc560"
        },
        {
            "id": 7,
            "easyname": "dolor",
            "uuid": "da0f312e-10a7-30ca-97ed-9db69026f174"
        },
        {
            "id": 8,
            "easyname": "id",
            "uuid": "1a56436e-6f3c-3aae-8798-5fb8278f3963"
        },
        {
            "id": 9,
            "easyname": "beatae",
            "uuid": "8121d598-752f-309e-9a8e-bc0cb1fb2902"
        },
        {
            "id": 14,
            "easyname": "quia",
            "uuid": "cb440fa2-e9a5-3b7d-b068-b56d37911f37"
        }
    ]
}
```

### HTTP Request
`GET api/sysadmin/v1/accounts/active_accounts`


<!-- END_2ed090ea6e0172d12ea5df687c97856e -->

<!-- START_5a267e3e7f474370cf4ef2bef8dbfd2b -->
## Próximos a expirar en 7 dias

> Example request:

```bash
curl -X GET -G "http://localhost:8000/api/sysadmin/v1/accounts/near_to_expire" \
    -H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/sysadmin/v1/accounts/near_to_expire",
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
            "id": 1,
            "easyname": "ut",
            "uuid": "9967c79f-8188-3598-b0ec-ef8232410a6b"
        }
    ]
}
```

### HTTP Request
`GET api/sysadmin/v1/accounts/near_to_expire`


<!-- END_5a267e3e7f474370cf4ef2bef8dbfd2b -->

<!-- START_387441402a669cf43237c8809716bd5d -->
## Display a listing of the account.

> Example request:

```bash
curl -X GET -G "http://localhost:8000/api/sysadmin/v1/accounts" \
    -H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/sysadmin/v1/accounts",
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
    "token": "eyJ0eXAi…",
    "roles": [
        "admin"
    ]
}
```

### HTTP Request
`GET api/sysadmin/v1/accounts`


<!-- END_387441402a669cf43237c8809716bd5d -->

<!-- START_e0f5766b2dfb164e01f41e64b8d74aee -->
## Store a newly created account in storage.

> Example request:

```bash
curl -X POST "http://localhost:8000/api/sysadmin/v1/accounts" \
    -H "Accept: application/json" \
    -d "easyname"="quia" 
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/sysadmin/v1/accounts",
    "method": "POST",
    "data": {
        "easyname": "quia"
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
`POST api/sysadmin/v1/accounts`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    easyname | string |  required  | 

<!-- END_e0f5766b2dfb164e01f41e64b8d74aee -->

<!-- START_5a4935f72219a68bd159d91e59dfbf4c -->
## Display the specified account.

> Example request:

```bash
curl -X GET -G "http://localhost:8000/api/sysadmin/v1/accounts/{account}" \
    -H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/sysadmin/v1/accounts/{account}",
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
    "data": {
        "id": null,
        "easyname": null,
        "uuid": null,
        "users": [],
        "licenses": []
    }
}
```

### HTTP Request
`GET api/sysadmin/v1/accounts/{account}`


<!-- END_5a4935f72219a68bd159d91e59dfbf4c -->

<!-- START_aa63101565c582c3f9bb005962b381ae -->
## Update the specified account in storage.

> Example request:

```bash
curl -X PUT "http://localhost:8000/api/sysadmin/v1/accounts/{account}" \
    -H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/sysadmin/v1/accounts/{account}",
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
`PUT api/sysadmin/v1/accounts/{account}`

`PATCH api/sysadmin/v1/accounts/{account}`


<!-- END_aa63101565c582c3f9bb005962b381ae -->

<!-- START_4c5f8f865fd8af3686baee1a9f154b03 -->
## Elimina cuenta

> Example request:

```bash
curl -X DELETE "http://localhost:8000/api/sysadmin/v1/accounts/{account}" \
    -H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/sysadmin/v1/accounts/{account}",
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
`DELETE api/sysadmin/v1/accounts/{account}`


<!-- END_4c5f8f865fd8af3686baee1a9f154b03 -->

#Dashboard
<!-- START_0ca0455720d11b67bd839b322273b578 -->
## * Store a newly created resource in storage.

> Example request:

```bash
curl -X GET -G "http://localhost:8000/api/sysadmin/v1/dashboard/accounts" \
    -H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/sysadmin/v1/dashboard/accounts",
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
    "data": 37
}
```

### HTTP Request
`GET api/sysadmin/v1/dashboard/accounts`


<!-- END_0ca0455720d11b67bd839b322273b578 -->

#Licensing
<!-- START_cc13b8681a68d2aff08e01b248263be6 -->
## Asigna Licencia a Cuenta

> Example request:

```bash
curl -X POST "http://localhost:8000/api/sysadmin/v1/licenses/{license}/assign_to_account" \
    -H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/sysadmin/v1/licenses/{license}/assign_to_account",
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
`POST api/sysadmin/v1/licenses/{license}/assign_to_account`


<!-- END_cc13b8681a68d2aff08e01b248263be6 -->

<!-- START_b28a1a0c9ae0d747645ab33b342ee74d -->
## Revoca licencia License, Request

> Example request:

```bash
curl -X POST "http://localhost:8000/api/sysadmin/v1/licenses/{license}/revoke" \
    -H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/sysadmin/v1/licenses/{license}/revoke",
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
`POST api/sysadmin/v1/licenses/{license}/revoke`


<!-- END_b28a1a0c9ae0d747645ab33b342ee74d -->

<!-- START_216b70ae6b951611a7e6cc3852f2c539 -->
## Display a listing of the LICENSE.

> Example request:

```bash
curl -X GET -G "http://localhost:8000/api/sysadmin/v1/licenses" \
    -H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/sysadmin/v1/licenses",
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
            "id": 1,
            "name": "Estevan Ryan",
            "description": "Laborum unde voluptatem quis hic.",
            "lapse": 10,
            "modules": "string_cambiar",
            "units": 10,
            "number_active_sessions": 10,
            "uuid": "76be59d3-7ac9-3102-9388-515ddfe18311"
        },
        {
            "id": 2,
            "name": "Josiah Wehner",
            "description": "Officiis veniam veniam ut.",
            "lapse": 30,
            "modules": "string_cambiar",
            "units": 10,
            "number_active_sessions": 10,
            "uuid": "bf7e0d7b-5621-3968-84d1-5c41b8bc4a04"
        },
        {
            "id": 3,
            "name": "Nikko Goldner",
            "description": "Eum fugit veritatis id.",
            "lapse": 3,
            "modules": "string_cambiar",
            "units": 10,
            "number_active_sessions": 10,
            "uuid": "ff9af5d0-543f-3967-9282-ac4547e55a16"
        },
        {
            "id": 4,
            "name": "Astrid Rice II",
            "description": "Sit assumenda ducimus ipsum omnis enim eveniet.",
            "lapse": 30,
            "modules": "string_cambiar",
            "units": 10,
            "number_active_sessions": 10,
            "uuid": "d0f7bda8-208b-3ecf-a124-e218b4fa5207"
        },
        {
            "id": 5,
            "name": "personalizado",
            "description": "textotextotext",
            "lapse": 50,
            "modules": "monitoring",
            "units": 70,
            "number_active_sessions": 6,
            "uuid": "35ddbf20-c971-4ff5-b9ec-869e0b4e2d2c"
        },
        {
            "id": 6,
            "name": "Prof. Derrick Von I",
            "description": "Eum quidem maxime et voluptatibus excepturi.",
            "lapse": 10,
            "modules": "string_cambiar",
            "units": 10,
            "number_active_sessions": 10,
            "uuid": "29aeafa9-96fd-33c7-9b08-522837626712"
        },
        {
            "id": 7,
            "name": "Albin Rolfson",
            "description": "Enim ducimus et aut tempore.",
            "lapse": 10,
            "modules": "string_cambiar",
            "units": 10,
            "number_active_sessions": 10,
            "uuid": "61c6d9af-a98d-317f-8e2b-ca4bf914ec68"
        },
        {
            "id": 8,
            "name": "Ms. Jane Schinner DVM",
            "description": "Et in voluptates inventore quia ex.",
            "lapse": 10,
            "modules": "string_cambiar",
            "units": 10,
            "number_active_sessions": 10,
            "uuid": "58368838-5ac5-37a2-98c3-ac6ac8db3dc0"
        },
        {
            "id": 9,
            "name": "Prof. Isadore Baumbach",
            "description": "Quibusdam nam impedit ut sit quidem.",
            "lapse": 10,
            "modules": "string_cambiar",
            "units": 10,
            "number_active_sessions": 2,
            "uuid": "030da163-7982-3342-957e-55b4228dbc4a"
        },
        {
            "id": 10,
            "name": "Ms. Jane Hermiston Sr.",
            "description": "Autem adipisci et omnis aperiam cumque iusto.",
            "lapse": 10,
            "modules": "string_cambiar",
            "units": 10,
            "number_active_sessions": 10,
            "uuid": "1338f308-8953-3aa5-abfa-04e78c6be5f4"
        },
        {
            "id": 11,
            "name": "Adella Labadie DDS",
            "description": "Nemo ipsa maiores id illo.",
            "lapse": 10,
            "modules": "string_cambiar",
            "units": 10,
            "number_active_sessions": 10,
            "uuid": "ed58af71-66fd-3bc2-8e6b-0d82f4ef6037"
        },
        {
            "id": 12,
            "name": "Adella Labadie DDS",
            "description": "Nemo ipsa maiores id illo.",
            "lapse": 10,
            "modules": "string_cambiar",
            "units": 10,
            "number_active_sessions": 10,
            "uuid": "ed58af71-66fd-3bc2-8e6b-0d82f4ef6037"
        },
        {
            "id": 13,
            "name": "Adella Labadie DDS",
            "description": "Nemo ipsa maiores id illo.",
            "lapse": 10,
            "modules": "string_cambiar",
            "units": 10,
            "number_active_sessions": 10,
            "uuid": "ed58af71-66fd-3bc2-8e6b-0d82f4ef6037"
        },
        {
            "id": 14,
            "name": "Adella Labadie DDS",
            "description": "Nemo ipsa maiores id illo.",
            "lapse": 10,
            "modules": "string_cambiar",
            "units": 10,
            "number_active_sessions": 10,
            "uuid": "ed58af71-66fd-3bc2-8e6b-0d82f4ef6037"
        },
        {
            "id": 15,
            "name": "Adella Labadie DDS",
            "description": "Nemo ipsa maiores id illo.",
            "lapse": 10,
            "modules": "string_cambiar",
            "units": 10,
            "number_active_sessions": 10,
            "uuid": "ed58af71-66fd-3bc2-8e6b-0d82f4ef6037"
        }
    ],
    "links": {
        "first": "http:\/\/localhost\/api\/sysadmin\/v1\/licenses?page=1",
        "last": "http:\/\/localhost\/api\/sysadmin\/v1\/licenses?page=2",
        "prev": null,
        "next": "http:\/\/localhost\/api\/sysadmin\/v1\/licenses?page=2"
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 2,
        "path": "http:\/\/localhost\/api\/sysadmin\/v1\/licenses",
        "per_page": 15,
        "to": 15,
        "total": 18
    }
}
```

### HTTP Request
`GET api/sysadmin/v1/licenses`


<!-- END_216b70ae6b951611a7e6cc3852f2c539 -->

<!-- START_f48ff9e97c68425ce1a660173061739e -->
## Store a newly created LICENSE in storage.

> Example request:

```bash
curl -X POST "http://localhost:8000/api/sysadmin/v1/licenses" \
    -H "Accept: application/json" \
    -d "name"="nisi" \
        -d "description"="nisi" \
        -d "lapse"="5184" \
        -d "modules"="nisi" \
        -d "units"="5184" \
        -d "number_active_sessions"="5184" 
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/sysadmin/v1/licenses",
    "method": "POST",
    "data": {
        "name": "nisi",
        "description": "nisi",
        "lapse": 5184,
        "modules": "nisi",
        "units": 5184,
        "number_active_sessions": 5184
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
`POST api/sysadmin/v1/licenses`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    name | string |  required  | 
    description | string |  required  | 
    lapse | integer |  required  | 
    modules | string |  required  | 
    units | integer |  required  | 
    number_active_sessions | integer |  required  | 

<!-- END_f48ff9e97c68425ce1a660173061739e -->

<!-- START_27f50b09b14a244a8401e6792795806e -->
## Display the specified LICENSE.

> Example request:

```bash
curl -X GET -G "http://localhost:8000/api/sysadmin/v1/licenses/{license}" \
    -H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/sysadmin/v1/licenses/{license}",
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
    "data": {
        "id": null,
        "name": null,
        "description": null,
        "lapse": null,
        "modules": null,
        "units": null,
        "number_active_sessions": null,
        "uuid": null,
        "accounts": []
    }
}
```

### HTTP Request
`GET api/sysadmin/v1/licenses/{license}`


<!-- END_27f50b09b14a244a8401e6792795806e -->

<!-- START_d4bebbd83a3e2c56a655d375397dfc00 -->
## Remove the specified LICENSE from storage.

> Example request:

```bash
curl -X DELETE "http://localhost:8000/api/sysadmin/v1/licenses/{license}" \
    -H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/sysadmin/v1/licenses/{license}",
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
`DELETE api/sysadmin/v1/licenses/{license}`


<!-- END_d4bebbd83a3e2c56a655d375397dfc00 -->

#general
<!-- START_7084e053f4b927ae0c7ffc5867badb3f -->
## Authorize a client to access the user&#039;s account.

> Example request:

```bash
curl -X POST "http://localhost:8000/api/sysadmin/v1/oauth/token" \
    -H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/sysadmin/v1/oauth/token",
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
`POST api/sysadmin/v1/oauth/token`


<!-- END_7084e053f4b927ae0c7ffc5867badb3f -->

<!-- START_84148dfb768a9ebe61fe354c57e5340d -->
## Get all of the authorized tokens for the authenticated user.

> Example request:

```bash
curl -X GET -G "http://localhost:8000/api/sysadmin/v1/oauth/tokens" \
    -H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/sysadmin/v1/oauth/tokens",
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
[]
```

### HTTP Request
`GET api/sysadmin/v1/oauth/tokens`


<!-- END_84148dfb768a9ebe61fe354c57e5340d -->

<!-- START_5e89993ecd7409018cca8183e9f35f7f -->
## Delete the given token.

> Example request:

```bash
curl -X DELETE "http://localhost:8000/api/sysadmin/v1/oauth/tokens/{token_id}" \
    -H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/sysadmin/v1/oauth/tokens/{token_id}",
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
`DELETE api/sysadmin/v1/oauth/tokens/{token_id}`


<!-- END_5e89993ecd7409018cca8183e9f35f7f -->

<!-- START_0e2df59d65a129ac24ebe1f231165aff -->
## api/sysadmin/v1/login

> Example request:

```bash
curl -X POST "http://localhost:8000/api/sysadmin/v1/login" \
    -H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/sysadmin/v1/login",
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
`POST api/sysadmin/v1/login`


<!-- END_0e2df59d65a129ac24ebe1f231165aff -->


