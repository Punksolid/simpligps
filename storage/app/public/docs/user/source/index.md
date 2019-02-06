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
[Get Postman Collection](http://localhost/storage/app/public/docs/user//collection.json)

<!-- END_INFO -->

#Carrier
<!-- START_ff02557e23520586ff7d6d60adc9193f -->
## Display a listing of the CARRIER.

> Example request:

```bash
curl -X GET -G "http://localhost:8000/api/v1/carriers" \
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
    "data": [
        {
            "carrier_name": "lakjsdñflk",
            "contact_name": "Deserunt quis pariatur Repudiandae accusantium eos perspiciatis facere et temporibus accusamus sequi ea",
            "phone": "Eaque deserunt consequat Molestiae ipsum eum vitae quis laborum quia itaque ex laboriosam consequat Aliquip",
            "email": "test@test.com"
        }
    ],
    "links": {
        "first": "http:\/\/localhost\/api\/v1\/carriers?page=1",
        "last": "http:\/\/localhost\/api\/v1\/carriers?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 1,
        "path": "http:\/\/localhost\/api\/v1\/carriers",
        "per_page": 15,
        "to": 1,
        "total": 1
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
        -d "email"="ttoy@example.net" 
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
curl -X GET -G "http://localhost:8000/api/v1/carriers/{carrier}" \
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
        -d "email"="kuhn.neal@example.org" 
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
curl -X GET -G "http://localhost:8000/api/v1/contacts/filter_tags" \
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
    "data": [
        {
            "id": 6,
            "name": "Ms. Pinkie Klein",
            "company": "Robel Inc",
            "phone": "739-559-3028 x269",
            "email": "ramona.oberbrunner@gmail.com",
            "address": "5777 Estevan Plaza Suite 332\nGunnarview, NJ 22530",
            "created_at": "1 second ago"
        },
        {
            "id": 5,
            "name": "Savion Orn",
            "company": "Kulas PLC",
            "phone": "1-763-625-1103",
            "email": "nikolaus.coralie@langosh.com",
            "address": "341 Alan Motorway\nZiemeville, DE 01927",
            "created_at": "1 minute ago"
        },
        {
            "id": 4,
            "name": "Dr. Jammie Jenkins",
            "company": "Sipes, Bogisich and Keeling",
            "phone": "610.610.1862",
            "email": "hane.geovanny@eichmann.com",
            "address": "7914 Linda Mills Suite 210\nEwellbury, MT 44913",
            "created_at": "5 minutes ago"
        },
        {
            "id": 3,
            "name": "Nostrum porro laboriosam consequat Enim in voluptate consequatur eum quaerat alias ea fugit quia fugit nobis esse illo est sint",
            "company": "Reiciendis aut cumque voluptate molestiae voluptatem amet ut cumque et rerum",
            "phone": "Totam alias et nisi beatae nobis",
            "email": "punk@lkasjd.com",
            "address": "Qui aut ut neque laboriosam in qui iure non sit dicta cum qui voluptatem Corrupti ut",
            "created_at": "2 weeks ago"
        },
        {
            "id": 2,
            "name": "Dolore voluptates ducimus voluptates aut dolore exercitation hic ducimus similique esse cupidatat nisi non modi tempore",
            "company": "Soluta quia fugiat dolores sint ut provident consequatur error consequatur",
            "phone": "Qui facilis quo facere vel consequatur",
            "email": "Aut eum dolor aute reprehenderit sint",
            "address": "Accusantium et laborum autem id mollit natus sit quae provident eos suscipit natus quibusdam",
            "created_at": "2 weeks ago"
        },
        {
            "id": 1,
            "name": "Prof. Elissa Hartmann",
            "company": "Streich, Schinner and Vandervort",
            "phone": "338-734-1624",
            "email": "glenda.bailey@ebert.net",
            "address": "28087 Ashly Run Apt. 647\nPort Eloiseton, VA 51673",
            "created_at": "2 weeks ago"
        }
    ],
    "links": {
        "first": "http:\/\/localhost\/api\/v1\/contacts\/filter_tags?page=1",
        "last": "http:\/\/localhost\/api\/v1\/contacts\/filter_tags?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 1,
        "path": "http:\/\/localhost\/api\/v1\/contacts\/filter_tags",
        "per_page": 15,
        "to": 6,
        "total": 6
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
curl -X GET -G "http://localhost:8000/api/v1/contacts" \
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
    "data": [
        {
            "id": 1,
            "name": "Prof. Elissa Hartmann",
            "company": "Streich, Schinner and Vandervort",
            "phone": "338-734-1624",
            "email": "glenda.bailey@ebert.net",
            "address": "28087 Ashly Run Apt. 647\nPort Eloiseton, VA 51673",
            "created_at": "2 weeks ago"
        },
        {
            "id": 2,
            "name": "Dolore voluptates ducimus voluptates aut dolore exercitation hic ducimus similique esse cupidatat nisi non modi tempore",
            "company": "Soluta quia fugiat dolores sint ut provident consequatur error consequatur",
            "phone": "Qui facilis quo facere vel consequatur",
            "email": "Aut eum dolor aute reprehenderit sint",
            "address": "Accusantium et laborum autem id mollit natus sit quae provident eos suscipit natus quibusdam",
            "created_at": "2 weeks ago"
        },
        {
            "id": 3,
            "name": "Nostrum porro laboriosam consequat Enim in voluptate consequatur eum quaerat alias ea fugit quia fugit nobis esse illo est sint",
            "company": "Reiciendis aut cumque voluptate molestiae voluptatem amet ut cumque et rerum",
            "phone": "Totam alias et nisi beatae nobis",
            "email": "punk@lkasjd.com",
            "address": "Qui aut ut neque laboriosam in qui iure non sit dicta cum qui voluptatem Corrupti ut",
            "created_at": "2 weeks ago"
        },
        {
            "id": 4,
            "name": "Dr. Jammie Jenkins",
            "company": "Sipes, Bogisich and Keeling",
            "phone": "610.610.1862",
            "email": "hane.geovanny@eichmann.com",
            "address": "7914 Linda Mills Suite 210\nEwellbury, MT 44913",
            "created_at": "5 minutes ago"
        },
        {
            "id": 5,
            "name": "Savion Orn",
            "company": "Kulas PLC",
            "phone": "1-763-625-1103",
            "email": "nikolaus.coralie@langosh.com",
            "address": "341 Alan Motorway\nZiemeville, DE 01927",
            "created_at": "1 minute ago"
        },
        {
            "id": 6,
            "name": "Ms. Pinkie Klein",
            "company": "Robel Inc",
            "phone": "739-559-3028 x269",
            "email": "ramona.oberbrunner@gmail.com",
            "address": "5777 Estevan Plaza Suite 332\nGunnarview, NJ 22530",
            "created_at": "1 second ago"
        }
    ],
    "links": {
        "first": "http:\/\/localhost\/api\/v1\/contacts?page=1",
        "last": "http:\/\/localhost\/api\/v1\/contacts?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 1,
        "path": "http:\/\/localhost\/api\/v1\/contacts",
        "per_page": 15,
        "to": 6,
        "total": 6
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
        -d "address"="temporibus" 
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
curl -X GET -G "http://localhost:8000/api/v1/contacts/{contact}" \
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
    "message": "Call to a member function diffForHumans() on null",
    "exception": "Symfony\\Component\\Debug\\Exception\\FatalThrowableError",
    "file": "\/home\/ze\/projects\/trm\/neotrm\/app\/Http\/Resources\/ContactResource.php",
    "line": 24,
    "trace": [
        {
            "file": "\/home\/ze\/projects\/trm\/neotrm\/vendor\/laravel\/framework\/src\/Illuminate\/Http\/Resources\/Json\/JsonResource.php",
            "line": 90,
            "function": "toArray",
            "class": "App\\Http\\Resources\\ContactResource",
            "type": "->"
        },
        {
            "file": "\/home\/ze\/projects\/trm\/neotrm\/vendor\/laravel\/framework\/src\/Illuminate\/Http\/Resources\/Json\/ResourceResponse.php",
            "line": 39,
            "function": "resolve",
            "class": "Illuminate\\Http\\Resources\\Json\\JsonResource",
            "type": "->"
        },
        {
            "file": "\/home\/ze\/projects\/trm\/neotrm\/vendor\/laravel\/framework\/src\/Illuminate\/Http\/Resources\/Json\/JsonResource.php",
            "line": 197,
            "function": "toResponse",
            "class": "Illuminate\\Http\\Resources\\Json\\ResourceResponse",
            "type": "->"
        },
        {
            "file": "\/home\/ze\/projects\/trm\/neotrm\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Router.php",
            "line": 735,
            "function": "toResponse",
            "class": "Illuminate\\Http\\Resources\\Json\\JsonResource",
            "type": "->"
        },
        {
            "file": "\/home\/ze\/projects\/trm\/neotrm\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Router.php",
            "line": 722,
            "function": "toResponse",
            "class": "Illuminate\\Routing\\Router",
            "type": "::"
        },
        {
            "file": "\/home\/ze\/projects\/trm\/neotrm\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Router.php",
            "line": 682,
            "function": "prepareResponse",
            "class": "Illuminate\\Routing\\Router",
            "type": "->"
        },
        {
            "file": "\/home\/ze\/projects\/trm\/neotrm\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 30,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Router",
            "type": "->"
        },
        {
            "file": "\/home\/ze\/projects\/trm\/neotrm\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 104,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/home\/ze\/projects\/trm\/neotrm\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Router.php",
            "line": 684,
            "function": "then",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/home\/ze\/projects\/trm\/neotrm\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Router.php",
            "line": 659,
            "function": "runRouteWithinStack",
            "class": "Illuminate\\Routing\\Router",
            "type": "->"
        },
        {
            "file": "\/home\/ze\/projects\/trm\/neotrm\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Router.php",
            "line": 625,
            "function": "runRoute",
            "class": "Illuminate\\Routing\\Router",
            "type": "->"
        },
        {
            "file": "\/home\/ze\/projects\/trm\/neotrm\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Router.php",
            "line": 614,
            "function": "dispatchToRoute",
            "class": "Illuminate\\Routing\\Router",
            "type": "->"
        },
        {
            "file": "\/home\/ze\/projects\/trm\/neotrm\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Kernel.php",
            "line": 176,
            "function": "dispatch",
            "class": "Illuminate\\Routing\\Router",
            "type": "->"
        },
        {
            "file": "\/home\/ze\/projects\/trm\/neotrm\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 30,
            "function": "Illuminate\\Foundation\\Http\\{closure}",
            "class": "Illuminate\\Foundation\\Http\\Kernel",
            "type": "->"
        },
        {
            "file": "\/home\/ze\/projects\/trm\/neotrm\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 104,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/home\/ze\/projects\/trm\/neotrm\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Kernel.php",
            "line": 151,
            "function": "then",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/home\/ze\/projects\/trm\/neotrm\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Kernel.php",
            "line": 116,
            "function": "sendRequestThroughRouter",
            "class": "Illuminate\\Foundation\\Http\\Kernel",
            "type": "->"
        },
        {
            "file": "\/home\/ze\/projects\/trm\/neotrm\/vendor\/mpociot\/laravel-apidoc-generator\/src\/Mpociot\/ApiDoc\/Generators\/LaravelGenerator.php",
            "line": 79,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Kernel",
            "type": "->"
        },
        {
            "file": "\/home\/ze\/projects\/trm\/neotrm\/vendor\/mpociot\/laravel-apidoc-generator\/src\/Mpociot\/ApiDoc\/Generators\/AbstractGenerator.php",
            "line": 222,
            "function": "callRoute",
            "class": "Mpociot\\ApiDoc\\Generators\\LaravelGenerator",
            "type": "->"
        },
        {
            "file": "\/home\/ze\/projects\/trm\/neotrm\/vendor\/mpociot\/laravel-apidoc-generator\/src\/Mpociot\/ApiDoc\/Generators\/AbstractGenerator.php",
            "line": 88,
            "function": "getRouteResponse",
            "class": "Mpociot\\ApiDoc\\Generators\\AbstractGenerator",
            "type": "->"
        },
        {
            "file": "\/home\/ze\/projects\/trm\/neotrm\/vendor\/mpociot\/laravel-apidoc-generator\/src\/Mpociot\/ApiDoc\/Commands\/GenerateDocumentation.php",
            "line": 292,
            "function": "processRoute",
            "class": "Mpociot\\ApiDoc\\Generators\\AbstractGenerator",
            "type": "->"
        },
        {
            "file": "\/home\/ze\/projects\/trm\/neotrm\/vendor\/mpociot\/laravel-apidoc-generator\/src\/Mpociot\/ApiDoc\/Commands\/GenerateDocumentation.php",
            "line": 95,
            "function": "processRoutes",
            "class": "Mpociot\\ApiDoc\\Commands\\GenerateDocumentation",
            "type": "->"
        },
        {
            "function": "handle",
            "class": "Mpociot\\ApiDoc\\Commands\\GenerateDocumentation",
            "type": "->"
        },
        {
            "file": "\/home\/ze\/projects\/trm\/neotrm\/vendor\/laravel\/framework\/src\/Illuminate\/Container\/BoundMethod.php",
            "line": 29,
            "function": "call_user_func_array"
        },
        {
            "file": "\/home\/ze\/projects\/trm\/neotrm\/vendor\/laravel\/framework\/src\/Illuminate\/Container\/BoundMethod.php",
            "line": 87,
            "function": "Illuminate\\Container\\{closure}",
            "class": "Illuminate\\Container\\BoundMethod",
            "type": "::"
        },
        {
            "file": "\/home\/ze\/projects\/trm\/neotrm\/vendor\/laravel\/framework\/src\/Illuminate\/Container\/BoundMethod.php",
            "line": 31,
            "function": "callBoundMethod",
            "class": "Illuminate\\Container\\BoundMethod",
            "type": "::"
        },
        {
            "file": "\/home\/ze\/projects\/trm\/neotrm\/vendor\/laravel\/framework\/src\/Illuminate\/Container\/Container.php",
            "line": 572,
            "function": "call",
            "class": "Illuminate\\Container\\BoundMethod",
            "type": "::"
        },
        {
            "file": "\/home\/ze\/projects\/trm\/neotrm\/vendor\/laravel\/framework\/src\/Illuminate\/Console\/Command.php",
            "line": 183,
            "function": "call",
            "class": "Illuminate\\Container\\Container",
            "type": "->"
        },
        {
            "file": "\/home\/ze\/projects\/trm\/neotrm\/vendor\/symfony\/console\/Command\/Command.php",
            "line": 255,
            "function": "execute",
            "class": "Illuminate\\Console\\Command",
            "type": "->"
        },
        {
            "file": "\/home\/ze\/projects\/trm\/neotrm\/vendor\/laravel\/framework\/src\/Illuminate\/Console\/Command.php",
            "line": 170,
            "function": "run",
            "class": "Symfony\\Component\\Console\\Command\\Command",
            "type": "->"
        },
        {
            "file": "\/home\/ze\/projects\/trm\/neotrm\/vendor\/laravel\/framework\/src\/Illuminate\/Console\/Command.php",
            "line": 198,
            "function": "run",
            "class": "Illuminate\\Console\\Command",
            "type": "->"
        },
        {
            "file": "\/home\/ze\/projects\/trm\/neotrm\/app\/Console\/Commands\/GenerateDocumentation.php",
            "line": 63,
            "function": "call",
            "class": "Illuminate\\Console\\Command",
            "type": "->"
        },
        {
            "function": "handle",
            "class": "App\\Console\\Commands\\GenerateDocumentation",
            "type": "->"
        },
        {
            "file": "\/home\/ze\/projects\/trm\/neotrm\/vendor\/laravel\/framework\/src\/Illuminate\/Container\/BoundMethod.php",
            "line": 29,
            "function": "call_user_func_array"
        },
        {
            "file": "\/home\/ze\/projects\/trm\/neotrm\/vendor\/laravel\/framework\/src\/Illuminate\/Container\/BoundMethod.php",
            "line": 87,
            "function": "Illuminate\\Container\\{closure}",
            "class": "Illuminate\\Container\\BoundMethod",
            "type": "::"
        },
        {
            "file": "\/home\/ze\/projects\/trm\/neotrm\/vendor\/laravel\/framework\/src\/Illuminate\/Container\/BoundMethod.php",
            "line": 31,
            "function": "callBoundMethod",
            "class": "Illuminate\\Container\\BoundMethod",
            "type": "::"
        },
        {
            "file": "\/home\/ze\/projects\/trm\/neotrm\/vendor\/laravel\/framework\/src\/Illuminate\/Container\/Container.php",
            "line": 572,
            "function": "call",
            "class": "Illuminate\\Container\\BoundMethod",
            "type": "::"
        },
        {
            "file": "\/home\/ze\/projects\/trm\/neotrm\/vendor\/laravel\/framework\/src\/Illuminate\/Console\/Command.php",
            "line": 183,
            "function": "call",
            "class": "Illuminate\\Container\\Container",
            "type": "->"
        },
        {
            "file": "\/home\/ze\/projects\/trm\/neotrm\/vendor\/symfony\/console\/Command\/Command.php",
            "line": 255,
            "function": "execute",
            "class": "Illuminate\\Console\\Command",
            "type": "->"
        },
        {
            "file": "\/home\/ze\/projects\/trm\/neotrm\/vendor\/laravel\/framework\/src\/Illuminate\/Console\/Command.php",
            "line": 170,
            "function": "run",
            "class": "Symfony\\Component\\Console\\Command\\Command",
            "type": "->"
        },
        {
            "file": "\/home\/ze\/projects\/trm\/neotrm\/vendor\/symfony\/console\/Application.php",
            "line": 901,
            "function": "run",
            "class": "Illuminate\\Console\\Command",
            "type": "->"
        },
        {
            "file": "\/home\/ze\/projects\/trm\/neotrm\/vendor\/symfony\/console\/Application.php",
            "line": 262,
            "function": "doRunCommand",
            "class": "Symfony\\Component\\Console\\Application",
            "type": "->"
        },
        {
            "file": "\/home\/ze\/projects\/trm\/neotrm\/vendor\/symfony\/console\/Application.php",
            "line": 145,
            "function": "doRun",
            "class": "Symfony\\Component\\Console\\Application",
            "type": "->"
        },
        {
            "file": "\/home\/ze\/projects\/trm\/neotrm\/vendor\/laravel\/framework\/src\/Illuminate\/Console\/Application.php",
            "line": 89,
            "function": "run",
            "class": "Symfony\\Component\\Console\\Application",
            "type": "->"
        },
        {
            "file": "\/home\/ze\/projects\/trm\/neotrm\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Console\/Kernel.php",
            "line": 122,
            "function": "run",
            "class": "Illuminate\\Console\\Application",
            "type": "->"
        },
        {
            "file": "\/home\/ze\/projects\/trm\/neotrm\/artisan",
            "line": 37,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Console\\Kernel",
            "type": "->"
        }
    ]
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
curl -X GET -G "http://localhost:8000/api/v1/trips/convoys" \
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
curl -X GET -G "http://localhost:8000/api/v1/trips/convoys/{convoy}" \
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

#Device
<!-- START_e96c6711c1ea3212afa6af75fb23e97c -->
## Display a listing of the Devices.

> Example request:

```bash
curl -X GET -G "http://localhost:8000/api/v1/devices" \
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
        -d "carrier_id"="possimus" 
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
curl -X GET -G "http://localhost:8000/api/v1/devices/{device}" \
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
        -d "carrier_id"="sit" 
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

<!-- START_934ea5b44f90f194fb9f4d54b0b677c7 -->
## api/v1/external/devices/{device}/localization

> Example request:

```bash
curl -X POST "http://localhost:8000/api/v1/external/devices/{device}/localization" \
    -H "Accept: application/json" \
    -d "lat"="quis" \
        -d "lon"="quis" 
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
        -d "carrier_id"="dolores" 
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
curl -X GET -G "http://localhost:8000/api/v1/external/devices" \
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

#Me
<!-- START_d58be746f29144cb8a66c4e189fcb1e1 -->
## Logged user information

> Example request:

```bash
curl -X GET -G "http://localhost:8000/api/v1/me" \
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
        "id": 61,
        "name": "Colleen Kohler",
        "lastname": "",
        "email": "quonathaniel95@example.net",
        "username": ""
    }
}
```

### HTTP Request
`GET api/v1/me`


<!-- END_d58be746f29144cb8a66c4e189fcb1e1 -->

<!-- START_16b8eda3aa41185a0a777ba89f36b669 -->
## Devuelve las notificaciones internas del sistema del usuario, las estandar de Laravel

> Example request:

```bash
curl -X GET -G "http://localhost:8000/api/v1/me/notifications" \
    -H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/v1/me/notifications",
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
`GET api/v1/me/notifications`


