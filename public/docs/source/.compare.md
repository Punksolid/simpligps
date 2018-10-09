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

#Carrier
<!-- START_ff02557e23520586ff7d6d60adc9193f -->
## Display a listing of the CARRIER.

> Example request:

```bash
curl -X GET "http://localhost:8000/api/v1/carriers" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/v1/carriers",
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
    "data": [],
    "links": {
        "first": "http:\/\/localhost\/api\/v1\/carriers?page=1",
        "last": "http:\/\/localhost\/api\/v1\/carriers?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": null,
        "last_page": 1,
        "path": "http:\/\/localhost\/api\/v1\/carriers",
        "per_page": 15,
        "to": null,
        "total": 0
    }
}
```

### HTTP Request
`GET api/v1/carriers`


<!-- END_ff02557e23520586ff7d6d60adc9193f -->

<!-- START_8ad9a66c44c482a7f0d5ed74d14ec23c -->
## Store a newly created CARRIER in storage.

> Example request:

```bash
curl -X POST "http://localhost:8000/api/v1/carriers" \
-H "Accept: application/json" \
    -d "carrier_name"="vel" \
    -d "contact_name"="vel" \
    -d "phone"="vel" \
    -d "email"="ttoy@example.net" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/v1/carriers",
    "method": "POST",
    "data": {
        "carrier_name": "vel",
        "contact_name": "vel",
        "phone": "vel",
        "email": "ttoy@example.net"
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
`POST api/v1/carriers`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    carrier_name | string |  required  | 
    contact_name | string |  required  | 
    phone | string |  required  | 
    email | email |  required  | 

<!-- END_8ad9a66c44c482a7f0d5ed74d14ec23c -->

<!-- START_6d62b77c02b7659a248b1e46e01e2d03 -->
## Display the specified CARRIER.

> Example request:

```bash
curl -X GET "http://localhost:8000/api/v1/carriers/{carrier}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/v1/carriers/{carrier}",
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
        "carrier_name": null,
        "contact_name": null,
        "phone": null,
        "email": null
    }
}
```

### HTTP Request
`GET api/v1/carriers/{carrier}`


<!-- END_6d62b77c02b7659a248b1e46e01e2d03 -->

<!-- START_7bc0fd1803dbed254651173407808ce0 -->
## Update the specified CARRIER in storage.

> Example request:

```bash
curl -X PUT "http://localhost:8000/api/v1/carriers/{carrier}" \
-H "Accept: application/json" \
    -d "carrier_name"="et" \
    -d "contact_name"="et" \
    -d "phone"="et" \
    -d "email"="kuhn.neal@example.org" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/v1/carriers/{carrier}",
    "method": "PUT",
    "data": {
        "carrier_name": "et",
        "contact_name": "et",
        "phone": "et",
        "email": "kuhn.neal@example.org"
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
`PUT api/v1/carriers/{carrier}`

`PATCH api/v1/carriers/{carrier}`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    carrier_name | string |  required  | 
    contact_name | string |  required  | 
    phone | string |  required  | 
    email | email |  required  | 

<!-- END_7bc0fd1803dbed254651173407808ce0 -->

<!-- START_c0b55814a777617322f4c2fb2f3fda6b -->
## Remove the specified CARRIER from storage.

> Example request:

```bash
curl -X DELETE "http://localhost:8000/api/v1/carriers/{carrier}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/v1/carriers/{carrier}",
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
`DELETE api/v1/carriers/{carrier}`


<!-- END_c0b55814a777617322f4c2fb2f3fda6b -->

#Contacts
<!-- START_0d6153de6a7d78007b7ab7386042fe8c -->
## api/v1/contacts/filter_tags

> Example request:

```bash
curl -X GET "http://localhost:8000/api/v1/contacts/filter_tags" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/v1/contacts/filter_tags",
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
    "data": [],
    "links": {
        "first": "http:\/\/localhost\/api\/v1\/contacts\/filter_tags?page=1",
        "last": "http:\/\/localhost\/api\/v1\/contacts\/filter_tags?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": null,
        "last_page": 1,
        "path": "http:\/\/localhost\/api\/v1\/contacts\/filter_tags",
        "per_page": 15,
        "to": null,
        "total": 0
    }
}
```

### HTTP Request
`GET api/v1/contacts/filter_tags`


<!-- END_0d6153de6a7d78007b7ab7386042fe8c -->

<!-- START_0e3b4b9f97583d7076a299db38e76b09 -->
## api/v1/contacts/{contact}/tags

> Example request:

```bash
curl -X POST "http://localhost:8000/api/v1/contacts/{contact}/tags" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/v1/contacts/{contact}/tags",
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
`POST api/v1/contacts/{contact}/tags`


