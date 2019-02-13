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
            "id": 14,
            "easyname": "et",
            "uuid": "e109dbfb-50dd-3f69-a5c4-c7917c5072d1"
        },
        {
            "id": 17,
            "easyname": "aut",
            "uuid": "feac6223-2b5e-3079-b8c5-177610df4998"
        },
        {
            "id": 18,
            "easyname": "odio",
            "uuid": "5c36177d-5039-3b73-80d8-51e3d978ef61"
        },
        {
            "id": 20,
            "easyname": "ut",
            "uuid": "078f4b3c-ffde-34c5-902b-4e06560fbd4e"
        },
        {
            "id": 27,
            "easyname": "accusantium",
            "uuid": "1e6d8398-5989-31fd-bbb4-d80f44b882e2"
        },
        {
            "id": 34,
            "easyname": "ea",
            "uuid": "dfbd334e-17c5-3757-907c-c34b0abf8847"
        },
        {
            "id": 36,
            "easyname": "vel",
            "uuid": "ecd20fed-2156-3f57-b480-6efedd09d6da"
        },
        {
            "id": 37,
            "easyname": "ut",
            "uuid": "6bd0487a-417e-3b7a-a4b7-e10a449b4fa3"
        },
        {
            "id": 38,
            "easyname": "neque",
            "uuid": "9cde5099-1791-374e-9f6c-10b586a622e4"
        },
        {
            "id": 40,
            "easyname": "esse",
            "uuid": "37fef68e-d177-3941-8578-5b6fb05cf490"
        },
        {
            "id": 50,
            "easyname": "expedita",
            "uuid": "0ceeba6b-139b-35b1-a6e8-d138388c16c1"
        },
        {
            "id": 52,
            "easyname": "quaerat",
            "uuid": "d7f584ef-cfce-35a2-831a-57cbe54f2faa"
        },
        {
            "id": 53,
            "easyname": "excepturi",
            "uuid": "ccacf521-3ba1-3b69-84eb-e06e71a91430"
        },
        {
            "id": 54,
            "easyname": "quia",
            "uuid": "f1f7c545-3490-3753-8ee4-1cfa2782f8b9"
        },
        {
            "id": 56,
            "easyname": "rerum",
            "uuid": "0447232c-71bb-3eb9-a61a-71c1719ecca5"
        },
        {
            "id": 66,
            "easyname": "unde",
            "uuid": "e37753dc-ba3a-3964-b328-8ac2d0d023b8"
        },
        {
            "id": 68,
            "easyname": "accusamus",
            "uuid": "2eca0bd4-02c8-3373-af09-5affddcdf560"
        },
        {
            "id": 69,
            "easyname": "provident",
            "uuid": "da11adcb-af09-39b2-9d77-d8c3606f4694"
        },
        {
            "id": 70,
            "easyname": "voluptas",
            "uuid": "87a74919-5cd8-333e-81b2-89bde0f18ff0"
        },
        {
            "id": 72,
            "easyname": "aut",
            "uuid": "d36c0a09-8cd3-3678-845b-425441480340"
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
    "data": 75
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
            "name": "Adella Labadie DDS",
            "description": "Nemo ipsa maiores id illo.",
            "lapse": 10,
            "modules": "string_cambiar",
            "units": 10,
            "number_active_sessions": 10,
            "uuid": "ed58af71-66fd-3bc2-8e6b-0d82f4ef6037"
        },
        {
            "name": "Adella Labadie DDS",
            "description": "Nemo ipsa maiores id illo.",
            "lapse": 10,
            "modules": "string_cambiar",
            "units": 10,
            "number_active_sessions": 10,
            "uuid": "ed58af71-66fd-3bc2-8e6b-0d82f4ef6037"
        },
        {
            "name": "Adella Labadie DDS",
            "description": "Nemo ipsa maiores id illo.",
            "lapse": 10,
            "modules": "string_cambiar",
            "units": 10,
            "number_active_sessions": 10,
            "uuid": "ed58af71-66fd-3bc2-8e6b-0d82f4ef6037"
        },
        {
            "name": "Adella Labadie DDS",
            "description": "Nemo ipsa maiores id illo.",
            "lapse": 10,
            "modules": "string_cambiar",
            "units": 10,
            "number_active_sessions": 10,
            "uuid": "ed58af71-66fd-3bc2-8e6b-0d82f4ef6037"
        },
        {
            "name": "Adella Labadie DDS",
            "description": "Nemo ipsa maiores id illo.",
            "lapse": 10,
            "modules": "string_cambiar",
            "units": 10,
            "number_active_sessions": 10,
            "uuid": "ed58af71-66fd-3bc2-8e6b-0d82f4ef6037"
        },
        {
            "name": "Adella Labadie DDS",
            "description": "Nemo ipsa maiores id illo.",
            "lapse": 10,
            "modules": "string_cambiar",
            "units": 10,
            "number_active_sessions": 10,
            "uuid": "ed58af71-66fd-3bc2-8e6b-0d82f4ef6037"
        },
        {
            "name": "Adella Labadie DDS",
            "description": "Nemo ipsa maiores id illo.",
            "lapse": 10,
            "modules": "string_cambiar",
            "units": 10,
            "number_active_sessions": 10,
            "uuid": "ed58af71-66fd-3bc2-8e6b-0d82f4ef6037"
        },
        {
            "name": "Adella Labadie DDS",
            "description": "Nemo ipsa maiores id illo.",
            "lapse": 10,
            "modules": "string_cambiar",
            "units": 10,
            "number_active_sessions": 10,
            "uuid": "ed58af71-66fd-3bc2-8e6b-0d82f4ef6037"
        },
        {
            "name": "Adella Labadie DDS",
            "description": "Nemo ipsa maiores id illo.",
            "lapse": 10,
            "modules": "string_cambiar",
            "units": 10,
            "number_active_sessions": 10,
            "uuid": "ed58af71-66fd-3bc2-8e6b-0d82f4ef6037"
        },
        {
            "name": "Adella Labadie DDS",
            "description": "Nemo ipsa maiores id illo.",
            "lapse": 10,
            "modules": "string_cambiar",
            "units": 10,
            "number_active_sessions": 10,
            "uuid": "ed58af71-66fd-3bc2-8e6b-0d82f4ef6037"
        },
        {
            "name": "Dillon Powlowski I",
            "description": "Aut magni et explicabo sed dolorum.",
            "lapse": 30,
            "modules": "string_cambiar",
            "units": 10,
            "number_active_sessions": 10,
            "uuid": "107696bd-d999-3052-ade1-424c1ef72170"
        },
        {
            "name": "Junius Beahan",
            "description": "Maiores culpa velit nihil.",
            "lapse": 3,
            "modules": "string_cambiar",
            "units": 10,
            "number_active_sessions": 10,
            "uuid": "a3028808-d08a-3764-ad2d-8f95b93ea468"
        },
        {
            "name": "Prof. Chelsey Stehr I",
            "description": "Sed illo et at eum maxime.",
            "lapse": 30,
            "modules": "string_cambiar",
            "units": 10,
            "number_active_sessions": 10,
            "uuid": "82eb8ba6-9eb6-3df2-9090-5f329f1d2aae"
        },
        {
            "name": "personalizado",
            "description": "textotextotext",
            "lapse": 32,
            "modules": "monitoring",
            "units": 265,
            "number_active_sessions": 32,
            "uuid": "c75a3f0c-27c9-4cfc-a5be-b23eafa2c073"
        },
        {
            "name": "Ms. Angela McGlynn",
            "description": "Iure reiciendis odio laudantium numquam officia.",
            "lapse": 10,
            "modules": "string_cambiar",
            "units": 10,
            "number_active_sessions": 10,
            "uuid": "be0b8ede-1ca8-3bff-b30c-6f9ad805b484"
        }
    ],
    "links": {
        "first": "http:\/\/localhost\/api\/sysadmin\/v1\/licenses?page=1",
        "last": "http:\/\/localhost\/api\/sysadmin\/v1\/licenses?page=4",
        "prev": null,
        "next": "http:\/\/localhost\/api\/sysadmin\/v1\/licenses?page=2"
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 4,
        "path": "http:\/\/localhost\/api\/sysadmin\/v1\/licenses",
        "per_page": 15,
        "to": 15,
        "total": 49
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

<!-- START_f0460de1d101294c9f86e99a47302d9b -->
## Show the form for editing the specified LICENSE.

> Example request:

```bash
curl -X GET -G "http://localhost:8000/api/sysadmin/v1/licenses/{license}/edit" \
    -H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/sysadmin/v1/licenses/{license}/edit",
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
null
```

### HTTP Request
`GET api/sysadmin/v1/licenses/{license}/edit`


<!-- END_f0460de1d101294c9f86e99a47302d9b -->

<!-- START_2d1fada20eed91519f7d00ab9fe907e3 -->
## Update the specified LICENSE in storage.

> Example request:

```bash
curl -X PUT "http://localhost:8000/api/sysadmin/v1/licenses/{license}" \
    -H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/sysadmin/v1/licenses/{license}",
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
`PUT api/sysadmin/v1/licenses/{license}`

`PATCH api/sysadmin/v1/licenses/{license}`


<!-- END_2d1fada20eed91519f7d00ab9fe907e3 -->

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