<!-- END_16b8eda3aa41185a0a777ba89f36b669 -->

#Operadores
<!-- START_7291414742faecdc528180b175f8a4f2 -->
## Muestra listado de operadores.

> Example request:

```bash
curl -X GET -G "http://localhost:8000/api/v1/operators" \
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
    "data": [
        {
            "name": "Molestiae est totam et facilis",
            "phone": "Consequat Amet labore ut omnis laborum Veritatis",
            "active": false
        },
        {
            "name": "Molestiae est totam et facilis",
            "phone": "Consequat Amet labore ut omnis laborum Veritatis",
            "active": false
        },
        {
            "name": "Nemo quae ipsa nostrum beatae ad in esse",
            "phone": "Occaecat enim fugiat perferendis pariatur Aut quaerat consequatur et eius nulla aliquid cillum nulla ex",
            "active": false
        },
        {
            "name": "Nemo quae ipsa nostrum beatae ad in esse",
            "phone": "Occaecat enim fugiat perferendis pariatur Aut quaerat consequatur et eius nulla aliquid cillum nulla ex",
            "active": false
        },
        {
            "name": "Nemo quae ipsa nostrum beatae ad in esse",
            "phone": "Occaecat enim fugiat perferendis pariatur Aut quaerat consequatur et eius nulla aliquid cillum nulla ex",
            "active": false
        },
        {
            "name": "Deserunt officiis et sunt non sit repellendus Totam",
            "phone": "Facere nostrum est quae aut quia",
            "active": false
        },
        {
            "name": "Dolore non odit ut necessitatibus quis nesciunt et sunt quis enim",
            "phone": "Quibusdam in qui voluptatem sequi quam quos sunt odit accusamus do culpa sit a perferendis id ex",
            "active": false
        },
        {
            "name": "Dolore non odit ut necessitatibus quis nesciunt et sunt quis enim",
            "phone": "Quibusdam in qui voluptatem sequi quam quos sunt odit accusamus do culpa sit a perferendis id ex",
            "active": false
        },
        {
            "name": "holla",
            "phone": "Veniam quo nobis placeat vel qui incididunt eveniet qui omnis commodi voluptatem Dolor non modi nobis",
            "active": false
        }
    ],
    "links": {
        "first": "http:\/\/localhost\/api\/v1\/operators?page=1",
        "last": "http:\/\/localhost\/api\/v1\/operators?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 1,
        "path": "http:\/\/localhost\/api\/v1\/operators",
        "per_page": 15,
        "to": 9,
        "total": 9
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
        -d "active"="1" 
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
curl -X GET -G "http://localhost:8000/api/v1/operators/{operator}" \
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
        -d "active"="1" 
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
curl -X GET -G "http://localhost:8000/api/v1/permissions" \
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
        },
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
curl -X GET -G "http://localhost:8000/api/v1/places" \
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
curl -X GET -G "http://localhost:8000/api/v1/places/{place}" \
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
        -d "phone"="repellat" 
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
## Asigna rol a usuario

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
curl -X GET -G "http://localhost:8000/api/v1/roles" \
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
        "created_at": "2019-01-17 08:20:31",
        "updated_at": "2019-01-17 08:20:31"
    },
    {
        "id": 2,
        "name": "monitorista",
        "guard_name": "api",
        "created_at": "2019-01-17 09:05:08",
        "updated_at": "2019-01-17 09:05:08"
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
curl -X GET -G "http://localhost:8000/api/v1/roles/{role}" \
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

#Settings
<!-- START_3756edec6e45a4253a6dd160792fc937 -->
## api/v1/settings

> Example request:

```bash
curl -X POST "http://localhost:8000/api/v1/settings" \
    -H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/v1/settings",
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
`POST api/v1/settings`