<!-- END_0e3b4b9f97583d7076a299db38e76b09 -->

<!-- START_2320936f7c7a29fe1b1faf0be6fee8ef -->
## Display a listing of the CONTACT.

> Example request:

```bash
curl -X GET "http://localhost:8000/api/v1/contacts" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/v1/contacts",
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
    "data": [],
    "links": {
        "first": "http:\/\/localhost\/api\/v1\/contacts?page=1",
        "last": "http:\/\/localhost\/api\/v1\/contacts?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": null,
        "last_page": 1,
        "path": "http:\/\/localhost\/api\/v1\/contacts",
        "per_page": 15,
        "to": null,
        "total": 0
    }
}
```

### HTTP Request
`GET api/v1/contacts`


<!-- END_2320936f7c7a29fe1b1faf0be6fee8ef -->

<!-- START_47c2efeaf62c42ca6aab8e676b494b40 -->
## Store a newly created CONTACT in storage.

> Example request:

```bash
curl -X POST "http://localhost:8000/api/v1/contacts" \
-H "Accept: application/json" \
    -d "name"="temporibus" \
    -d "company"="temporibus" \
    -d "phone"="temporibus" \
    -d "email"="temporibus" \
    -d "address"="temporibus" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/v1/contacts",
    "method": "POST",
    "data": {
        "name": "temporibus",
        "company": "temporibus",
        "phone": "temporibus",
        "email": "temporibus",
        "address": "temporibus"
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
`POST api/v1/contacts`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    name | string |  required  | 
    company | string |  required  | 
    phone | string |  required  | 
    email | string |  required  | 
    address | string |  required  | 

<!-- END_47c2efeaf62c42ca6aab8e676b494b40 -->

<!-- START_b77d96849f13e518dd79c7801a8f0854 -->
## Display the specified CONTACT.

> Example request:

```bash
curl -X GET "http://localhost:8000/api/v1/contacts/{contact}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/v1/contacts/{contact}",
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
    "message": "Server Error"
}
```

### HTTP Request
`GET api/v1/contacts/{contact}`


<!-- END_b77d96849f13e518dd79c7801a8f0854 -->

<!-- START_9aec7381d4dd89e68a9ff728678d8b21 -->
## Update the specified CONTACT in storage.

> Example request:

```bash
curl -X PUT "http://localhost:8000/api/v1/contacts/{contact}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/v1/contacts/{contact}",
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
`PUT api/v1/contacts/{contact}`

`PATCH api/v1/contacts/{contact}`


<!-- END_9aec7381d4dd89e68a9ff728678d8b21 -->

<!-- START_6edc54ea34dd384c52c2ab85854ca8a2 -->
## Remove the specified CONTACT from storage.

> Example request:

```bash
curl -X DELETE "http://localhost:8000/api/v1/contacts/{contact}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/v1/contacts/{contact}",
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
`DELETE api/v1/contacts/{contact}`


<!-- END_6edc54ea34dd384c52c2ab85854ca8a2 -->

#Convoy
<!-- START_09a632f36a19e1082534692d0adb222c -->
## Store a newly created convoy in storage.

> Example request:

```bash
curl -X POST "http://localhost:8000/api/v1/trips/convoys" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/v1/trips/convoys",
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
`POST api/v1/trips/convoys`


<!-- END_09a632f36a19e1082534692d0adb222c -->

<!-- START_9887c80e3d829cee3de44efae2776769 -->
## Display a listing of the convoy.

> Example request:

