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
    "data": {
        "name": null,
        "company": null,
        "phone": null,
        "email": null,
        "address": null
    }
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
    "data": [
        {
            "name": "Minerva Hoeger",
            "person_in_charge": "Mr. Andrew Larkin",
            "address": "973 Agnes Hills\nSouth Terrance, MT 40715-2744",
            "phone": "1-574-703-8066"
        },
        {
            "name": "Morgan Simonis",
            "person_in_charge": "Joannie Crooks Jr.",
            "address": "43042 Domenic Burg Suite 384\nNovaton, NC 53647",
            "phone": "983.736.5917"
        },
        {
            "name": "Jairo Crist",
            "person_in_charge": "Norma Luettgen",
            "address": "8502 Mikel Glen\nSchambergerview, MT 01698-0935",
            "phone": "979-747-6440"
        },
        {
            "name": "Dr. Emma Jenkins",
            "person_in_charge": "Malinda Schimmel",
            "address": "867 Jacobson Mountain Suite 122\nWest Oswaldburgh, DC 33261-7444",
            "phone": "798.297.4473"
        },
        {
            "name": "Jamar Rowe",
            "person_in_charge": "Miss Jennyfer Hand II",
            "address": "848 Fiona Hill\nWest Micah, AZ 09485-0681",
            "phone": "(625) 984-3730 x29609"
        },
        {
            "name": "Daniela Hoeger",
            "person_in_charge": "Miss Earnestine Grant",
            "address": "3216 Chester Grove\nElistad, VT 67565",
            "phone": "470.859.2492 x591"
        },
        {
            "name": "Magali Nienow",
            "person_in_charge": "Caleigh Shields",
            "address": "8109 Melody Mountains\nNorth Alycia, MD 36726-6808",
            "phone": "201-380-5963"
        },
        {
            "name": "Dr. Oceane Ullrich",
            "person_in_charge": "Stefan Kub",
            "address": "571 Smitham Lodge Suite 817\nEast Violaside, LA 19302",
            "phone": "(430) 823-4379 x89177"
        },
        {
            "name": "Ms. Rosalinda Krajcik Jr.",
            "person_in_charge": "Ms. Fleta McLaughlin Sr.",
            "address": "4697 Teresa Ridge Suite 403\nKennedytown, NV 54252-2539",
            "phone": "+1 (715) 801-1044"
        },
        {
            "name": "Jay DuBuque",
            "person_in_charge": "Mr. Eldred Maggio IV",
            "address": "851 Skiles Overpass Apt. 407\nNienowburgh, NJ 96306",
            "phone": "(549) 865-9953"
        },
        {
            "name": "Krystal Strosin V",
            "person_in_charge": "Hal Legros",
            "address": "6083 Kiera Inlet\nLake Jeffry, WA 12569-0345",
            "phone": "472-352-7882 x3437"
        },
        {
            "name": "Leanne Pagac",
            "person_in_charge": "Maida Sawayn",
            "address": "78237 Swift Union Apt. 478\nEast Nikoburgh, SD 28890-5981",
            "phone": "538.824.4510 x149"
        },
        {
            "name": "Erin Quitzon",
            "person_in_charge": "Dr. Leland Roberts",
            "address": "5106 Altenwerth Roads\nNorth Jacklynville, IA 32673",
            "phone": "+1.359.763.0371"
        },
        {
            "name": "Danika Hahn",
            "person_in_charge": "Isadore Sanford",
            "address": "3167 O'Hara Mill Suite 210\nPort Clairstad, LA 32091-7199",
            "phone": "(297) 793-4648 x74614"
        },
        {
            "name": "Ressie Larkin IV",
            "person_in_charge": "Madisyn Tremblay I",
            "address": "92245 Merlin Land Suite 162\nNew Kyra, MS 42117-3577",
            "phone": "1-829-619-7090"
        }
    ],
    "links": {
        "first": "http:\/\/localhost\/api\/v1\/places?page=1",
        "last": "http:\/\/localhost\/api\/v1\/places?page=2",
        "prev": null,
        "next": "http:\/\/localhost\/api\/v1\/places?page=2"
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 2,
        "path": "http:\/\/localhost\/api\/v1\/places",
        "per_page": 15,
        "to": 15,
        "total": 18
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
        "guard_name": "web",
        "created_at": "2018-09-15 03:45:56",
        "updated_at": "2018-09-15 03:45:56"
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
    "data": [
        {
            "id": 1,
            "rp": "Jarred Casper",
            "invoice": "50872",
            "client": "Berge-White",
            "intermediary": "Kihn, Ebert and Ferry",
            "origin_id": "1",
            "destination_id": "2",
            "mon_type": "3",
            "line": "Nienow Group",
            "scheduled_load": {
                "date": "1994-09-19 19:17:29.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "scheduled_departure": {
                "date": "2014-10-01 19:32:49.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "scheduled_arrival": {
                "date": "1993-05-10 23:59:31.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "scheduled_unload": {
                "date": "2009-08-26 15:46:59.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "bulk": null,
            "tag": null,
            "device_id": null,
            "convoy_id": null
        },
        {
            "id": 2,
            "rp": "Eli Goyette",
            "invoice": "62272",
            "client": "Bartell-Hyatt",
            "intermediary": "Breitenberg-Mosciski",
            "origin_id": "3",
            "destination_id": "4",
            "mon_type": "9",
            "line": "Yundt and Sons",
            "scheduled_load": {
                "date": "1990-08-20 19:26:18.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "scheduled_departure": {
                "date": "2005-06-04 09:21:09.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "scheduled_arrival": {
                "date": "1998-01-19 02:24:25.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "scheduled_unload": {
                "date": "1978-11-09 10:46:37.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "bulk": null,
            "tag": "riesgo",
            "device_id": null,
            "convoy_id": null
        },
        {
            "id": 3,
            "rp": "Dr. Lenora VonRueden DVM",
            "invoice": "48026",
            "client": "VonRueden, Turcotte and Treutel",
            "intermediary": "Prosacco, Turcotte and Lockman",
            "origin_id": "5",
            "destination_id": "6",
            "mon_type": "6",
            "line": "Cronin Inc",
            "scheduled_load": {
                "date": "1994-09-12 05:57:54.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "scheduled_departure": {
                "date": "2015-12-18 15:03:20.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "scheduled_arrival": {
                "date": "1979-01-06 05:29:58.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "scheduled_unload": {
                "date": "1981-09-15 11:40:13.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "bulk": null,
            "tag": "riesgo",
            "device_id": null,
            "convoy_id": null
        },
        {
            "id": 4,
            "rp": null,
            "invoice": null,
            "client": null,
            "intermediary": null,
            "origin_id": null,
            "destination_id": null,
            "mon_type": null,
            "line": null,
            "scheduled_load": null,
            "scheduled_departure": null,
            "scheduled_arrival": null,
            "scheduled_unload": null,
            "bulk": {
                "rp": "Gage Lang",
                "invoice": 26407,
                "client": "Beer Group",
                "intermediary": "Sawayn Group",
                "origin": "958 Carlo Throughway Suite 517\nEmiliomouth, GA 29192-1849",
                "destination": "551 Braun Circles\nCollinville, VT 05774-2397",
                "mon_type": 8,
                "line": "Wolf, Mayer and Emmerich",
                "scheduled_load": "2018-09-19 09:20:45",
                "scheduled_departure": "2018-09-19 09:20:45",
                "scheduled_arrival": "2018-09-21 09:20:45",
                "scheduled_unload": "2018-09-22 09:20:45"
            },
            "tag": null,
            "device_id": null,
            "convoy_id": null
        },
        {
            "id": 5,
            "rp": null,
            "invoice": null,
            "client": null,
            "intermediary": null,
            "origin_id": null,
            "destination_id": null,
            "mon_type": null,
            "line": null,
            "scheduled_load": null,
            "scheduled_departure": null,
            "scheduled_arrival": null,
            "scheduled_unload": null,
            "bulk": {
                "rp": "Ramona Cole",
                "invoice": 29218,
                "client": "Corkery, Crona and Lowe",
                "intermediary": "Schuppe PLC",
                "origin": "68247 Nienow Groves\nChristianstad, AK 23534",
                "destination": "826 Gerhold Pass Suite 625\nNew Alex, AZ 96039-3554",
                "mon_type": 4,
                "line": "Schneider, Raynor and Smitham",
                "scheduled_load": "2018-09-19 09:21:02",
                "scheduled_departure": "2018-09-19 09:21:02",
                "scheduled_arrival": "2018-09-21 09:21:02",
                "scheduled_unload": "2018-09-22 09:21:02"
            },
            "tag": null,
            "device_id": null,
            "convoy_id": null
        },
        {
            "id": 6,
            "rp": null,
            "invoice": null,
            "client": null,
            "intermediary": null,
            "origin_id": null,
            "destination_id": null,
            "mon_type": null,
            "line": null,
            "scheduled_load": null,
            "scheduled_departure": null,
            "scheduled_arrival": null,
            "scheduled_unload": null,
            "bulk": {
                "rp": "Dr. Fanny Shields PhD",
                "invoice": 81716,
                "client": "Kreiger, Brekke and Kuhic",
                "intermediary": "Welch, Hartmann and Mertz",
                "origin": "456 Janet Hill Suite 874\nNew Timothy, KY 05217-2314",
                "destination": "567 Abshire Brook Apt. 672\nMohamedfort, KY 53518",
                "mon_type": 9,
                "line": "Johnson-Padberg",
                "scheduled_load": "2018-09-19 09:21:02",
                "scheduled_departure": "2018-09-19 09:21:02",
                "scheduled_arrival": "2018-09-21 09:21:02",
                "scheduled_unload": "2018-09-22 09:21:02"
            },
            "tag": null,
            "device_id": null,
            "convoy_id": null
        },
        {
            "id": 8,
            "rp": "Matilda King",
            "invoice": "45026",
            "client": "Corkery-Brekke",
            "intermediary": "Walsh, Ledner and Terry",
            "origin_id": "7",
            "destination_id": "8",
            "mon_type": "5",
            "line": "Bogisich, Robel and Mayert",
            "scheduled_load": {
                "date": "2010-03-22 03:55:21.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "scheduled_departure": {
                "date": "2013-01-22 07:22:41.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "scheduled_arrival": {
                "date": "1998-11-27 17:12:11.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "scheduled_unload": {
                "date": "1999-01-23 10:05:11.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "bulk": null,
            "tag": null,
            "device_id": null,
            "convoy_id": null
        },
        {
            "id": 9,
            "rp": "Etha Hammes",
            "invoice": "37222",
            "client": "Kutch, Berge and Cormier",
            "intermediary": "Cremin, Leuschke and McCullough",
            "origin_id": "9",
            "destination_id": "10",
            "mon_type": "1",
            "line": "Schmeler-Collier",
            "scheduled_load": {
                "date": "1971-08-23 12:21:03.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "scheduled_departure": {
                "date": "2014-08-25 15:43:05.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "scheduled_arrival": {
                "date": "2018-08-16 14:38:25.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "scheduled_unload": {
                "date": "2000-11-27 04:10:13.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "bulk": null,
            "tag": "riesgo",
            "device_id": null,
            "convoy_id": null
        },
        {
            "id": 10,
            "rp": "Mariane McCullough DVM",
            "invoice": "57376",
            "client": "Block-Reichel",
            "intermediary": "Beahan, Rutherford and Gutmann",
            "origin_id": "11",
            "destination_id": "12",
            "mon_type": "6",
            "line": "Muller-Halvorson",
            "scheduled_load": {
                "date": "1992-03-29 09:14:00.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "scheduled_departure": {
                "date": "1999-01-09 09:04:42.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "scheduled_arrival": {
                "date": "2018-07-01 21:28:52.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "scheduled_unload": {
                "date": "1972-02-04 06:16:39.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "bulk": null,
            "tag": "riesgo",
            "device_id": null,
            "convoy_id": null
        },
        {
            "id": 11,
            "rp": null,
            "invoice": null,
            "client": null,
            "intermediary": null,
            "origin_id": null,
            "destination_id": null,
            "mon_type": null,
            "line": null,
            "scheduled_load": null,
            "scheduled_departure": null,
            "scheduled_arrival": null,
            "scheduled_unload": null,
            "bulk": {
                "rp": "Darion Grant PhD",
                "invoice": 63965,
                "client": "Murphy Group",
                "intermediary": "Prosacco and Sons",
                "origin": "2095 Deshaun Dale Apt. 774\nEast Mireyachester, MS 47958-2521",
                "destination": "294 Durward Courts Apt. 257\nPort Koby, NJ 68428",
                "mon_type": 3,
                "line": "Mante-Schamberger",
                "scheduled_load": "2018-09-19 09:21:34",
                "scheduled_departure": "2018-09-19 09:21:34",
                "scheduled_arrival": "2018-09-21 09:21:34",
                "scheduled_unload": "2018-09-22 09:21:34"
            },
            "tag": null,
            "device_id": null,
            "convoy_id": null
        },
        {
            "id": 12,
            "rp": null,
            "invoice": null,
            "client": null,
            "intermediary": null,
            "origin_id": null,
            "destination_id": null,
            "mon_type": null,
            "line": null,
            "scheduled_load": null,
            "scheduled_departure": null,
            "scheduled_arrival": null,
            "scheduled_unload": null,
            "bulk": {
                "rp": "Elmira Ullrich",
                "invoice": 8200,
                "client": "Morissette PLC",
                "intermediary": "Donnelly-Doyle",
                "origin": "1662 Jaren Course\nNorth Duanebury, NE 06152-9105",
                "destination": "57549 Pacocha Loop\nWest Henriette, PA 19436",
                "mon_type": 3,
                "line": "O'Hara, McDermott and Sporer",
                "scheduled_load": "2018-09-19 09:21:34",
                "scheduled_departure": "2018-09-19 09:21:34",
                "scheduled_arrival": "2018-09-21 09:21:34",
                "scheduled_unload": "2018-09-22 09:21:34"
            },
            "tag": null,
            "device_id": null,
            "convoy_id": null
        },
        {
            "id": 14,
            "rp": "Baylee Thompson III",
            "invoice": "14966",
            "client": "Harvey PLC",
            "intermediary": "Hintz-Gerlach",
            "origin_id": "13",
            "destination_id": "14",
            "mon_type": "0",
            "line": "Cartwright, Moore and Borer",
            "scheduled_load": {
                "date": "2006-11-18 20:41:05.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "scheduled_departure": {
                "date": "1989-05-15 19:55:35.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "scheduled_arrival": {
                "date": "1978-11-11 20:18:18.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "scheduled_unload": {
                "date": "1992-09-06 21:55:01.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "bulk": null,
            "tag": null,
            "device_id": null,
            "convoy_id": null
        },
        {
            "id": 15,
            "rp": "Mrs. Katharina Hayes III",
            "invoice": "69801",
            "client": "Raynor-Nader",
            "intermediary": "Zulauf-Mertz",
            "origin_id": "15",
            "destination_id": "16",
            "mon_type": "1",
            "line": "Harris, Kris and Howell",
            "scheduled_load": {
                "date": "1980-09-18 19:11:57.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "scheduled_departure": {
                "date": "1997-05-15 00:08:44.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "scheduled_arrival": {
                "date": "2013-03-01 19:09:04.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "scheduled_unload": {
                "date": "2015-04-12 06:34:45.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "bulk": null,
            "tag": "riesgo",
            "device_id": null,
            "convoy_id": null
        },
        {
            "id": 16,
            "rp": "Tia Pfeffer I",
            "invoice": "27687",
            "client": "Howe PLC",
            "intermediary": "Fay, Littel and Conn",
            "origin_id": "17",
            "destination_id": "18",
            "mon_type": "1",
            "line": "Miller-Hoppe",
            "scheduled_load": {
                "date": "1977-07-09 11:41:31.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "scheduled_departure": {
                "date": "1999-09-07 10:11:05.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "scheduled_arrival": {
                "date": "1981-10-27 23:35:14.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "scheduled_unload": {
                "date": "1983-02-02 07:50:41.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "bulk": null,
            "tag": "riesgo",
            "device_id": null,
            "convoy_id": null
        }
    ],
    "links": {
        "first": "http:\/\/localhost\/api\/v1\/trips?page=1",
        "last": "http:\/\/localhost\/api\/v1\/trips?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 1,
        "path": "http:\/\/localhost\/api\/v1\/trips",
        "per_page": 15,
        "to": 14,
        "total": 14
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
    -d "scheduled_load"="1995-11-11" \
    -d "scheduled_departure"="Sunday, 12-Nov-95 00:00:00 UTC" \
    -d "scheduled_arrival"="Monday, 13-Nov-95 00:00:00 UTC" \
    -d "scheduled_unload"="Tuesday, 14-Nov-95 00:00:00 UTC" \

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
        "scheduled_load": "1995-11-11",
        "scheduled_departure": "Sunday, 12-Nov-95 00:00:00 UTC",
        "scheduled_arrival": "Monday, 13-Nov-95 00:00:00 UTC",
        "scheduled_unload": "Tuesday, 14-Nov-95 00:00:00 UTC"
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
    -d "scheduled_load"="1987-09-13" \
    -d "scheduled_departure"="Monday, 14-Sep-87 00:00:00 UTC" \
    -d "scheduled_arrival"="Tuesday, 15-Sep-87 00:00:00 UTC" \
    -d "scheduled_unload"="Wednesday, 16-Sep-87 00:00:00 UTC" \

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
        "scheduled_load": "1987-09-13",
        "scheduled_departure": "Monday, 14-Sep-87 00:00:00 UTC",
        "scheduled_arrival": "Tuesday, 15-Sep-87 00:00:00 UTC",
        "scheduled_unload": "Wednesday, 16-Sep-87 00:00:00 UTC"
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
            "name": "Mrs. Kaelyn Parisian DDS",
            "lastname": "default",
            "email": "christop.hodkiewicz@example.net",
            "username": "defaultx"
        },
        {
            "name": "Johnson Leffler",
            "lastname": "default",
            "email": "halvorson.felicia@example.net",
            "username": "defaultx"
        },
        {
            "name": "Prof. Santino Denesik Sr.",
            "lastname": "default",
            "email": "romaguera.ian@example.com",
            "username": "defaultx"
        },
        {
            "name": "Anabel Rutherford",
            "lastname": "default",
            "email": "retha.gleichner@example.net",
            "username": "defaultx"
        },
        {
            "name": "Alexandria Will",
            "lastname": "default",
            "email": "watsica.robin@example.com",
            "username": "defaultx"
        },
        {
            "name": "Ephraim Harber",
            "lastname": "default",
            "email": "kiehn.dominic@example.org",
            "username": "defaultx"
        },
        {
            "name": "Lindsey Ferry",
            "lastname": "default",
            "email": "diana.doyle@example.net",
            "username": "defaultx"
        },
        {
            "name": "Michelle Hessel",
            "lastname": "default",
            "email": "darby20@example.net",
            "username": "defaultx"
        },
        {
            "name": "Ronny King DVM",
            "lastname": "default",
            "email": "pollich.ozella@example.org",
            "username": "defaultx"
        },
        {
            "name": "Mr. Desmond Hodkiewicz Jr.",
            "lastname": "default",
            "email": "llewellyn.haley@example.com",
            "username": "defaultx"
        },
        {
            "name": "Samanta Leuschke",
            "lastname": "default",
            "email": "mccullough.tamara@example.net",
            "username": "defaultx"
        },
        {
            "name": "Xavier Predovic",
            "lastname": "default",
            "email": "whammes@example.net",
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
        "to": 12,
        "total": 12
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
## api/v1/notification_activate/{notification_type}

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