<!-- END_3756edec6e45a4253a6dd160792fc937 -->

<!-- START_0f7c405a059a084f42490f2decb1584b -->
## api/v1/settings

> Example request:

```bash
curl -X GET -G "http://localhost:8000/api/v1/settings" \
    -H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/v1/settings",
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
        "wialon_key": "11b6e71f234078f1ca9e6944705a235bB6C1D1F551E3E263783A2354A63236306018E83E"
    }
}
```

### HTTP Request
`GET api/v1/settings`


<!-- END_0f7c405a059a084f42490f2decb1584b -->

#Trace
<!-- START_d1c7efa5cc37e2aeb63e23e088517a7b -->
## Display a listing of the resource.

> Example request:

```bash
curl -X GET -G "http://localhost:8000/api/v1/trips/{trip}/traces" \
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
curl -X GET -G "http://localhost:8000/api/v1/trips" \
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
        -d "scheduled_load"="1996-01-24" \
        -d "scheduled_departure"="Thursday, 25-Jan-96 00:00:00 UTC" \
        -d "scheduled_arrival"="Friday, 26-Jan-96 00:00:00 UTC" \
        -d "scheduled_unload"="Saturday, 27-Jan-96 00:00:00 UTC" 
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
        "scheduled_load": "1996-01-24",
        "scheduled_departure": "Thursday, 25-Jan-96 00:00:00 UTC",
        "scheduled_arrival": "Friday, 26-Jan-96 00:00:00 UTC",
        "scheduled_unload": "Saturday, 27-Jan-96 00:00:00 UTC"
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
        -d "scheduled_load"="1987-11-03" \
        -d "scheduled_departure"="Wednesday, 04-Nov-87 00:00:00 UTC" \
        -d "scheduled_arrival"="Thursday, 05-Nov-87 00:00:00 UTC" \
        -d "scheduled_unload"="Friday, 06-Nov-87 00:00:00 UTC" 
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
        "scheduled_load": "1987-11-03",
        "scheduled_departure": "Wednesday, 04-Nov-87 00:00:00 UTC",
        "scheduled_arrival": "Thursday, 05-Nov-87 00:00:00 UTC",
        "scheduled_unload": "Friday, 06-Nov-87 00:00:00 UTC"
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

#Unit
<!-- START_a04c46a9f2324d91b7d30b10526164be -->
## Listar unidades con datos básicos

> Example request:

```bash
curl -X GET -G "http://localhost:8000/api/v1/units" \
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
            "name": "BicicletaChema",
            "id": 18158799,
            "measure_units": 0
        },
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
                "lat": 24.804941,
                "lon": -107.437472
            }
        },
        {
            "name": "PTS003",
            "id": 17471332,
            "measure_units": 0,
            "position": {
                "lat": 24.791862,
                "lon": -107.404404
            }
        },
        {
            "name": "PTS004",
            "id": 17471392,
            "measure_units": 0,
            "position": {
                "lat": 24.810418,
                "lon": -107.389419
            }
        },
        {
            "name": "PTS005",
            "id": 17471421,
            "measure_units": 0,
            "position": {
                "lat": 24.804955,
                "lon": -107.43746
            }
        }
    ]
}
```

### HTTP Request
`GET api/v1/units`


<!-- END_a04c46a9f2324d91b7d30b10526164be -->

<!-- START_2784cc932141defd94d1f43c872ca40c -->
## Listar unidades mostrando ubicación

> Example request:

```bash
curl -X GET -G "http://localhost:8000/api/v1/units/with_localization" \
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
            "name": "BicicletaChema",
            "id": 18158799,
            "measure_units": 0
        },
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
                "lat": 24.804941,
                "lon": -107.437472
            }
        },
        {
            "name": "PTS003",
            "id": 17471332,
            "measure_units": 0,
            "position": {
                "lat": 24.791862,
                "lon": -107.404404
            }
        },
        {
            "name": "PTS004",
            "id": 17471392,
            "measure_units": 0,
            "position": {
                "lat": 24.810418,
                "lon": -107.389419
            }
        },
        {
            "name": "PTS005",
            "id": 17471421,
            "measure_units": 0,
            "position": {
                "lat": 24.804955,
                "lon": -107.43746
            }
        }
    ]
}
```

### HTTP Request
`GET api/v1/units/with_localization`


<!-- END_2784cc932141defd94d1f43c872ca40c -->

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
## Display a listing of the users.

> Example request:

```bash
curl -X GET -G "http://localhost:8000/api/v1/users" \
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
            "id": 61,
            "name": "Colleen Kohler",
            "lastname": "",
            "email": "quonathaniel95@example.net",
            "username": ""
        },
        {
            "id": 60,
            "name": "Andrew Blanda",
            "lastname": "",
            "email": "voluptatibusbertha07@example.com",
            "username": ""
        },
        {
            "id": 59,
            "name": "Kareem Nader",
            "lastname": "",
            "email": "estbradtke.helena@example.net",
            "username": ""
        },
        {
            "id": 57,
            "name": "Tyrell Grant",
            "lastname": "",
            "email": "abymurphy@example.net",
            "username": ""
        },
        {
            "id": 58,
            "name": "Levi Gottlieb",
            "lastname": "Muller",
            "email": "becker.audrey@hotmail.com",
            "username": "baron.murazik"
        },
        {
            "id": 55,
            "name": "Dr. Hildegard Walsh V",
            "lastname": "",
            "email": "cupiditateqdietrich@example.net",
            "username": ""
        },
        {
            "id": 56,
            "name": "Winifred Stark",
            "lastname": "Cremin",
            "email": "kattie53@upton.com",
            "username": "jacobson.ronaldo"
        },
        {
            "id": 53,
            "name": "Prof. Marianna Kuphal",
            "lastname": "",
            "email": "doloremquelarkin.chloe@example.net",
            "username": ""
        },
        {
            "id": 54,
            "name": "Hermann Treutel",
            "lastname": "",
            "email": "xstanton@gmail.com",
            "username": ""
        },
        {
            "id": 51,
            "name": "Dr. Kyle Connelly Sr.",
            "lastname": "",
            "email": "iustoturner.keshawn@example.com",
            "username": ""
        },
        {
            "id": 52,
            "name": "Viva Shields",
            "lastname": "",
            "email": "praesentiummisty.gleason@example.net",
            "username": ""
        },
        {
            "id": 50,
            "name": "Twila Kovacek",
            "lastname": "",
            "email": "doloreophelia.rippin@example.net",
            "username": ""
        },
        {
            "id": 49,
            "name": "Dr. Kasey Klein",
            "lastname": "",
            "email": "dictasage.johns@example.org",
            "username": ""
        },
        {
            "id": 48,
            "name": "Eileen Gusikowski",
            "lastname": "",
            "email": "asperioreshroob@example.net",
            "username": ""
        },
        {
            "id": 47,
            "name": "Alva Leffler DVM",
            "lastname": "",
            "email": "quasicasper@example.net",
            "username": ""
        }
    ],
    "links": {
        "first": "http:\/\/localhost\/api\/v1\/users?page=1",
        "last": "http:\/\/localhost\/api\/v1\/users?page=4",
        "prev": null,
        "next": "http:\/\/localhost\/api\/v1\/users?page=2"
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 4,
        "path": "http:\/\/localhost\/api\/v1\/users",
        "per_page": 15,
        "to": 15,
        "total": 56
    }
}
```

### HTTP Request
`GET api/v1/users`


<!-- END_1aff981da377ba9a1bbc56ff8efaec0d -->

<!-- START_4194ceb9a20b7f80b61d14d44df366b4 -->
## Store a newly created users in storage.

> Example request:

```bash
curl -X POST "http://localhost:8000/api/v1/users" \
    -H "Accept: application/json" \
    -d "name"="eligendi" \
        -d "email"="lenore05@example.org" 
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