```bash
curl -X GET "http://localhost:8000/api/v1/trips/convoys" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/v1/trips/convoys",
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
`GET api/v1/trips/convoys`


<!-- END_9887c80e3d829cee3de44efae2776769 -->

<!-- START_382abdc909b8b29c80a049d72f982249 -->
## Display the specified convoy.

> Example request:

```bash
curl -X GET "http://localhost:8000/api/v1/trips/convoys/{convoy}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/v1/trips/convoys/{convoy}",
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
    "trips": []
}
```

### HTTP Request
`GET api/v1/trips/convoys/{convoy}`


<!-- END_382abdc909b8b29c80a049d72f982249 -->

#Operadores
<!-- START_7291414742faecdc528180b175f8a4f2 -->
## Muestra listado de operadores.

> Example request:

```bash
curl -X GET "http://localhost:8000/api/v1/operators" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/v1/operators",
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
    "data": [],
    "links": {
        "first": "http:\/\/localhost\/api\/v1\/operators?page=1",
        "last": "http:\/\/localhost\/api\/v1\/operators?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": null,
        "last_page": 1,
        "path": "http:\/\/localhost\/api\/v1\/operators",
        "per_page": 15,
        "to": null,
        "total": 0
    }
}
```

### HTTP Request
`GET api/v1/operators`


<!-- END_7291414742faecdc528180b175f8a4f2 -->

<!-- START_95fd6a5f3a88ed528fb14a433d03323a -->
## Crea nuevo operador

> Example request:

```bash
curl -X POST "http://localhost:8000/api/v1/operators" \
-H "Accept: application/json" \
    -d "name"="doloribus" \
    -d "phone"="doloribus" \
    -d "active"="1" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/v1/operators",
    "method": "POST",
    "data": {
        "name": "doloribus",
        "phone": "doloribus",
        "active": true
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
`POST api/v1/operators`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    name | string |  required  | 
    phone | string |  required  | 
    active | boolean |  optional  | 

<!-- END_95fd6a5f3a88ed528fb14a433d03323a -->

<!-- START_e47a5f3488c3c7dcf021f46fcbb10774 -->
## Muestra detalles de un solo operador

> Example request:

```bash
curl -X GET "http://localhost:8000/api/v1/operators/{operator}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/v1/operators/{operator}",
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
        "phone": null,
        "active": false,
        "carrier": null
    }
}
```

### HTTP Request
`GET api/v1/operators/{operator}`


<!-- END_e47a5f3488c3c7dcf021f46fcbb10774 -->

<!-- START_b43f7c4993d99cc4e54b735d77b0e0e3 -->
## Actualiza operador

> Example request:

```bash
curl -X PUT "http://localhost:8000/api/v1/operators/{operator}" \
-H "Accept: application/json" \
    -d "name"="enim" \
    -d "phone"="enim" \
    -d "active"="1" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/v1/operators/{operator}",
    "method": "PUT",
    "data": {
        "name": "enim",
        "phone": "enim",
        "active": true
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
`PUT api/v1/operators/{operator}`

`PATCH api/v1/operators/{operator}`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    name | string |  required  | 
    phone | string |  required  | 
    active | boolean |  optional  | 

<!-- END_b43f7c4993d99cc4e54b735d77b0e0e3 -->

<!-- START_75ddeff621745b958b40957a970c3392 -->
## Remueve el operador de la base de datos

> Example request:

```bash
curl -X DELETE "http://localhost:8000/api/v1/operators/{operator}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/v1/operators/{operator}",
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
`DELETE api/v1/operators/{operator}`


<!-- END_75ddeff621745b958b40957a970c3392 -->

#Permission
<!-- START_25ea8f1ee2eceb341b680b3c0eb89723 -->
## Actualiza los permisos individuales de un usuario

> Example request:

```bash
curl -X PUT "http://localhost:8000/api/v1/permissions/user_sync/{user}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/v1/permissions/user_sync/{user}",
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

<!-- START_bd2777b2132db6c9cf93e928b5b5e44d -->
## Lista todos los permisos

> Example request:

```bash
curl -X GET "http://localhost:8000/api/v1/permissions" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/v1/permissions",
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


<!-- END_bd2777b2132db6c9cf93e928b5b5e44d -->

#Place
<!-- START_c7d92ec06b3e53377d6bcc2e837cb8df -->
## Display a listing of the PLACE.

> Example request:

```bash
curl -X GET "http://localhost:8000/api/v1/places" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/v1/places",
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
    "data": [],
    "links": {
        "first": "http:\/\/localhost\/api\/v1\/places?page=1",
        "last": "http:\/\/localhost\/api\/v1\/places?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": null,
        "last_page": 1,
        "path": "http:\/\/localhost\/api\/v1\/places",
        "per_page": 15,
        "to": null,
        "total": 0
    }
}
```

### HTTP Request
`GET api/v1/places`


<!-- END_c7d92ec06b3e53377d6bcc2e837cb8df -->

<!-- START_aa8fe37e3631e6d313f6ffcd74278479 -->
## Store a newly created PLACE in storage.

> Example request:

```bash
curl -X POST "http://localhost:8000/api/v1/places" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/v1/places",
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
`POST api/v1/places`


<!-- END_aa8fe37e3631e6d313f6ffcd74278479 -->

<!-- START_0091bf4863a05bf623e8c2ec25173700 -->
## Display the specified PLACE.

> Example request:

```bash
curl -X GET "http://localhost:8000/api/v1/places/{place}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/v1/places/{place}",
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
        "person_in_charge": null,
        "address": null,
        "phone": null
    }
}
```

### HTTP Request
`GET api/v1/places/{place}`


<!-- END_0091bf4863a05bf623e8c2ec25173700 -->

<!-- START_b56be722e336bfc4fa3205bf01342e6a -->
## Update the specified PLACE in storage.

> Example request:

```bash
curl -X PUT "http://localhost:8000/api/v1/places/{place}" \
-H "Accept: application/json" \
    -d "name"="repellat" \
    -d "person_in_charge"="repellat" \
    -d "address"="repellat" \
    -d "phone"="repellat" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/v1/places/{place}",
    "method": "PUT",
    "data": {
        "name": "repellat",
        "person_in_charge": "repellat",
        "address": "repellat",
        "phone": "repellat"
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
`PUT api/v1/places/{place}`

`PATCH api/v1/places/{place}`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    name | string |  required  | 
    person_in_charge | string |  required  | 
    address | string |  required  | 
    phone | string |  required  | 

<!-- END_b56be722e336bfc4fa3205bf01342e6a -->

<!-- START_67089b85994e8be447782521433b1039 -->
## Remove the specified PLACE from storage.

> Example request:

```bash
curl -X DELETE "http://localhost:8000/api/v1/places/{place}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/v1/places/{place}",
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
`DELETE api/v1/places/{place}`


<!-- END_67089b85994e8be447782521433b1039 -->

#Role
<!-- START_953afc9014630b1a7b008b86bde4414e -->
## api/v1/roles/{role}/user

> Example request:

```bash
curl -X POST "http://localhost:8000/api/v1/roles/{role}/user" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/v1/roles/{role}/user",
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

<!-- START_d2f16357cb4ed36dbb0e9529ea4a460c -->
## Display a listing of the Role.

> Example request:

```bash
curl -X GET "http://localhost:8000/api/v1/roles" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/v1/roles",
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
        "guard_name": "api",
        "created_at": "2018-10-06 02:31:08",
        "updated_at": "2018-10-06 02:31:08"
    }
]
```

### HTTP Request
`GET api/v1/roles`


<!-- END_d2f16357cb4ed36dbb0e9529ea4a460c -->

<!-- START_5f753b2bffb6b34b6136ddfe1be7bcce -->
## Store a newly created Role in storage.

> Example request:

```bash
curl -X POST "http://localhost:8000/api/v1/roles" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/v1/roles",
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

<!-- START_ba05db58d706b9f94944b1ab79e1e4a2 -->
## Display the specified Role.

> Example request:

```bash
curl -X GET "http://localhost:8000/api/v1/roles/{role}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/v1/roles/{role}",
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


<!-- END_ba05db58d706b9f94944b1ab79e1e4a2 -->

<!-- START_81ac9047f8db2b92092c5a7f13e5d28d -->
## Update the specified Role in storage.

> Example request:

```bash
curl -X PUT "http://localhost:8000/api/v1/roles/{role}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/v1/roles/{role}",
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
curl -X DELETE "http://localhost:8000/api/v1/roles/{role}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/v1/roles/{role}",
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

#Trips
<!-- START_91973ca96008e504988ff054eace4d66 -->
## Subir archivo excel

> Example request:

```bash
curl -X POST "http://localhost:8000/api/v1/trips/upload" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/v1/trips/upload",
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

<!-- START_890e8e498f12df4da26399eee0c714d2 -->
## api/v1/trips/{trip}/tags

> Example request:

```bash
curl -X POST "http://localhost:8000/api/v1/trips/{trip}/tags" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/v1/trips/{trip}/tags",
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
`POST api/v1/trips/{trip}/tags`


<!-- END_890e8e498f12df4da26399eee0c714d2 -->

<!-- START_d66bfa06c97a85690dc42e1de00c579e -->
## filtra viajes por etiquetas

> Example request:

```bash
curl -X POST "http://localhost:8000/api/v1/trips/filtered_with_tags" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/v1/trips/filtered_with_tags",
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
`POST api/v1/trips/filtered_with_tags`


<!-- END_d66bfa06c97a85690dc42e1de00c579e -->

<!-- START_570339c57cdc597f02d545467c67f7a8 -->
## Lista todos los viajes sin filtros

> Example request:

```bash
curl -X GET "http://localhost:8000/api/v1/trips" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/v1/trips",
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
    "data": [],
    "links": {
        "first": "http:\/\/localhost\/api\/v1\/trips?page=1",
        "last": "http:\/\/localhost\/api\/v1\/trips?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": null,
        "last_page": 1,
        "path": "http:\/\/localhost\/api\/v1\/trips",
        "per_page": 15,
        "to": null,
        "total": 0
    }
}
```

### HTTP Request
`GET api/v1/trips`


<!-- END_570339c57cdc597f02d545467c67f7a8 -->

<!-- START_b0bfe967e103764914eff25d075c572c -->
## Creación de nuevo viaje

> Example request:

```bash
curl -X POST "http://localhost:8000/api/v1/trips" \
-H "Accept: application/json" \
    -d "rp"="provident" \
    -d "invoice"="provident" \
    -d "client"="provident" \
    -d "origin"="provident" \
    -d "destination"="provident" \
    -d "mon_type"="provident" \
    -d "line"="provident" \
    -d "scheduled_load"="1995-11-19" \
    -d "scheduled_departure"="Monday, 20-Nov-95 00:00:00 UTC" \
    -d "scheduled_arrival"="Tuesday, 21-Nov-95 00:00:00 UTC" \
    -d "scheduled_unload"="Wednesday, 22-Nov-95 00:00:00 UTC" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/v1/trips",
    "method": "POST",
    "data": {
        "rp": "provident",
        "invoice": "provident",
        "client": "provident",
        "origin": "provident",
        "destination": "provident",
        "mon_type": "provident",
        "line": "provident",
        "scheduled_load": "1995-11-19",
        "scheduled_departure": "Monday, 20-Nov-95 00:00:00 UTC",
        "scheduled_arrival": "Tuesday, 21-Nov-95 00:00:00 UTC",
        "scheduled_unload": "Wednesday, 22-Nov-95 00:00:00 UTC"
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
    scheduled_departure | date |  required  | Must be a date after: `scheduled_load`
    scheduled_arrival | date |  required  | Must be a date after: `scheduled_departure`
    scheduled_unload | date |  required  | Must be a date after: `scheduled_arrival`

<!-- END_b0bfe967e103764914eff25d075c572c -->

<!-- START_18a55de27e6b4e429ded5fdedbab7cf4 -->
## Editar viaje

> Example request:

```bash
curl -X PUT "http://localhost:8000/api/v1/trips/{trip}" \
-H "Accept: application/json" \
    -d "rp"="commodi" \
    -d "invoice"="commodi" \
    -d "client"="commodi" \
    -d "origin"="commodi" \
    -d "destination"="commodi" \
    -d "mon_type"="commodi" \
    -d "line"="commodi" \
    -d "scheduled_load"="1987-09-19" \
    -d "scheduled_departure"="Sunday, 20-Sep-87 00:00:00 UTC" \
    -d "scheduled_arrival"="Monday, 21-Sep-87 00:00:00 UTC" \
    -d "scheduled_unload"="Tuesday, 22-Sep-87 00:00:00 UTC" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/v1/trips/{trip}",
    "method": "PUT",
    "data": {
        "rp": "commodi",
        "invoice": "commodi",
        "client": "commodi",
        "origin": "commodi",
        "destination": "commodi",
        "mon_type": "commodi",
        "line": "commodi",
        "scheduled_load": "1987-09-19",
        "scheduled_departure": "Sunday, 20-Sep-87 00:00:00 UTC",
        "scheduled_arrival": "Monday, 21-Sep-87 00:00:00 UTC",
        "scheduled_unload": "Tuesday, 22-Sep-87 00:00:00 UTC"
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
    scheduled_departure | date |  required  | Must be a date after: `scheduled_load`
    scheduled_arrival | date |  required  | Must be a date after: `scheduled_departure`
    scheduled_unload | date |  required  | Must be a date after: `scheduled_arrival`

<!-- END_18a55de27e6b4e429ded5fdedbab7cf4 -->

<!-- START_819b84a295a6859066bc63328b8e8eff -->
## Remove the specified resource from storage.

> Example request:

```bash
curl -X DELETE "http://localhost:8000/api/v1/trips/{trip}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/v1/trips/{trip}",
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

#User
<!-- START_9b9936e5bc62f136bc41e777ce4ee24a -->
## api/v1/password/change

> Example request:

```bash
curl -X POST "http://localhost:8000/api/v1/password/change" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/v1/password/change",
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

<!-- START_1aff981da377ba9a1bbc56ff8efaec0d -->
## Display a listing of the resource.

> Example request:

```bash
curl -X GET "http://localhost:8000/api/v1/users" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/v1/users",
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
            "name": "Mr. Kellen Rogahn",
            "lastname": "default",
            "email": "etray18@example.com",
            "username": "defaultx"
        },
        {
            "name": "Mikel Cole",
            "lastname": "default",
            "email": "expeditaortiz.alan@example.com",
            "username": "defaultx"
        },
        {
            "name": "Dr. Kameron Stoltenberg DDS",
            "lastname": "default",
            "email": "suntdpurdy@example.org",
            "username": "defaultx"
        }
    ],
    "links": {
        "first": "http:\/\/localhost\/api\/v1\/users?page=1",
        "last": "http:\/\/localhost\/api\/v1\/users?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 1,
        "path": "http:\/\/localhost\/api\/v1\/users",
        "per_page": 15,
        "to": 3,
        "total": 3
    }
}
```

### HTTP Request
`GET api/v1/users`


<!-- END_1aff981da377ba9a1bbc56ff8efaec0d -->

<!-- START_4194ceb9a20b7f80b61d14d44df366b4 -->
## Store a newly created resource in storage.

> Example request:

```bash
curl -X POST "http://localhost:8000/api/v1/users" \
-H "Accept: application/json" \
    -d "name"="eligendi" \
    -d "email"="lenore05@example.org" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/v1/users",
    "method": "POST",
    "data": {
        "name": "eligendi",
        "email": "lenore05@example.org"
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
`POST api/v1/users`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    name | string |  required  | 
    email | email |  required  | 

<!-- END_4194ceb9a20b7f80b61d14d44df366b4 -->

#general
<!-- START_489208ef982629b16bc08aa39afec69b -->
## Display Swagger API page.

> Example request:

```bash
curl -X GET "http://localhost:8000/api/v1/documentation" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/v1/documentation",
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
`GET api/v1/documentation`


<!-- END_489208ef982629b16bc08aa39afec69b -->

<!-- START_8c0e48cd8efa861b308fc45872ff0837 -->
## Login user and create token

Recibe 'email', 'password'

> Example request:

```bash
curl -X POST "http://localhost:8000/api/v1/login" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/v1/login",
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
curl -X POST "http://localhost:8000/api/v1/password/send_email" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/v1/password/send_email",
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

<!-- START_d58be746f29144cb8a66c4e189fcb1e1 -->
## Logged user information

> Example request:

```bash
curl -X GET "http://localhost:8000/api/v1/me" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/v1/me",
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
        "name": "Mr. Kellen Rogahn",
        "lastname": "default",
        "email": "etray18@example.com",
        "username": "defaultx"
    }
}
```

### HTTP Request
`GET api/v1/me`


<!-- END_d58be746f29144cb8a66c4e189fcb1e1 -->

<!-- START_e96c6711c1ea3212afa6af75fb23e97c -->
## Display a listing of the Devices.

> Example request:

```bash
curl -X GET "http://localhost:8000/api/v1/devices" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/v1/devices",
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
    "data": [],
    "links": {
        "first": "http:\/\/localhost\/api\/v1\/devices?page=1",
        "last": "http:\/\/localhost\/api\/v1\/devices?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": null,
        "last_page": 1,
        "path": "http:\/\/localhost\/api\/v1\/devices",
        "per_page": 15,
        "to": null,
        "total": 0
    }
}
```

### HTTP Request
`GET api/v1/devices`


<!-- END_e96c6711c1ea3212afa6af75fb23e97c -->

<!-- START_7a1aac2c6fcc438f99fca121eaf1482f -->
## Registra un dispositivo

> Example request:

```bash
curl -X POST "http://localhost:8000/api/v1/devices" \
-H "Accept: application/json" \
    -d "gps"="possimus" \
    -d "plate"="possimus" \
    -d "internal_number"="possimus" \
    -d "carrier_id"="possimus" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/v1/devices",
    "method": "POST",
    "data": {
        "gps": "possimus",
        "plate": "possimus",
        "internal_number": "possimus",
        "carrier_id": "possimus"
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
`POST api/v1/devices`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    gps | string |  required  | 
    plate | string |  required  | 
    internal_number | string |  required  | 
    carrier_id | string |  required  | 

<!-- END_7a1aac2c6fcc438f99fca121eaf1482f -->

<!-- START_de594462518048915d7eebd8e8db8461 -->
## api/v1/devices/{device}

> Example request:

```bash
curl -X GET "http://localhost:8000/api/v1/devices/{device}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/v1/devices/{device}",
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
        "gps": null,
        "plate": null,
        "internal_number": null,
        "carrier_id": null,
        "trips": []
    }
}
```

### HTTP Request
`GET api/v1/devices/{device}`


<!-- END_de594462518048915d7eebd8e8db8461 -->

<!-- START_5d5a9366cfc65b7bd2b7ba60028f55d7 -->
## Actualiza los datos del dispositivo

> Example request:

```bash
curl -X PUT "http://localhost:8000/api/v1/devices/{device}" \
-H "Accept: application/json" \
    -d "gps"="sit" \
    -d "plate"="sit" \
    -d "internal_number"="sit" \
    -d "carrier_id"="sit" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/v1/devices/{device}",
    "method": "PUT",
    "data": {
        "gps": "sit",
        "plate": "sit",
        "internal_number": "sit",
        "carrier_id": "sit"
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
`PUT api/v1/devices/{device}`

`PATCH api/v1/devices/{device}`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    gps | string |  required  | 
    plate | string |  required  | 
    internal_number | string |  required  | 
    carrier_id | string |  required  | 

<!-- END_5d5a9366cfc65b7bd2b7ba60028f55d7 -->

<!-- START_4aea3d79dac837eacb615d2d562d2d37 -->
## Remove the specified DEVICE from storage.

> Example request:

```bash
curl -X DELETE "http://localhost:8000/api/v1/devices/{device}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/v1/devices/{device}",
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
`DELETE api/v1/devices/{device}`


<!-- END_4aea3d79dac837eacb615d2d562d2d37 -->

<!-- START_d1c7efa5cc37e2aeb63e23e088517a7b -->
## Display a listing of the resource.

> Example request:

```bash
curl -X GET "http://localhost:8000/api/v1/trips/{trip}/traces" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/v1/trips/{trip}/traces",
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
    "data": []
}
```

### HTTP Request
`GET api/v1/trips/{trip}/traces`


<!-- END_d1c7efa5cc37e2aeb63e23e088517a7b -->

<!-- START_4cbb5ab195bfb9ace50987eb77af84b4 -->
## Store a newly created resource in storage.

> Example request:

```bash
curl -X POST "http://localhost:8000/api/v1/trips/{trip}/traces" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/v1/trips/{trip}/traces",
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
`POST api/v1/trips/{trip}/traces`


<!-- END_4cbb5ab195bfb9ace50987eb77af84b4 -->

<!-- START_b6deeb81fd9eaec04a64059c6f25d063 -->
## Envía a todos los usuarios el mensaje de notification

> Example request:

```bash
curl -X GET "http://localhost:8000/api/v1/notification_activate/{notification_type}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/v1/notification_activate/{notification_type}",
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
`GET api/v1/notification_activate/{notification_type}`


<!-- END_b6deeb81fd9eaec04a64059c6f25d063 -->

<!-- START_4c45abee95007536b3e9595b31ff1018 -->
## Store a newly created resource in storage.

> Example request:

```bash
curl -X POST "http://localhost:8000/api/v1/notification_types" \
-H "Accept: application/json" \
    -d "alias"="et" \
    -d "deactivation_mode"="et" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/v1/notification_types",
    "method": "POST",
    "data": {
        "alias": "et",
        "deactivation_mode": "et"
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
`POST api/v1/notification_types`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    alias | string |  required  | 
    deactivation_mode | string |  required  | 

<!-- END_4c45abee95007536b3e9595b31ff1018 -->

<!-- START_e6410ff1e0eba053a1fb3514dd830f43 -->
## Actualizar Tipo de Notificacion

> Example request:

```bash
curl -X PUT "http://localhost:8000/api/v1/notification_types/{notification_type}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/v1/notification_types/{notification_type}",
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
`PUT api/v1/notification_types/{notification_type}`

`PATCH api/v1/notification_types/{notification_type}`


<!-- END_e6410ff1e0eba053a1fb3514dd830f43 -->

<!-- START_a04c46a9f2324d91b7d30b10526164be -->
## api/v1/units

> Example request:

```bash
curl -X GET "http://localhost:8000/api/v1/units" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/v1/units",
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
            "name": "PTS001",
            "id": 17471245,
            "measure_units": 0,
            "position": {
                "lat": 24.804986,
                "lon": -107.437411
            }
        },
        {
            "name": "PTS002",
            "id": 17471271,
            "measure_units": 0,
            "position": {
                "lat": 24.801538,
                "lon": -107.428158
            }
        },
        {
            "name": "PTS003",
            "id": 17471332,
            "measure_units": 0,
            "position": {
                "lat": 24.8098031781,
                "lon": -107.39387445
            }
        },
        {
            "name": "PTS004",
            "id": 17471392,
            "measure_units": 0,
            "position": {
                "lat": 24.80492,
                "lon": -107.437514
            }
        },
        {
            "name": "PTS005",
            "id": 17471421,
            "measure_units": 0,
            "position": {
                "lat": 24.8098192228,
                "lon": -107.393836512
            }
        }
    ]
}
```

### HTTP Request
`GET api/v1/units`


<!-- END_a04c46a9f2324d91b7d30b10526164be -->

<!-- START_2784cc932141defd94d1f43c872ca40c -->
## api/v1/units/with_localization

> Example request:

```bash
curl -X GET "http://localhost:8000/api/v1/units/with_localization" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/v1/units/with_localization",
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
            "name": "PTS001",
            "id": 17471245,
            "measure_units": 0,
            "position": {
                "lat": 24.804986,
                "lon": -107.437411
            }
        },
        {
            "name": "PTS002",
            "id": 17471271,
            "measure_units": 0,
            "position": {
                "lat": 24.801538,
                "lon": -107.428158
            }
        },
        {
            "name": "PTS003",
            "id": 17471332,
            "measure_units": 0,
            "position": {
                "lat": 24.8098031781,
                "lon": -107.39387445
            }
        },
        {
            "name": "PTS004",
            "id": 17471392,
            "measure_units": 0,
            "position": {
                "lat": 24.80492,
                "lon": -107.437514
            }
        },
        {
            "name": "PTS005",
            "id": 17471421,
            "measure_units": 0,
            "position": {
                "lat": 24.8098192228,
                "lon": -107.393836512
            }
        }
    ]
}
```

### HTTP Request
`GET api/v1/units/with_localization`


<!-- END_2784cc932141defd94d1f43c872ca40c -->

<!-- START_934ea5b44f90f194fb9f4d54b0b677c7 -->
## api/v1/external/devices/{device}/localization

> Example request:

```bash
curl -X POST "http://localhost:8000/api/v1/external/devices/{device}/localization" \
-H "Accept: application/json" \
    -d "lat"="quis" \
    -d "lon"="quis" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/v1/external/devices/{device}/localization",
    "method": "POST",
    "data": {
        "lat": "quis",
        "lon": "quis"
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
`POST api/v1/external/devices/{device}/localization`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    lat | string |  required  | 
    lon | string |  required  | 

<!-- END_934ea5b44f90f194fb9f4d54b0b677c7 -->

<!-- START_fbeb29d7338ed93eb78108a0db2385bb -->
## api/v1/external/devices

> Example request:

```bash
curl -X POST "http://localhost:8000/api/v1/external/devices" \
-H "Accept: application/json" \
    -d "gps"="dolores" \
    -d "plate"="dolores" \
    -d "internal_number"="dolores" \
    -d "carrier_id"="dolores" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/v1/external/devices",
    "method": "POST",
    "data": {
        "gps": "dolores",
        "plate": "dolores",
        "internal_number": "dolores",
        "carrier_id": "dolores"
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
`POST api/v1/external/devices`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    gps | string |  required  | 
    plate | string |  required  | 
    internal_number | string |  required  | 
    carrier_id | string |  required  | 

<!-- END_fbeb29d7338ed93eb78108a0db2385bb -->

<!-- START_72f1767d39f5b5d6ca87803df7e6105a -->
## Lista dispositivos, api para uso externo

> Example request:

```bash
curl -X GET "http://localhost:8000/api/v1/external/devices" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/v1/external/devices",
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
    "data": [],
    "links": {
        "first": "http:\/\/localhost\/api\/v1\/external\/devices?page=1",
        "last": "http:\/\/localhost\/api\/v1\/external\/devices?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": null,
        "last_page": 1,
        "path": "http:\/\/localhost\/api\/v1\/external\/devices",
        "per_page": 15,
        "to": null,
        "total": 0
    }
}
```

### HTTP Request
`GET api/v1/external/devices`


<!-- END_72f1767d39f5b5d6ca87803df7e6105a -->