<!-- START_296fac4bf818c99f6dd42a4a0eb56b58 -->
## Update the specified users in storage.

> Example request:

```bash
curl -X PUT "http://localhost:8000/api/v1/users/{user}" \
    -H "Accept: application/json" \
    -d "name"="ab" \
        -d "email"="tromp.madalyn@example.org" 
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/v1/users/{user}",
    "method": "PUT",
    "data": {
        "name": "ab",
        "email": "tromp.madalyn@example.org"
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
`PUT api/v1/users/{user}`

`PATCH api/v1/users/{user}`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    name | string |  required  | 
    email | email |  required  | 

<!-- END_296fac4bf818c99f6dd42a4a0eb56b58 -->

<!-- START_22354fc95c42d81a744eece68f5b9b9a -->
## Remove the specified users from storage.

> Example request:

```bash
curl -X DELETE "http://localhost:8000/api/v1/users/{user}" \
    -H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/v1/users/{user}",
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
`DELETE api/v1/users/{user}`


<!-- END_22354fc95c42d81a744eece68f5b9b9a -->

#Wialon
<!-- START_90f76c49b3469a72527c0664b3e85cc9 -->
## api/v1/wialon/resources

> Example request:

```bash
curl -X GET -G "http://localhost:8000/api/v1/wialon/resources" \
    -H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/v1/wialon/resources",
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
            "name": "Bafar PTS",
            "id": 17471233
        },
        {
            "name": "resource_4016186244",
            "id": 18547566
        },
        {
            "name": "resource_4681317141",
            "id": 18547567
        },
        {
            "name": "resource_8679680401",
            "id": 18547568
        },
        {
            "name": "resource_7025770331",
            "id": 18547571
        },
        {
            "name": "laborumeum",
            "id": 18547582
        }
    ]
}
```

### HTTP Request
`GET api/v1/wialon/resources`


<!-- END_90f76c49b3469a72527c0664b3e85cc9 -->

<!-- START_7cc5a4c03fabbfced301d9af0ed250e4 -->
## api/v1/wialon/notifications

> Example request:

```bash
curl -X GET -G "http://localhost:8000/api/v1/wialon/notifications" \
    -H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/v1/wialon/notifications",
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
            "name": "pts_Bateria Baja",
            "txt": "%UNIT%: sensor %SENSOR_NAME% activado con el valor %SENSOR_VALUE%. En %POS_TIME% se movió con una velocidad de %SPEED% cerca de '%LOCATION%'.",
            "control_type": "sensor_value",
            "actions": [
                "email",
                "message",
                "event"
            ],
            "resource": "resource"
        },
        {
            "name": "pts_Boton SOS",
            "txt": "Un mensaje de alarma de %UNIT% fue recibido. En %POS_TIME% se movió con una velocidad de %SPEED% cerca de '%LOCATION%'.",
            "control_type": "alarm",
            "actions": [
                "email",
                "message",
                "event"
            ],
            "resource": "resource"
        },
        {
            "name": "pts_Llegada al Trabajo",
            "txt": "%UNIT% entró en %ZONE%. En %POS_TIME% se movió con una velocidad de %SPEED% cerca de '%LOCATION%'.",
            "control_type": "geozone",
            "actions": [
                "email",
                "message",
                "event",
                "update_icon"
            ],
            "resource": "resource"
        },
        {
            "name": "pts_Salida del Trabajo",
            "txt": "%UNIT% salió en %ZONE%. En %POS_TIME% se movió con una velocidad de %SPEED% cerca de '%LOCATION%'.",
            "control_type": "geozone",
            "actions": [
                "email",
                "message",
                "event",
                "update_icon"
            ],
            "resource": "resource"
        },
        {
            "name": "pts_Alerta de Robo",
            "txt": "%UNIT% abandonó %ZONE%. En %POS_TIME% se movió con una velocidad de %SPEED% cerca de '%LOCATION%'.",
            "control_type": "geozone",
            "actions": [
                "email",
                "message",
                "event"
            ],
            "resource": "resource"
        },
        {
            "name": "Test-Panic00",
            "txt": "Test Notification Text",
            "control_type": "alarm",
            "actions": [
                "push_messages"
            ],
            "resource": "resource"
        },
        {
            "name": "Prueba Boton Panico",
            "txt": "Test Notification Text",
            "control_type": "alarm",
            "actions": [
                "push_messages"
            ],
            "resource": "resource"
        }
    ]
}
```

### HTTP Request
`GET api/v1/wialon/notifications`


<!-- END_7cc5a4c03fabbfced301d9af0ed250e4 -->

<!-- START_64a531c0282cf526db49a0abc4cb71e2 -->
## api/v1/wialon/units

> Example request:

```bash
curl -X GET -G "http://localhost:8000/api/v1/wialon/units" \
    -H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/v1/wialon/units",
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
            "id": 18158799,
            "nm": "BicicletaChema",
            "name": "BicicletaChema"
        },
        {
            "id": 17471245,
            "nm": "PTS001",
            "name": "PTS001"
        },
        {
            "id": 17471271,
            "nm": "PTS002",
            "name": "PTS002"
        },
        {
            "id": 17471332,
            "nm": "PTS003",
            "name": "PTS003"
        },
        {
            "id": 17471392,
            "nm": "PTS004",
            "name": "PTS004"
        },
        {
            "id": 17471421,
            "nm": "PTS005",
            "name": "PTS005"
        }
    ]
}
```

### HTTP Request
`GET api/v1/wialon/units`


<!-- END_64a531c0282cf526db49a0abc4cb71e2 -->

<!-- START_3ed37d9cf1cd7ef5247333d885f6d0f9 -->
## Create Wialon Notification

> Example request:

```bash
curl -X POST "http://localhost:8000/api/v1/wialon/notifications" \
    -H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/v1/wialon/notifications",
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
`POST api/v1/wialon/notifications`


<!-- END_3ed37d9cf1cd7ef5247333d885f6d0f9 -->

#general
<!-- START_489208ef982629b16bc08aa39afec69b -->
## Display Swagger API page.

> Example request:

```bash
curl -X GET -G "http://localhost:8000/api/v1/documentation" \
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

<!-- START_66df3678904adde969490f2278b8f47f -->
## Authenticate the request for channel access.

> Example request:

```bash
curl -X GET -G "http://localhost:8000/broadcasting/auth" \
    -H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/broadcasting/auth",
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
`GET broadcasting/auth`

`POST broadcasting/auth`


<!-- END_66df3678904adde969490f2278b8f47f -->

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

<!-- START_fb2ae43e2e99ff4e90f22ba03801a735 -->
## Log the user out of the application.

> Example request:

```bash
curl -X POST "http://localhost:8000/api/v1/logout" \
    -H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/v1/logout",
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
`POST api/v1/logout`


<!-- END_fb2ae43e2e99ff4e90f22ba03801a735 -->

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

<!-- START_4cf94bc9f074886056957cc4894939fa -->
## api/v1/webhook/alert

> Example request:

```bash
curl -X POST "http://localhost:8000/api/v1/webhook/alert" \
    -H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/v1/webhook/alert",
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
`POST api/v1/webhook/alert`


<!-- END_4cf94bc9f074886056957cc4894939fa -->

<!-- START_95c83f59d1144079b19fd0a7d92ba503 -->
## Recibe Resource_ID, Nombre, Latitud, Longitud y  radio

> Example request:

```bash
curl -X POST "http://localhost:8000/api/v1/geofences" \
    -H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/v1/geofences",
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
`POST api/v1/geofences`


<!-- END_95c83f59d1144079b19fd0a7d92ba503 -->

<!-- START_b6deeb81fd9eaec04a64059c6f25d063 -->
## Envía a todos los usuarios el mensaje de notification

> Example request:

```bash
curl -X GET -G "http://localhost:8000/api/v1/notification_activate/{notification_type}" \
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
## Store a newly created NotificationType in storage.

> Example request:

```bash
curl -X POST "http://localhost:8000/api/v1/notification_types" \
    -H "Accept: application/json" \
    -d "alias"="et" \
        -d "deactivation_mode"="et" 
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


