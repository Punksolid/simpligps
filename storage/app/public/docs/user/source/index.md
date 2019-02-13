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
        },
        {
            "carrier_name": "Quod tempore vero a",
            "contact_name": "Voluptatem Quos off",
            "phone": "Et qui unde voluptas",
            "email": "carriert@test.com"
        },
        {
            "carrier_name": "Zemlak, Monahan and Olson",
            "contact_name": "Chanelle Zieme",
            "phone": "1-842-360-6465 x41943",
            "email": "frederic12@yahoo.com"
        },
        {
            "carrier_name": "Willms-O'Keefe",
            "contact_name": "Freida Powlowski II",
            "phone": "468.980.0250 x061",
            "email": "adams.bridie@miller.net"
        },
        {
            "carrier_name": "Reynolds, Lang and Schneider",
            "contact_name": "Doyle Schamberger",
            "phone": "(272) 883-0504",
            "email": "lilla.senger@wilderman.com"
        },
        {
            "carrier_name": "Sauer PLC",
            "contact_name": "Monte Cronin PhD",
            "phone": "+1-824-848-1891",
            "email": "ola.murazik@zemlak.com"
        },
        {
            "carrier_name": "Walsh, Buckridge and Homenick",
            "contact_name": "Vincenzo Boehm",
            "phone": "+1 (310) 982-1841",
            "email": "alexane.graham@gmail.com"
        },
        {
            "carrier_name": "Marvin Group",
            "contact_name": "Prof. Gabriel Kutch",
            "phone": "(840) 489-8512 x17819",
            "email": "mdurgan@berge.biz"
        },
        {
            "carrier_name": "Kertzmann Inc",
            "contact_name": "Emely McLaughlin DDS",
            "phone": "(283) 804-5638 x17087",
            "email": "mazie17@jakubowski.com"
        },
        {
            "carrier_name": "Beer, Ondricka and Rolfson",
            "contact_name": "German Batz",
            "phone": "262-564-6171 x61932",
            "email": "bergstrom.lisette@farrell.com"
        },
        {
            "carrier_name": "Cruickshank-Murphy",
            "contact_name": "Mr. Lisandro Rippin",
            "phone": "+1-449-484-9747",
            "email": "davin.oberbrunner@cole.info"
        },
        {
            "carrier_name": "Mraz PLC",
            "contact_name": "Sage Hegmann",
            "phone": "1-704-965-9741",
            "email": "jannie64@rath.com"
        },
        {
            "carrier_name": "Cartwright, Dare and Auer",
            "contact_name": "Pearlie Torphy",
            "phone": "481.685.9720 x6413",
            "email": "else73@lemke.biz"
        },
        {
            "carrier_name": "Kessler, Marks and Schmeler",
            "contact_name": "Meggie Schaden Jr.",
            "phone": "401-851-0304 x681",
            "email": "brando24@larson.com"
        },
        {
            "carrier_name": "Glover, Ullrich and King",
            "contact_name": "Emmy Moore",
            "phone": "221-210-9374",
            "email": "titus.johnson@pfannerstill.com"
        }
    ],
    "links": {
        "first": "http:\/\/localhost\/api\/v1\/carriers?page=1",
        "last": "http:\/\/localhost\/api\/v1\/carriers?page=5",
        "prev": null,
        "next": "http:\/\/localhost\/api\/v1\/carriers?page=2"
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 5,
        "path": "http:\/\/localhost\/api\/v1\/carriers",
        "per_page": 15,
        "to": 15,
        "total": 73
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
            "id": 35,
            "name": "Brent Zemlak",
            "company": "Botsford-Kreiger",
            "phone": "1-580-662-1897 x601",
            "email": "royce39@yahoo.com",
            "address": "952 Margarete Via Apt. 380\nAbshirefurt, DC 58561",
            "created_at": "1 second ago"
        },
        {
            "id": 33,
            "name": "Isai Reichert",
            "company": "Schaden, Mayert and Glover",
            "phone": "760-373-3851 x561",
            "email": "gutmann.caterina@wolff.com",
            "address": "553 Gerhold Isle\nHauckberg, NJ 02926",
            "created_at": "6 hours ago"
        },
        {
            "id": 34,
            "name": "Ole Mills",
            "company": "Dicki PLC",
            "phone": "741-592-2526 x089",
            "email": "cspencer@ward.biz",
            "address": "264 Leffler Lake Suite 667\nSouth Pete, WY 94636",
            "created_at": "6 hours ago"
        },
        {
            "id": 28,
            "name": "Ms. Stacy Schroeder Sr.",
            "company": "Windler and Sons",
            "phone": "(284) 820-3254 x4451",
            "email": "yparker@bins.com",
            "address": "33659 Mosciski Brook Apt. 090\nPort Orvaltown, TX 37257",
            "created_at": "6 hours ago"
        },
        {
            "id": 29,
            "name": "Mrs. Selina Littel",
            "company": "Hamill, Jacobson and Corkery",
            "phone": "214-959-1561 x39664",
            "email": "aterry@carroll.info",
            "address": "47711 Terry Corner Apt. 782\nWest Thurmanshire, CA 28971-3284",
            "created_at": "6 hours ago"
        },
        {
            "id": 30,
            "name": "279942",
            "company": "Hintz, Hilpert and Brown",
            "phone": "748.499.4136 x906",
            "email": "wmckenzie@hettinger.info",
            "address": "9362576",
            "created_at": "6 hours ago"
        },
        {
            "id": 32,
            "name": "Ms. Imelda Kutch PhD",
            "company": "Kihn, Powlowski and Fisher",
            "phone": "1-450-324-3066 x06634",
            "email": "lily.dach@cummings.com",
            "address": "35912 Fleta Isle Suite 625\nPort Marilyne, CA 05999-7487",
            "created_at": "6 hours ago"
        },
        {
            "id": 27,
            "name": "Veda Erdman",
            "company": "Greenholt-Kuvalis",
            "phone": "(432) 629-8639 x21640",
            "email": "qtremblay@bailey.com",
            "address": "700 Aracely Courts Suite 230\nNew Lorna, ME 09918",
            "created_at": "6 hours ago"
        },
        {
            "id": 25,
            "name": "Marilyne Maggio",
            "company": "Gibson, Bartell and Abbott",
            "phone": "+18426462735",
            "email": "mckenzie05@bode.com",
            "address": "86069 Deckow Square\nEast Marlee, NJ 86690-2138",
            "created_at": "6 hours ago"
        },
        {
            "id": 26,
            "name": "Miss Itzel Schultz PhD",
            "company": "Funk, Heaney and Sauer",
            "phone": "437-824-9505 x39598",
            "email": "charlene74@hotmail.com",
            "address": "955 Camilla Crossing Apt. 174\nValentinetown, NM 29281-1944",
            "created_at": "6 hours ago"
        },
        {
            "id": 21,
            "name": "Eli Friesen",
            "company": "McGlynn, Rosenbaum and Pagac",
            "phone": "359.942.6440 x134",
            "email": "kyla16@fahey.com",
            "address": "68251 Misael Terrace\nJeremyfort, WY 65329",
            "created_at": "6 hours ago"
        },
        {
            "id": 22,
            "name": "Lionel Bergstrom",
            "company": "Luettgen, Roberts and Effertz",
            "phone": "860-773-3429 x2528",
            "email": "maggio.colton@koelpin.biz",
            "address": "63947 Pete Court Apt. 259\nMonserrateborough, PA 69139",
            "created_at": "6 hours ago"
        },
        {
            "id": 23,
            "name": "288644",
            "company": "Lynch, Weissnat and Cummerata",
            "phone": "964-819-8206 x59848",
            "email": "damion.roob@gmail.com",
            "address": "3464624",
            "created_at": "6 hours ago"
        },
        {
            "id": 17,
            "name": "625787",
            "company": "Fritsch LLC",
            "phone": "+1-789-932-3867",
            "email": "tyrell.harber@yahoo.com",
            "address": "3454017",
            "created_at": "6 hours ago"
        },
        {
            "id": 19,
            "name": "Prof. Katherine Goldner PhD",
            "company": "Cummings-Cole",
            "phone": "+1-389-967-5843",
            "email": "roob.grace@larkin.org",
            "address": "7735 Zella Ways\nSarinaville, KY 63787",
            "created_at": "6 hours ago"
        }
    ],
    "links": {
        "first": "http:\/\/localhost\/api\/v1\/contacts\/filter_tags?page=1",
        "last": "http:\/\/localhost\/api\/v1\/contacts\/filter_tags?page=3",
        "prev": null,
        "next": "http:\/\/localhost\/api\/v1\/contacts\/filter_tags?page=2"
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 3,
        "path": "http:\/\/localhost\/api\/v1\/contacts\/filter_tags",
        "per_page": 15,
        "to": 15,
        "total": 31
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
            "created_at": "3 weeks ago"
        },
        {
            "id": 2,
            "name": "Dolore voluptates ducimus voluptates aut dolore exercitation hic ducimus similique esse cupidatat nisi non modi tempore",
            "company": "Soluta quia fugiat dolores sint ut provident consequatur error consequatur",
            "phone": "Qui facilis quo facere vel consequatur",
            "email": "Aut eum dolor aute reprehenderit sint",
            "address": "Accusantium et laborum autem id mollit natus sit quae provident eos suscipit natus quibusdam",
            "created_at": "3 weeks ago"
        },
        {
            "id": 3,
            "name": "Nostrum porro laboriosam consequat Enim in voluptate consequatur eum quaerat alias ea fugit quia fugit nobis esse illo est sint",
            "company": "Reiciendis aut cumque voluptate molestiae voluptatem amet ut cumque et rerum",
            "phone": "Totam alias et nisi beatae nobis",
            "email": "punk@lkasjd.com",
            "address": "Qui aut ut neque laboriosam in qui iure non sit dicta cum qui voluptatem Corrupti ut",
            "created_at": "3 weeks ago"
        },
        {
            "id": 4,
            "name": "Dr. Jammie Jenkins",
            "company": "Sipes, Bogisich and Keeling",
            "phone": "610.610.1862",
            "email": "hane.geovanny@eichmann.com",
            "address": "7914 Linda Mills Suite 210\nEwellbury, MT 44913",
            "created_at": "6 days ago"
        },
        {
            "id": 5,
            "name": "Savion Orn",
            "company": "Kulas PLC",
            "phone": "1-763-625-1103",
            "email": "nikolaus.coralie@langosh.com",
            "address": "341 Alan Motorway\nZiemeville, DE 01927",
            "created_at": "6 days ago"
        },
        {
            "id": 6,
            "name": "Ms. Pinkie Klein",
            "company": "Robel Inc",
            "phone": "739-559-3028 x269",
            "email": "ramona.oberbrunner@gmail.com",
            "address": "5777 Estevan Plaza Suite 332\nGunnarview, NJ 22530",
            "created_at": "6 days ago"
        },
        {
            "id": 7,
            "name": "Mariano Pouros",
            "company": "Mueller, Hirthe and Block",
            "phone": "+1.829.551.9191",
            "email": "raphael.kohler@hotmail.com",
            "address": "6174 Hayes Ways\nLake Dan, GA 62635",
            "created_at": "6 days ago"
        },
        {
            "id": 8,
            "name": "Polly Dietrich DDS",
            "company": "Zulauf-Lynch",
            "phone": "1-296-349-9414 x84898",
            "email": "shauck@feest.com",
            "address": "3303 Shakira Vista Apt. 431\nSouth Brittanyville, ID 40747-5240",
            "created_at": "5 days ago"
        },
        {
            "id": 9,
            "name": "Cletus Oberbrunner",
            "company": "Rowe, Bergstrom and Watsica",
            "phone": "1-689-427-9891",
            "email": "turcotte.ally@yahoo.com",
            "address": "7615 Agustin Manors\nNew Trudieville, IA 46798-9776",
            "created_at": "4 days ago"
        },
        {
            "id": 10,
            "name": "Savanah Glover Sr.",
            "company": "Goldner-Little",
            "phone": "1-392-880-7509",
            "email": "rowan.goldner@brekke.net",
            "address": "387 Missouri Road\nNorth Colleen, IN 08000",
            "created_at": "4 days ago"
        },
        {
            "id": 11,
            "name": "865522",
            "company": "Bauch Ltd",
            "phone": "250.546.9831 x147",
            "email": "bret.hauck@tillman.com",
            "address": "1562060",
            "created_at": "4 days ago"
        },
        {
            "id": 13,
            "name": "Kaya Oberbrunner",
            "company": "Smith, Haley and Ward",
            "phone": "(923) 441-7854 x567",
            "email": "jmayert@block.com",
            "address": "74917 Verna Glens Suite 661\nSouth Columbusshire, NC 64982-3428",
            "created_at": "4 days ago"
        },
        {
            "id": 14,
            "name": "Hermann Hoeger",
            "company": "Wintheiser Ltd",
            "phone": "1-890-575-3211 x243",
            "email": "mschaefer@ortiz.info",
            "address": "97962 Otilia Shores\nStoltenbergton, CO 48191",
            "created_at": "4 days ago"
        },
        {
            "id": 15,
            "name": "Salvador Mills DDS",
            "company": "Blick, O'Kon and Boyer",
            "phone": "626.813.5405",
            "email": "graciela64@lindgren.com",
            "address": "95892 Thompson Falls\nPort Violetteberg, NE 64223",
            "created_at": "6 hours ago"
        },
        {
            "id": 16,
            "name": "Alejandrin Stark PhD",
            "company": "Konopelski, Goyette and Hill",
            "phone": "+1 (883) 313-6933",
            "email": "morgan.effertz@torphy.info",
            "address": "1624 Schroeder Parks Apt. 226\nSouth Kali, FL 82567",
            "created_at": "6 hours ago"
        }
    ],
    "links": {
        "first": "http:\/\/localhost\/api\/v1\/contacts?page=1",
        "last": "http:\/\/localhost\/api\/v1\/contacts?page=3",
        "prev": null,
        "next": "http:\/\/localhost\/api\/v1\/contacts?page=2"
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 3,
        "path": "http:\/\/localhost\/api\/v1\/contacts",
        "per_page": 15,
        "to": 15,
        "total": 31
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
[
    {
        "id": 1,
        "created_at": "2019-02-08 07:13:50",
        "updated_at": "2019-02-08 07:13:50",
        "trips": [
            {
                "id": 1,
                "rp": "Emmalee Schamberger",
                "invoice": "13245",
                "client": "Mante-Lemke",
                "intermediary": "Ritchie, Howell and Baumbach",
                "origin_id": "1",
                "destination_id": "2",
                "mon_type": "5",
                "line": "Schuppe-Mitchell",
                "scheduled_load": "2014-05-13 02:55:59",
                "scheduled_departure": "1982-12-21 06:24:00",
                "scheduled_arrival": "2011-08-03 19:56:52",
                "scheduled_unload": "1991-08-04 00:48:12",
                "bulk": null,
                "tag": null,
                "device_id": null,
                "convoy_id": 1,
                "created_at": "2019-02-08 07:13:50",
                "updated_at": "2019-02-08 07:13:50"
            },
            {
                "id": 2,
                "rp": "Mr. Bartholome Stamm",
                "invoice": "49880",
                "client": "Ebert, Schaden and Renner",
                "intermediary": "Steuber PLC",
                "origin_id": "3",
                "destination_id": "4",
                "mon_type": "2",
                "line": "Kilback Ltd",
                "scheduled_load": "2002-03-20 04:51:39",
                "scheduled_departure": "1976-03-13 07:25:07",
                "scheduled_arrival": "2006-05-02 21:24:21",
                "scheduled_unload": "1992-08-23 06:40:09",
                "bulk": null,
                "tag": null,
                "device_id": null,
                "convoy_id": 1,
                "created_at": "2019-02-08 07:13:50",
                "updated_at": "2019-02-08 07:13:50"
            },
            {
                "id": 3,
                "rp": "Blaise Ryan PhD",
                "invoice": "90084",
                "client": "O'Connell-Weber",
                "intermediary": "Ernser-Keeling",
                "origin_id": "5",
                "destination_id": "6",
                "mon_type": "4",
                "line": "Medhurst-Batz",
                "scheduled_load": "1996-07-11 22:20:30",
                "scheduled_departure": "1987-08-19 02:53:37",
                "scheduled_arrival": "2012-07-10 20:51:41",
                "scheduled_unload": "2006-11-29 14:56:04",
                "bulk": null,
                "tag": null,
                "device_id": null,
                "convoy_id": 1,
                "created_at": "2019-02-08 07:13:50",
                "updated_at": "2019-02-08 07:13:50"
            }
        ]
    },
    {
        "id": 2,
        "created_at": "2019-02-08 07:13:50",
        "updated_at": "2019-02-08 07:13:50",
        "trips": [
            {
                "id": 4,
                "rp": "Rogelio Swaniawski",
                "invoice": "17073",
                "client": "Mante, Greenfelder and Hudson",
                "intermediary": "Friesen-Leffler",
                "origin_id": "7",
                "destination_id": "8",
                "mon_type": "1",
                "line": "Prosacco-Bayer",
                "scheduled_load": "1997-04-08 08:24:30",
                "scheduled_departure": "1978-09-23 21:44:28",
                "scheduled_arrival": "1981-06-27 11:32:24",
                "scheduled_unload": "1997-01-13 22:28:08",
                "bulk": null,
                "tag": null,
                "device_id": null,
                "convoy_id": 2,
                "created_at": "2019-02-08 07:13:50",
                "updated_at": "2019-02-08 07:13:50"
            },
            {
                "id": 5,
                "rp": "Tianna Ritchie",
                "invoice": "29960",
                "client": "Hahn, Schultz and West",
                "intermediary": "Greenholt-Torp",
                "origin_id": "9",
                "destination_id": "10",
                "mon_type": "9",
                "line": "Hackett LLC",
                "scheduled_load": "1972-06-29 06:40:12",
                "scheduled_departure": "1996-07-24 18:19:21",
                "scheduled_arrival": "2000-06-23 11:31:09",
                "scheduled_unload": "2014-03-25 21:13:06",
                "bulk": null,
                "tag": null,
                "device_id": null,
                "convoy_id": 2,
                "created_at": "2019-02-08 07:13:50",
                "updated_at": "2019-02-08 07:13:50"
            },
            {
                "id": 6,
                "rp": "Dr. Eleazar Nienow Jr.",
                "invoice": "75721",
                "client": "Turcotte-Tremblay",
                "intermediary": "Senger PLC",
                "origin_id": "11",
                "destination_id": "12",
                "mon_type": "7",
                "line": "Gerhold LLC",
                "scheduled_load": "2012-10-04 10:07:35",
                "scheduled_departure": "1985-04-03 19:15:47",
                "scheduled_arrival": "1973-09-17 14:28:52",
                "scheduled_unload": "1978-01-26 06:27:47",
                "bulk": null,
                "tag": null,
                "device_id": null,
                "convoy_id": 2,
                "created_at": "2019-02-08 07:13:50",
                "updated_at": "2019-02-08 07:13:50"
            }
        ]
    },
    {
        "id": 3,
        "created_at": "2019-02-08 07:13:51",
        "updated_at": "2019-02-08 07:13:51",
        "trips": [
            {
                "id": 7,
                "rp": "Janiya Hoeger",
                "invoice": "5018",
                "client": "Rosenbaum, Glover and Haag",
                "intermediary": "Casper-Blick",
                "origin_id": "13",
                "destination_id": "14",
                "mon_type": "9",
                "line": "Anderson, Hayes and Gutkowski",
                "scheduled_load": "1996-07-17 20:16:42",
                "scheduled_departure": "1996-06-30 11:50:49",
                "scheduled_arrival": "2007-05-14 19:31:04",
                "scheduled_unload": "1978-08-03 22:44:39",
                "bulk": null,
                "tag": null,
                "device_id": null,
                "convoy_id": 3,
                "created_at": "2019-02-08 07:13:51",
                "updated_at": "2019-02-08 07:13:51"
            },
            {
                "id": 8,
                "rp": "Patrick Predovic",
                "invoice": "72630",
                "client": "Stanton-Larkin",
                "intermediary": "Lehner, Tromp and Will",
                "origin_id": "15",
                "destination_id": "16",
                "mon_type": "4",
                "line": "Stanton, McKenzie and Bergnaum",
                "scheduled_load": "1990-03-20 17:09:46",
                "scheduled_departure": "1997-07-25 23:08:56",
                "scheduled_arrival": "1994-08-05 19:41:13",
                "scheduled_unload": "1988-06-14 09:31:51",
                "bulk": null,
                "tag": null,
                "device_id": null,
                "convoy_id": 3,
                "created_at": "2019-02-08 07:13:51",
                "updated_at": "2019-02-08 07:13:51"
            },
            {
                "id": 9,
                "rp": "Laverne Sipes",
                "invoice": "42952",
                "client": "Kerluke-Langworth",
                "intermediary": "Effertz Inc",
                "origin_id": "17",
                "destination_id": "18",
                "mon_type": "5",
                "line": "McClure, Weimann and Beahan",
                "scheduled_load": "1998-08-12 14:32:52",
                "scheduled_departure": "1980-01-21 23:44:15",
                "scheduled_arrival": "2007-07-05 19:29:58",
                "scheduled_unload": "1988-05-26 09:38:03",
                "bulk": null,
                "tag": null,
                "device_id": null,
                "convoy_id": 3,
                "created_at": "2019-02-08 07:13:51",
                "updated_at": "2019-02-08 07:13:51"
            }
        ]
    },
    {
        "id": 4,
        "created_at": "2019-02-13 00:04:32",
        "updated_at": "2019-02-13 00:04:32",
        "trips": [
            {
                "id": 18,
                "rp": "Moshe Simonis",
                "invoice": "40800",
                "client": "Ferry, Rice and Ritchie",
                "intermediary": "Lueilwitz and Sons",
                "origin_id": "34",
                "destination_id": "35",
                "mon_type": "7",
                "line": "Hodkiewicz-Upton",
                "scheduled_load": "2009-12-28 16:15:07",
                "scheduled_departure": "1970-08-19 01:39:08",
                "scheduled_arrival": "2016-03-26 05:14:33",
                "scheduled_unload": "1993-12-02 02:07:46",
                "bulk": null,
                "tag": null,
                "device_id": null,
                "convoy_id": 4,
                "created_at": "2019-02-13 00:04:32",
                "updated_at": "2019-02-13 00:04:32"
            },
            {
                "id": 19,
                "rp": "Warren Durgan",
                "invoice": "69242",
                "client": "Goyette, Schaden and Klein",
                "intermediary": "Rowe-Romaguera",
                "origin_id": "36",
                "destination_id": "37",
                "mon_type": "0",
                "line": "Fahey, Kessler and Feest",
                "scheduled_load": "1998-02-26 09:15:21",
                "scheduled_departure": "1999-05-20 08:02:45",
                "scheduled_arrival": "2000-12-28 01:47:14",
                "scheduled_unload": "1992-07-07 23:17:47",
                "bulk": null,
                "tag": null,
                "device_id": null,
                "convoy_id": 4,
                "created_at": "2019-02-13 00:04:32",
                "updated_at": "2019-02-13 00:04:32"
            },
            {
                "id": 20,
                "rp": "Glen Dooley",
                "invoice": "62708",
                "client": "Boehm, Kub and Hamill",
                "intermediary": "Wuckert-Franecki",
                "origin_id": "38",
                "destination_id": "39",
                "mon_type": "6",
                "line": "Erdman-Brown",
                "scheduled_load": "1982-06-19 06:43:07",
                "scheduled_departure": "2016-07-12 15:12:18",
                "scheduled_arrival": "2016-02-27 13:34:54",
                "scheduled_unload": "2018-03-29 09:18:34",
                "bulk": null,
                "tag": null,
                "device_id": null,
                "convoy_id": 4,
                "created_at": "2019-02-13 00:04:32",
                "updated_at": "2019-02-13 00:04:32"
            }
        ]
    },
    {
        "id": 5,
        "created_at": "2019-02-13 00:04:32",
        "updated_at": "2019-02-13 00:04:32",
        "trips": [
            {
                "id": 21,
                "rp": "Danika Langosh DDS",
                "invoice": "2640",
                "client": "Lueilwitz, Harber and Herman",
                "intermediary": "Baumbach Inc",
                "origin_id": "40",
                "destination_id": "41",
                "mon_type": "8",
                "line": "Gutkowski PLC",
                "scheduled_load": "1992-01-11 12:39:42",
                "scheduled_departure": "2012-04-01 19:06:01",
                "scheduled_arrival": "1991-10-08 20:12:33",
                "scheduled_unload": "1985-12-21 17:40:29",
                "bulk": null,
                "tag": null,
                "device_id": null,
                "convoy_id": 5,
                "created_at": "2019-02-13 00:04:32",
                "updated_at": "2019-02-13 00:04:32"
            },
            {
                "id": 22,
                "rp": "Aisha Rodriguez V",
                "invoice": "72480",
                "client": "Kautzer, Simonis and Swaniawski",
                "intermediary": "Wunsch, Rolfson and Deckow",
                "origin_id": "42",
                "destination_id": "43",
                "mon_type": "1",
                "line": "Oberbrunner, Auer and Rath",
                "scheduled_load": "1975-03-22 23:55:26",
                "scheduled_departure": "2004-12-10 12:31:46",
                "scheduled_arrival": "1990-09-10 04:05:36",
                "scheduled_unload": "2018-05-27 23:31:37",
                "bulk": null,
                "tag": null,
                "device_id": null,
                "convoy_id": 5,
                "created_at": "2019-02-13 00:04:32",
                "updated_at": "2019-02-13 00:04:32"
            },
            {
                "id": 23,
                "rp": "Kris Dickinson",
                "invoice": "40426",
                "client": "Steuber PLC",
                "intermediary": "Bednar Inc",
                "origin_id": "44",
                "destination_id": "45",
                "mon_type": "9",
                "line": "Ferry, Greenfelder and Jakubowski",
                "scheduled_load": "1976-08-15 15:22:23",
                "scheduled_departure": "1998-07-09 11:36:12",
                "scheduled_arrival": "1973-05-03 06:55:34",
                "scheduled_unload": "2018-05-18 14:06:00",
                "bulk": null,
                "tag": null,
                "device_id": null,
                "convoy_id": 5,
                "created_at": "2019-02-13 00:04:32",
                "updated_at": "2019-02-13 00:04:32"
            }
        ]
    },
    {
        "id": 6,
        "created_at": "2019-02-13 00:04:33",
        "updated_at": "2019-02-13 00:04:33",
        "trips": [
            {
                "id": 24,
                "rp": "Lucas Moen",
                "invoice": "51539",
                "client": "Strosin LLC",
                "intermediary": "Bins-Upton",
                "origin_id": "46",
                "destination_id": "47",
                "mon_type": "4",
                "line": "O'Kon, Koelpin and Rowe",
                "scheduled_load": "2015-06-17 13:45:05",
                "scheduled_departure": "2013-04-02 20:02:17",
                "scheduled_arrival": "2017-10-02 08:45:48",
                "scheduled_unload": "2013-02-23 02:58:10",
                "bulk": null,
                "tag": null,
                "device_id": null,
                "convoy_id": 6,
                "created_at": "2019-02-13 00:04:33",
                "updated_at": "2019-02-13 00:04:33"
            },
            {
                "id": 25,
                "rp": "Willard Wiza Sr.",
                "invoice": "75080",
                "client": "Beer-Keebler",
                "intermediary": "Doyle-Donnelly",
                "origin_id": "48",
                "destination_id": "49",
                "mon_type": "8",
                "line": "Runte, Hamill and Gleason",
                "scheduled_load": "1987-06-18 16:08:42",
                "scheduled_departure": "1977-04-07 07:55:12",
                "scheduled_arrival": "1985-10-07 05:55:41",
                "scheduled_unload": "1973-02-02 11:04:34",
                "bulk": null,
                "tag": null,
                "device_id": null,
                "convoy_id": 6,
                "created_at": "2019-02-13 00:04:33",
                "updated_at": "2019-02-13 00:04:33"
            },
            {
                "id": 26,
                "rp": "Prof. Arvid Predovic III",
                "invoice": "63611",
                "client": "Stamm and Sons",
                "intermediary": "Marks-Schowalter",
                "origin_id": "50",
                "destination_id": "51",
                "mon_type": "6",
                "line": "Howell and Sons",
                "scheduled_load": "1974-04-03 01:43:04",
                "scheduled_departure": "1986-12-04 15:22:25",
                "scheduled_arrival": "1985-08-24 04:05:28",
                "scheduled_unload": "2002-07-24 02:07:14",
                "bulk": null,
                "tag": null,
                "device_id": null,
                "convoy_id": 6,
                "created_at": "2019-02-13 00:04:33",
                "updated_at": "2019-02-13 00:04:33"
            }
        ]
    },
    {
        "id": 7,
        "created_at": "2019-02-13 00:07:39",
        "updated_at": "2019-02-13 00:07:39",
        "trips": [
            {
                "id": 35,
                "rp": "Jalon Donnelly",
                "invoice": "43703",
                "client": "Hudson-Bartoletti",
                "intermediary": "Turner and Sons",
                "origin_id": "67",
                "destination_id": "68",
                "mon_type": "1",
                "line": "Bernier, Legros and Larkin",
                "scheduled_load": "2002-08-06 16:25:01",
                "scheduled_departure": "2001-10-03 23:18:51",
                "scheduled_arrival": "1975-12-05 21:23:42",
                "scheduled_unload": "2002-11-20 23:19:32",
                "bulk": null,
                "tag": null,
                "device_id": null,
                "convoy_id": 7,
                "created_at": "2019-02-13 00:07:39",
                "updated_at": "2019-02-13 00:07:39"
            },
            {
                "id": 36,
                "rp": "Gertrude Daugherty",
                "invoice": "27338",
                "client": "Cremin, Turner and O'Kon",
                "intermediary": "Purdy-Barton",
                "origin_id": "69",
                "destination_id": "70",
                "mon_type": "6",
                "line": "Greenfelder, Wuckert and Johnston",
                "scheduled_load": "1991-07-18 12:39:40",
                "scheduled_departure": "2010-07-10 06:10:10",
                "scheduled_arrival": "1976-06-19 12:16:36",
                "scheduled_unload": "2010-06-20 03:12:13",
                "bulk": null,
                "tag": null,
                "device_id": null,
                "convoy_id": 7,
                "created_at": "2019-02-13 00:07:39",
                "updated_at": "2019-02-13 00:07:39"
            },
            {
                "id": 37,
                "rp": "Annamae Daugherty",
                "invoice": "6268",
                "client": "Fisher Ltd",
                "intermediary": "Stoltenberg-Hilpert",
                "origin_id": "71",
                "destination_id": "72",
                "mon_type": "4",
                "line": "Quigley Group",
                "scheduled_load": "1993-09-03 20:52:48",
                "scheduled_departure": "2016-06-18 22:29:30",
                "scheduled_arrival": "1977-11-30 08:08:56",
                "scheduled_unload": "2010-06-28 05:51:56",
                "bulk": null,
                "tag": null,
                "device_id": null,
                "convoy_id": 7,
                "created_at": "2019-02-13 00:07:39",
                "updated_at": "2019-02-13 00:07:39"
            }
        ]
    },
    {
        "id": 8,
        "created_at": "2019-02-13 00:07:40",
        "updated_at": "2019-02-13 00:07:40",
        "trips": [
            {
                "id": 38,
                "rp": "Daisha Lind",
                "invoice": "27437",
                "client": "Wunsch-Bayer",
                "intermediary": "Armstrong, Douglas and Rutherford",
                "origin_id": "73",
                "destination_id": "74",
                "mon_type": "7",
                "line": "Beatty-Howell",
                "scheduled_load": "1990-07-20 18:55:26",
                "scheduled_departure": "2003-12-08 08:42:33",
                "scheduled_arrival": "2012-05-14 06:41:44",
                "scheduled_unload": "1983-12-27 16:33:35",
                "bulk": null,
                "tag": null,
                "device_id": null,
                "convoy_id": 8,
                "created_at": "2019-02-13 00:07:40",
                "updated_at": "2019-02-13 00:07:40"
            },
            {
                "id": 39,
                "rp": "Chaim Gusikowski IV",
                "invoice": "24576",
                "client": "Stracke, Trantow and Gaylord",
                "intermediary": "Ledner, Konopelski and Rutherford",
                "origin_id": "75",
                "destination_id": "76",
                "mon_type": "5",
                "line": "Haley-Rippin",
                "scheduled_load": "1990-05-22 18:16:10",
                "scheduled_departure": "2005-08-24 05:27:42",
                "scheduled_arrival": "1995-07-10 23:31:22",
                "scheduled_unload": "1972-01-21 08:38:00",
                "bulk": null,
                "tag": null,
                "device_id": null,
                "convoy_id": 8,
                "created_at": "2019-02-13 00:07:40",
                "updated_at": "2019-02-13 00:07:40"
            },
            {
                "id": 40,
                "rp": "Jammie Turner IV",
                "invoice": "80715",
                "client": "Mosciski Ltd",
                "intermediary": "Beier-Grady",
                "origin_id": "77",
                "destination_id": "78",
                "mon_type": "0",
                "line": "Mosciski, Baumbach and Gulgowski",
                "scheduled_load": "2016-06-07 07:39:35",
                "scheduled_departure": "1973-12-12 14:52:06",
                "scheduled_arrival": "1979-10-12 16:17:11",
                "scheduled_unload": "1995-09-25 06:01:08",
                "bulk": null,
                "tag": null,
                "device_id": null,
                "convoy_id": 8,
                "created_at": "2019-02-13 00:07:40",
                "updated_at": "2019-02-13 00:07:40"
            }
        ]
    },
    {
        "id": 9,
        "created_at": "2019-02-13 00:07:40",
        "updated_at": "2019-02-13 00:07:40",
        "trips": [
            {
                "id": 41,
                "rp": "Saul Douglas",
                "invoice": "87791",
                "client": "Kunze Inc",
                "intermediary": "Doyle Inc",
                "origin_id": "79",
                "destination_id": "80",
                "mon_type": "4",
                "line": "Kihn, Windler and Olson",
                "scheduled_load": "1978-12-19 00:43:31",
                "scheduled_departure": "2002-07-10 17:23:57",
                "scheduled_arrival": "1999-04-25 11:40:21",
                "scheduled_unload": "1995-02-06 14:49:18",
                "bulk": null,
                "tag": null,
                "device_id": null,
                "convoy_id": 9,
                "created_at": "2019-02-13 00:07:40",
                "updated_at": "2019-02-13 00:07:40"
            },
            {
                "id": 42,
                "rp": "Dr. Mollie Altenwerth",
                "invoice": "37060",
                "client": "Metz Group",
                "intermediary": "Romaguera, Reilly and Nader",
                "origin_id": "81",
                "destination_id": "82",
                "mon_type": "1",
                "line": "Metz-Reinger",
                "scheduled_load": "1981-06-08 21:14:44",
                "scheduled_departure": "1988-09-12 15:25:19",
                "scheduled_arrival": "1987-11-05 20:49:56",
                "scheduled_unload": "1999-11-30 05:26:15",
                "bulk": null,
                "tag": null,
                "device_id": null,
                "convoy_id": 9,
                "created_at": "2019-02-13 00:07:40",
                "updated_at": "2019-02-13 00:07:40"
            },
            {
                "id": 43,
                "rp": "Ryley Tremblay",
                "invoice": "10769",
                "client": "Krajcik-Farrell",
                "intermediary": "Collins, Yundt and Miller",
                "origin_id": "83",
                "destination_id": "84",
                "mon_type": "4",
                "line": "Swaniawski and Sons",
                "scheduled_load": "1987-10-21 23:53:02",
                "scheduled_departure": "1988-04-09 10:00:14",
                "scheduled_arrival": "1993-04-26 01:24:03",
                "scheduled_unload": "1990-01-21 07:13:42",
                "bulk": null,
                "tag": null,
                "device_id": null,
                "convoy_id": 9,
                "created_at": "2019-02-13 00:07:40",
                "updated_at": "2019-02-13 00:07:40"
            }
        ]
    },
    {
        "id": 10,
        "created_at": "2019-02-13 00:10:04",
        "updated_at": "2019-02-13 00:10:04",
        "trips": [
            {
                "id": 52,
                "rp": "Delia Gibson",
                "invoice": "11263",
                "client": "Zieme and Sons",
                "intermediary": "Daugherty Group",
                "origin_id": "100",
                "destination_id": "101",
                "mon_type": "3",
                "line": "Goodwin, Rau and Berge",
                "scheduled_load": "1970-05-29 16:03:59",
                "scheduled_departure": "1990-12-14 22:46:48",
                "scheduled_arrival": "2004-03-26 11:52:27",
                "scheduled_unload": "2004-02-17 23:57:50",
                "bulk": null,
                "tag": null,
                "device_id": null,
                "convoy_id": 10,
                "created_at": "2019-02-13 00:10:04",
                "updated_at": "2019-02-13 00:10:04"
            },
            {
                "id": 53,
                "rp": "Dashawn Wintheiser",
                "invoice": "89288",
                "client": "Mohr-Barton",
                "intermediary": "Deckow Inc",
                "origin_id": "102",
                "destination_id": "103",
                "mon_type": "9",
                "line": "Tremblay-Borer",
                "scheduled_load": "1993-03-23 17:14:00",
                "scheduled_departure": "1984-09-03 21:04:35",
                "scheduled_arrival": "1983-11-09 02:33:39",
                "scheduled_unload": "2006-02-16 09:15:37",
                "bulk": null,
                "tag": null,
                "device_id": null,
                "convoy_id": 10,
                "created_at": "2019-02-13 00:10:04",
                "updated_at": "2019-02-13 00:10:04"
            },
            {
                "id": 54,
                "rp": "Jayda Stamm",
                "invoice": "70882",
                "client": "Pfannerstill-King",
                "intermediary": "Tillman Group",
                "origin_id": "104",
                "destination_id": "105",
                "mon_type": "9",
                "line": "Ritchie Inc",
                "scheduled_load": "1972-03-13 18:09:38",
                "scheduled_departure": "1988-08-02 08:34:32",
                "scheduled_arrival": "2008-04-21 15:32:16",
                "scheduled_unload": "2015-08-27 08:26:26",
                "bulk": null,
                "tag": null,
                "device_id": null,
                "convoy_id": 10,
                "created_at": "2019-02-13 00:10:04",
                "updated_at": "2019-02-13 00:10:04"
            }
        ]
    },
    {
        "id": 11,
        "created_at": "2019-02-13 00:10:04",
        "updated_at": "2019-02-13 00:10:04",
        "trips": [
            {
                "id": 55,
                "rp": "Dr. Arlo Gorczany PhD",
                "invoice": "41405",
                "client": "Beier-Dicki",
                "intermediary": "Rosenbaum PLC",
                "origin_id": "106",
                "destination_id": "107",
                "mon_type": "2",
                "line": "Wilkinson and Sons",
                "scheduled_load": "2004-07-04 00:23:17",
                "scheduled_departure": "1985-12-10 05:51:48",
                "scheduled_arrival": "2014-03-01 02:48:32",
                "scheduled_unload": "2005-04-25 09:25:54",
                "bulk": null,
                "tag": null,
                "device_id": null,
                "convoy_id": 11,
                "created_at": "2019-02-13 00:10:04",
                "updated_at": "2019-02-13 00:10:04"
            },
            {
                "id": 56,
                "rp": "Rhoda Kunde",
                "invoice": "32029",
                "client": "Schuster, Becker and Ledner",
                "intermediary": "Ryan, Gulgowski and Russel",
                "origin_id": "108",
                "destination_id": "109",
                "mon_type": "1",
                "line": "Spinka and Sons",
                "scheduled_load": "1985-08-02 16:28:23",
                "scheduled_departure": "1982-10-26 19:07:19",
                "scheduled_arrival": "1978-09-28 06:36:32",
                "scheduled_unload": "1979-11-12 01:41:56",
                "bulk": null,
                "tag": null,
                "device_id": null,
                "convoy_id": 11,
                "created_at": "2019-02-13 00:10:04",
                "updated_at": "2019-02-13 00:10:04"
            },
            {
                "id": 57,
                "rp": "Austin Swaniawski",
                "invoice": "91699",
                "client": "Murray PLC",
                "intermediary": "Schamberger-Weber",
                "origin_id": "110",
                "destination_id": "111",
                "mon_type": "7",
                "line": "Kohler-Eichmann",
                "scheduled_load": "1997-02-10 06:57:01",
                "scheduled_departure": "2003-03-04 16:37:40",
                "scheduled_arrival": "2008-09-09 05:06:34",
                "scheduled_unload": "1980-05-02 11:59:43",
                "bulk": null,
                "tag": null,
                "device_id": null,
                "convoy_id": 11,
                "created_at": "2019-02-13 00:10:04",
                "updated_at": "2019-02-13 00:10:04"
            }
        ]
    },
    {
        "id": 12,
        "created_at": "2019-02-13 00:10:04",
        "updated_at": "2019-02-13 00:10:04",
        "trips": [
            {
                "id": 58,
                "rp": "Prof. Taya Bartoletti",
                "invoice": "77239",
                "client": "Reichel-Mueller",
                "intermediary": "Welch-Nolan",
                "origin_id": "112",
                "destination_id": "113",
                "mon_type": "2",
                "line": "Howell Inc",
                "scheduled_load": "1987-11-22 06:40:40",
                "scheduled_departure": "2017-06-11 00:21:21",
                "scheduled_arrival": "1982-05-15 20:13:50",
                "scheduled_unload": "1985-12-17 19:49:14",
                "bulk": null,
                "tag": null,
                "device_id": null,
                "convoy_id": 12,
                "created_at": "2019-02-13 00:10:04",
                "updated_at": "2019-02-13 00:10:04"
            },
            {
                "id": 59,
                "rp": "Prof. Irwin Hirthe IV",
                "invoice": "56838",
                "client": "Raynor, Gleason and Lubowitz",
                "intermediary": "Sipes-Aufderhar",
                "origin_id": "114",
                "destination_id": "115",
                "mon_type": "4",
                "line": "Mayer PLC",
                "scheduled_load": "2015-03-06 01:04:04",
                "scheduled_departure": "1976-01-21 16:56:14",
                "scheduled_arrival": "2004-02-18 22:29:32",
                "scheduled_unload": "1991-02-27 20:14:09",
                "bulk": null,
                "tag": null,
                "device_id": null,
                "convoy_id": 12,
                "created_at": "2019-02-13 00:10:04",
                "updated_at": "2019-02-13 00:10:04"
            },
            {
                "id": 60,
                "rp": "Miss Dolores Reichel III",
                "invoice": "13948",
                "client": "Vandervort, Sipes and Kessler",
                "intermediary": "Roob-Veum",
                "origin_id": "116",
                "destination_id": "117",
                "mon_type": "1",
                "line": "Bashirian Group",
                "scheduled_load": "2017-02-12 21:12:04",
                "scheduled_departure": "2004-12-03 18:04:28",
                "scheduled_arrival": "1997-05-04 16:21:38",
                "scheduled_unload": "1991-12-18 02:41:40",
                "bulk": null,
                "tag": null,
                "device_id": null,
                "convoy_id": 12,
                "created_at": "2019-02-13 00:10:04",
                "updated_at": "2019-02-13 00:10:04"
            }
        ]
    }
]
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
    "data": [
        {
            "id": 1,
            "gps": "Flatley-Rowe",
            "plate": "9507296",
            "internal_number": "9826963014",
            "carrier_id": 71
        },
        {
            "id": 2,
            "gps": "Macejkovic-Thiel",
            "plate": "3105233",
            "internal_number": "6483198509",
            "carrier_id": 72
        },
        {
            "id": 3,
            "gps": "Parker Ltd",
            "plate": "829078",
            "internal_number": "5646748382",
            "carrier_id": 73
        },
        {
            "id": 4,
            "gps": "Yost-Weissnat",
            "plate": "4942403",
            "internal_number": "4680246534",
            "carrier_id": 74
        },
        {
            "id": 5,
            "gps": "Sawayn Group",
            "plate": "3244810",
            "internal_number": "1992711918",
            "carrier_id": 75
        },
        {
            "id": 6,
            "gps": "Lockman PLC",
            "plate": "4468863",
            "internal_number": "3873198472",
            "carrier_id": 76
        },
        {
            "id": 7,
            "gps": "Vandervort, Rempel and Kreiger",
            "plate": "6085767",
            "internal_number": "985005408",
            "carrier_id": 77
        }
    ],
    "links": {
        "first": "http:\/\/localhost\/api\/v1\/devices?page=1",
        "last": "http:\/\/localhost\/api\/v1\/devices?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 1,
        "path": "http:\/\/localhost\/api\/v1\/devices",
        "per_page": 15,
        "to": 7,
        "total": 7
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
    "data": [
        {
            "id": 1,
            "gps": "Flatley-Rowe",
            "plate": "9507296",
            "internal_number": "9826963014",
            "carrier_id": 71
        },
        {
            "id": 2,
            "gps": "Macejkovic-Thiel",
            "plate": "3105233",
            "internal_number": "6483198509",
            "carrier_id": 72
        },
        {
            "id": 3,
            "gps": "Parker Ltd",
            "plate": "829078",
            "internal_number": "5646748382",
            "carrier_id": 73
        },
        {
            "id": 4,
            "gps": "Yost-Weissnat",
            "plate": "4942403",
            "internal_number": "4680246534",
            "carrier_id": 74
        },
        {
            "id": 5,
            "gps": "Sawayn Group",
            "plate": "3244810",
            "internal_number": "1992711918",
            "carrier_id": 75
        },
        {
            "id": 6,
            "gps": "Lockman PLC",
            "plate": "4468863",
            "internal_number": "3873198472",
            "carrier_id": 76
        },
        {
            "id": 7,
            "gps": "Vandervort, Rempel and Kreiger",
            "plate": "6085767",
            "internal_number": "985005408",
            "carrier_id": 77
        }
    ],
    "links": {
        "first": "http:\/\/localhost\/api\/v1\/external\/devices?page=1",
        "last": "http:\/\/localhost\/api\/v1\/external\/devices?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 1,
        "path": "http:\/\/localhost\/api\/v1\/external\/devices",
        "per_page": 15,
        "to": 7,
        "total": 7
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
        "id": 1038,
        "name": "Eldridge Franecki",
        "lastname": "",
        "email": "velitigusikowski@example.net",
        "username": ""
    }
}
```

### HTTP Request
`GET api/v1/me`


<!-- END_d58be746f29144cb8a66c4e189fcb1e1 -->

<!-- START_6a0e5684f22e4fc2cc18bad45b5c2db9 -->
## api/v1/me/permissions

> Example request:

```bash
curl -X GET -G "http://localhost:8000/api/v1/me/permissions" \
    -H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/v1/me/permissions",
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
`GET api/v1/me/permissions`


<!-- END_6a0e5684f22e4fc2cc18bad45b5c2db9 -->

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
        },
        {
            "name": "Telly Brown",
            "phone": "(874) 833-5181 x25029",
            "active": false
        },
        {
            "name": "Dr. Everett Huel III",
            "phone": "1-779-251-8869 x048",
            "active": false
        },
        {
            "name": "Cooper Cremin IV",
            "phone": "510.802.0284",
            "active": false
        },
        {
            "name": "Nicole Boyer",
            "phone": "615.328.2037",
            "active": true
        },
        {
            "name": "Mr. Clemens Gottlieb",
            "phone": "835.869.0827 x7275",
            "active": true
        },
        {
            "name": "Prof. Joaquin Gleason",
            "phone": "563-328-0349",
            "active": true
        }
    ],
    "links": {
        "first": "http:\/\/localhost\/api\/v1\/operators?page=1",
        "last": "http:\/\/localhost\/api\/v1\/operators?page=2",
        "prev": null,
        "next": "http:\/\/localhost\/api\/v1\/operators?page=2"
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 2,
        "path": "http:\/\/localhost\/api\/v1\/operators",
        "per_page": 15,
        "to": 15,
        "total": 21
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
    "data": [
        {
            "name": "Winifred Hermiston",
            "person_in_charge": "Sasha Hintz",
            "address": "4034 Gregorio Fords Apt. 197\nNew Halie, CO 25794",
            "phone": "802-599-0818 x9799"
        },
        {
            "name": "Yvette Mante",
            "person_in_charge": "Prof. Kay Heathcote",
            "address": "238 Adriana Street Suite 282\nLeschmouth, AR 18893-5865",
            "phone": "889-369-2768"
        },
        {
            "name": "Avis Kovacek",
            "person_in_charge": "Ms. Maybell Robel III",
            "address": "7026 Ray Lock\nHartmannside, MO 11343-9587",
            "phone": "(343) 344-1043"
        },
        {
            "name": "Mathias Kerluke",
            "person_in_charge": "Mr. Cale Auer II",
            "address": "8092 Schiller Pines\nMarilynechester, OH 80884-1513",
            "phone": "(405) 352-2890 x1625"
        },
        {
            "name": "Ms. Rosina Bogan",
            "person_in_charge": "Misael Mitchell",
            "address": "950 Brandi Hollow Apt. 570\nLake Evanland, GA 67925-0017",
            "phone": "589-446-0004 x069"
        },
        {
            "name": "Flavio Roob",
            "person_in_charge": "Jacques Borer",
            "address": "6232 Angus Forges Suite 024\nPort Taylorhaven, KS 14894-6259",
            "phone": "463.388.6164 x36771"
        },
        {
            "name": "Ms. Alexane Brown",
            "person_in_charge": "Karli Auer",
            "address": "51214 Velma Rue\nSouth Ignatius, KS 94216",
            "phone": "1-760-941-4960"
        },
        {
            "name": "Ms. Janice Koss",
            "person_in_charge": "Shania Sporer",
            "address": "860 Roy Field Suite 867\nWest Neil, IL 74403-9016",
            "phone": "1-241-339-0892"
        },
        {
            "name": "Miss Maybelle Jerde IV",
            "person_in_charge": "Hosea Grimes",
            "address": "507 Vickie Brook\nWest Guido, UT 27883",
            "phone": "1-695-971-1459 x195"
        },
        {
            "name": "Linwood Ondricka",
            "person_in_charge": "Dr. Kianna Greenholt",
            "address": "4381 Savion Ways Apt. 109\nNorth Jordyview, WA 60937",
            "phone": "685-550-5867"
        },
        {
            "name": "Osvaldo Kuhn",
            "person_in_charge": "Ms. Jacklyn Stokes",
            "address": "2686 Marilyne Mews\nMcGlynnberg, HI 39698-9290",
            "phone": "+1-861-787-3244"
        },
        {
            "name": "Prof. Buck Beahan",
            "person_in_charge": "Clara Sanford PhD",
            "address": "22326 Emmie Ranch Apt. 135\nLake Ernesto, TX 88441-2572",
            "phone": "(994) 346-5086"
        },
        {
            "name": "Dr. Domenic O'Conner II",
            "person_in_charge": "Jeromy Turner",
            "address": "8852 Hudson Expressway\nDedrickmouth, IA 62364",
            "phone": "206.942.1037 x09432"
        },
        {
            "name": "Wyman Koepp",
            "person_in_charge": "Fabiola Mueller",
            "address": "84765 Marquardt Ridge\nNorth Demetrismouth, NY 08909-2799",
            "phone": "603.335.8865"
        },
        {
            "name": "Prof. Elva Hahn",
            "person_in_charge": "Keith Stark",
            "address": "2040 Bahringer Freeway\nPort Triston, MD 54725-8700",
            "phone": "286.759.5034"
        }
    ],
    "links": {
        "first": "http:\/\/localhost\/api\/v1\/places?page=1",
        "last": "http:\/\/localhost\/api\/v1\/places?page=9",
        "prev": null,
        "next": "http:\/\/localhost\/api\/v1\/places?page=2"
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 9,
        "path": "http:\/\/localhost\/api\/v1\/places",
        "per_page": 15,
        "to": 15,
        "total": 128
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
    },
    {
        "id": 3,
        "name": "Loyalearum",
        "guard_name": "api",
        "created_at": "2019-02-08 07:14:10",
        "updated_at": "2019-02-08 07:14:10"
    },
    {
        "id": 4,
        "name": "willis.mclaughlin",
        "guard_name": "web",
        "created_at": "2019-02-08 07:14:10",
        "updated_at": "2019-02-08 07:14:10"
    },
    {
        "id": 5,
        "name": "ashley.willms",
        "guard_name": "web",
        "created_at": "2019-02-08 07:14:10",
        "updated_at": "2019-02-08 07:14:10"
    },
    {
        "id": 6,
        "name": "littel.ludie",
        "guard_name": "web",
        "created_at": "2019-02-08 07:14:10",
        "updated_at": "2019-02-08 07:14:10"
    },
    {
        "id": 8,
        "name": "ellsworth.prosacco",
        "guard_name": "web",
        "created_at": "2019-02-08 07:14:43",
        "updated_at": "2019-02-08 07:14:43"
    },
    {
        "id": 9,
        "name": "antwon.gerhold",
        "guard_name": "web",
        "created_at": "2019-02-08 07:14:43",
        "updated_at": "2019-02-08 07:14:43"
    },
    {
        "id": 10,
        "name": "sawayn.maribel",
        "guard_name": "web",
        "created_at": "2019-02-08 07:14:43",
        "updated_at": "2019-02-08 07:14:43"
    },
    {
        "id": 11,
        "name": "Keenannihil",
        "guard_name": "api",
        "created_at": "2019-02-13 00:04:47",
        "updated_at": "2019-02-13 00:04:47"
    },
    {
        "id": 12,
        "name": "dakota68",
        "guard_name": "web",
        "created_at": "2019-02-13 00:04:47",
        "updated_at": "2019-02-13 00:04:47"
    },
    {
        "id": 13,
        "name": "garry.schmidt",
        "guard_name": "web",
        "created_at": "2019-02-13 00:04:48",
        "updated_at": "2019-02-13 00:04:48"
    },
    {
        "id": 14,
        "name": "vbartell",
        "guard_name": "web",
        "created_at": "2019-02-13 00:04:48",
        "updated_at": "2019-02-13 00:04:48"
    },
    {
        "id": 16,
        "name": "Thurmansapiente",
        "guard_name": "api",
        "created_at": "2019-02-13 00:07:57",
        "updated_at": "2019-02-13 00:07:57"
    },
    {
        "id": 17,
        "name": "gage.casper",
        "guard_name": "web",
        "created_at": "2019-02-13 00:07:58",
        "updated_at": "2019-02-13 00:07:58"
    },
    {
        "id": 18,
        "name": "kristy33",
        "guard_name": "web",
        "created_at": "2019-02-13 00:07:58",
        "updated_at": "2019-02-13 00:07:58"
    },
    {
        "id": 19,
        "name": "myrna.stehr",
        "guard_name": "web",
        "created_at": "2019-02-13 00:07:58",
        "updated_at": "2019-02-13 00:07:58"
    },
    {
        "id": 21,
        "name": "Raheemvoluptatem",
        "guard_name": "api",
        "created_at": "2019-02-13 00:10:23",
        "updated_at": "2019-02-13 00:10:23"
    },
    {
        "id": 22,
        "name": "amalia.mccullough",
        "guard_name": "web",
        "created_at": "2019-02-13 00:10:23",
        "updated_at": "2019-02-13 00:10:23"
    },
    {
        "id": 23,
        "name": "mckayla.crooks",
        "guard_name": "web",
        "created_at": "2019-02-13 00:10:23",
        "updated_at": "2019-02-13 00:10:23"
    },
    {
        "id": 24,
        "name": "barney03",
        "guard_name": "web",
        "created_at": "2019-02-13 00:10:23",
        "updated_at": "2019-02-13 00:10:23"
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
        "wialon_key": "5dce19710a5e26ab8b7b8986cb3c49e58C291791B7F0A7AEB8AFBFCEED7DC03BC48FF5F8"
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
    "data": [
        {
            "id": 67,
            "rp": "Abelardo Schowalter",
            "invoice": "86590",
            "client": "Kutch-Olson",
            "intermediary": "Hammes and Sons",
            "origin_id": "129",
            "destination_id": "130",
            "mon_type": "9",
            "line": "Mohr, Weissnat and Haley",
            "scheduled_load": {
                "date": "2006-10-04 00:20:19.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "scheduled_departure": {
                "date": "2002-04-19 18:49:05.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "scheduled_arrival": {
                "date": "1998-12-23 08:26:57.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "scheduled_unload": {
                "date": "2007-10-06 22:57:33.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "bulk": null,
            "tag": "riesgo",
            "device_id": null,
            "convoy_id": null
        },
        {
            "id": 68,
            "rp": "Darryl Schinner DVM",
            "invoice": "38074",
            "client": "Schaden Ltd",
            "intermediary": "Lueilwitz, Kohler and Schmidt",
            "origin_id": "131",
            "destination_id": "132",
            "mon_type": "8",
            "line": "Mitchell PLC",
            "scheduled_load": {
                "date": "1992-03-04 09:55:14.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "scheduled_departure": {
                "date": "1978-01-08 17:14:47.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "scheduled_arrival": {
                "date": "2004-08-25 19:17:12.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "scheduled_unload": {
                "date": "1980-08-01 10:56:23.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "bulk": null,
            "tag": "riesgo",
            "device_id": null,
            "convoy_id": null
        },
        {
            "id": 61,
            "rp": "Dr. Damaris Schimmel II",
            "invoice": "41159",
            "client": "Stoltenberg, Pfannerstill and Legros",
            "intermediary": "Kovacek-Pollich",
            "origin_id": "123",
            "destination_id": "124",
            "mon_type": "0",
            "line": "Kertzmann-Grady",
            "scheduled_load": {
                "date": "1989-05-17 23:11:42.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "scheduled_departure": {
                "date": "1986-01-15 18:56:31.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "scheduled_arrival": {
                "date": "2005-04-27 02:32:17.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "scheduled_unload": {
                "date": "1983-12-15 01:08:50.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "bulk": null,
            "tag": null,
            "device_id": null,
            "convoy_id": null
        },
        {
            "id": 62,
            "rp": "Beaulah Grant",
            "invoice": "56820",
            "client": "Hill, Herzog and Block",
            "intermediary": "Gleichner, Herman and Adams",
            "origin_id": "125",
            "destination_id": "126",
            "mon_type": "1",
            "line": "Zemlak-Schultz",
            "scheduled_load": {
                "date": "1983-11-12 01:32:21.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "scheduled_departure": {
                "date": "2011-05-25 03:43:11.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "scheduled_arrival": {
                "date": "1988-02-04 11:45:07.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "scheduled_unload": {
                "date": "1999-05-24 03:25:37.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "bulk": null,
            "tag": null,
            "device_id": null,
            "convoy_id": null
        },
        {
            "id": 63,
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
                "rp": "Santos Murazik",
                "invoice": 14550,
                "client": "Lebsack-Stanton",
                "intermediary": "Robel Ltd",
                "origin": "156 Cydney Prairie\nLeonorborough, AZ 68866-2837",
                "destination": "7879 Ray Circles\nRosellaberg, RI 52832",
                "mon_type": 3,
                "line": "Schowalter PLC",
                "scheduled_load": "2019-02-13 00:10:25",
                "scheduled_departure": "2019-02-14 00:10:25",
                "scheduled_arrival": "2019-02-15 00:10:25",
                "scheduled_unload": "2019-02-16 00:10:25"
            },
            "tag": null,
            "device_id": null,
            "convoy_id": null
        },
        {
            "id": 64,
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
                "rp": "Prof. Luis Quitzon II",
                "invoice": 61104,
                "client": "Hintz-Schultz",
                "intermediary": "Bernhard-Fahey",
                "origin": "75036 Torp Roads Suite 451\nMurrayshire, OH 25539",
                "destination": "171 Gage Skyway Apt. 451\nParkerfurt, ME 43965",
                "mon_type": 0,
                "line": "Luettgen, Armstrong and Klocko",
                "scheduled_load": "2019-02-13 00:10:25",
                "scheduled_departure": "2019-02-14 00:10:25",
                "scheduled_arrival": "2019-02-15 00:10:25",
                "scheduled_unload": "2019-02-16 00:10:25"
            },
            "tag": null,
            "device_id": null,
            "convoy_id": null
        },
        {
            "id": 66,
            "rp": "Dr. Vern Moen",
            "invoice": "34641",
            "client": "McCullough-Reynolds",
            "intermediary": "Metz Group",
            "origin_id": "127",
            "destination_id": "128",
            "mon_type": "2",
            "line": "Johnson Inc",
            "scheduled_load": {
                "date": "1976-04-02 17:17:58.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "scheduled_departure": {
                "date": "1981-06-14 00:07:11.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "scheduled_arrival": {
                "date": "1995-03-19 12:02:43.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "scheduled_unload": {
                "date": "1971-03-03 14:13:07.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "bulk": null,
            "tag": null,
            "device_id": null,
            "convoy_id": null
        },
        {
            "id": 52,
            "rp": "Delia Gibson",
            "invoice": "11263",
            "client": "Zieme and Sons",
            "intermediary": "Daugherty Group",
            "origin_id": "100",
            "destination_id": "101",
            "mon_type": "3",
            "line": "Goodwin, Rau and Berge",
            "scheduled_load": {
                "date": "1970-05-29 16:03:59.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "scheduled_departure": {
                "date": "1990-12-14 22:46:48.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "scheduled_arrival": {
                "date": "2004-03-26 11:52:27.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "scheduled_unload": {
                "date": "2004-02-17 23:57:50.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "bulk": null,
            "tag": null,
            "device_id": null,
            "convoy_id": 10
        },
        {
            "id": 53,
            "rp": "Dashawn Wintheiser",
            "invoice": "89288",
            "client": "Mohr-Barton",
            "intermediary": "Deckow Inc",
            "origin_id": "102",
            "destination_id": "103",
            "mon_type": "9",
            "line": "Tremblay-Borer",
            "scheduled_load": {
                "date": "1993-03-23 17:14:00.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "scheduled_departure": {
                "date": "1984-09-03 21:04:35.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "scheduled_arrival": {
                "date": "1983-11-09 02:33:39.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "scheduled_unload": {
                "date": "2006-02-16 09:15:37.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "bulk": null,
            "tag": null,
            "device_id": null,
            "convoy_id": 10
        },
        {
            "id": 54,
            "rp": "Jayda Stamm",
            "invoice": "70882",
            "client": "Pfannerstill-King",
            "intermediary": "Tillman Group",
            "origin_id": "104",
            "destination_id": "105",
            "mon_type": "9",
            "line": "Ritchie Inc",
            "scheduled_load": {
                "date": "1972-03-13 18:09:38.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "scheduled_departure": {
                "date": "1988-08-02 08:34:32.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "scheduled_arrival": {
                "date": "2008-04-21 15:32:16.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "scheduled_unload": {
                "date": "2015-08-27 08:26:26.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "bulk": null,
            "tag": null,
            "device_id": null,
            "convoy_id": 10
        },
        {
            "id": 55,
            "rp": "Dr. Arlo Gorczany PhD",
            "invoice": "41405",
            "client": "Beier-Dicki",
            "intermediary": "Rosenbaum PLC",
            "origin_id": "106",
            "destination_id": "107",
            "mon_type": "2",
            "line": "Wilkinson and Sons",
            "scheduled_load": {
                "date": "2004-07-04 00:23:17.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "scheduled_departure": {
                "date": "1985-12-10 05:51:48.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "scheduled_arrival": {
                "date": "2014-03-01 02:48:32.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "scheduled_unload": {
                "date": "2005-04-25 09:25:54.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "bulk": null,
            "tag": null,
            "device_id": null,
            "convoy_id": 11
        },
        {
            "id": 56,
            "rp": "Rhoda Kunde",
            "invoice": "32029",
            "client": "Schuster, Becker and Ledner",
            "intermediary": "Ryan, Gulgowski and Russel",
            "origin_id": "108",
            "destination_id": "109",
            "mon_type": "1",
            "line": "Spinka and Sons",
            "scheduled_load": {
                "date": "1985-08-02 16:28:23.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "scheduled_departure": {
                "date": "1982-10-26 19:07:19.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "scheduled_arrival": {
                "date": "1978-09-28 06:36:32.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "scheduled_unload": {
                "date": "1979-11-12 01:41:56.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "bulk": null,
            "tag": null,
            "device_id": null,
            "convoy_id": 11
        },
        {
            "id": 57,
            "rp": "Austin Swaniawski",
            "invoice": "91699",
            "client": "Murray PLC",
            "intermediary": "Schamberger-Weber",
            "origin_id": "110",
            "destination_id": "111",
            "mon_type": "7",
            "line": "Kohler-Eichmann",
            "scheduled_load": {
                "date": "1997-02-10 06:57:01.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "scheduled_departure": {
                "date": "2003-03-04 16:37:40.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "scheduled_arrival": {
                "date": "2008-09-09 05:06:34.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "scheduled_unload": {
                "date": "1980-05-02 11:59:43.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "bulk": null,
            "tag": null,
            "device_id": null,
            "convoy_id": 11
        },
        {
            "id": 58,
            "rp": "Prof. Taya Bartoletti",
            "invoice": "77239",
            "client": "Reichel-Mueller",
            "intermediary": "Welch-Nolan",
            "origin_id": "112",
            "destination_id": "113",
            "mon_type": "2",
            "line": "Howell Inc",
            "scheduled_load": {
                "date": "1987-11-22 06:40:40.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "scheduled_departure": {
                "date": "2017-06-11 00:21:21.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "scheduled_arrival": {
                "date": "1982-05-15 20:13:50.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "scheduled_unload": {
                "date": "1985-12-17 19:49:14.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "bulk": null,
            "tag": null,
            "device_id": null,
            "convoy_id": 12
        },
        {
            "id": 59,
            "rp": "Prof. Irwin Hirthe IV",
            "invoice": "56838",
            "client": "Raynor, Gleason and Lubowitz",
            "intermediary": "Sipes-Aufderhar",
            "origin_id": "114",
            "destination_id": "115",
            "mon_type": "4",
            "line": "Mayer PLC",
            "scheduled_load": {
                "date": "2015-03-06 01:04:04.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "scheduled_departure": {
                "date": "1976-01-21 16:56:14.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "scheduled_arrival": {
                "date": "2004-02-18 22:29:32.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "scheduled_unload": {
                "date": "1991-02-27 20:14:09.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "bulk": null,
            "tag": null,
            "device_id": null,
            "convoy_id": 12
        }
    ],
    "links": {
        "first": "http:\/\/localhost\/api\/v1\/trips?page=1",
        "last": "http:\/\/localhost\/api\/v1\/trips?page=5",
        "prev": null,
        "next": "http:\/\/localhost\/api\/v1\/trips?page=2"
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 5,
        "path": "http:\/\/localhost\/api\/v1\/trips",
        "per_page": 15,
        "to": 15,
        "total": 64
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
        -d "scheduled_load"="1996-01-27" \
        -d "scheduled_departure"="Sunday, 28-Jan-96 00:00:00 UTC" \
        -d "scheduled_arrival"="Monday, 29-Jan-96 00:00:00 UTC" \
        -d "scheduled_unload"="Tuesday, 30-Jan-96 00:00:00 UTC" 
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
        "scheduled_load": "1996-01-27",
        "scheduled_departure": "Sunday, 28-Jan-96 00:00:00 UTC",
        "scheduled_arrival": "Monday, 29-Jan-96 00:00:00 UTC",
        "scheduled_unload": "Tuesday, 30-Jan-96 00:00:00 UTC"
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
        -d "scheduled_load"="1987-11-05" \
        -d "scheduled_departure"="Friday, 06-Nov-87 00:00:00 UTC" \
        -d "scheduled_arrival"="Saturday, 07-Nov-87 00:00:00 UTC" \
        -d "scheduled_unload"="Sunday, 08-Nov-87 00:00:00 UTC" 
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
        "scheduled_load": "1987-11-05",
        "scheduled_departure": "Friday, 06-Nov-87 00:00:00 UTC",
        "scheduled_arrival": "Saturday, 07-Nov-87 00:00:00 UTC",
        "scheduled_unload": "Sunday, 08-Nov-87 00:00:00 UTC"
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
            "name": "Audi RS8",
            "id": 734477,
            "measure_units": 0,
            "position": {
                "lat": 52.32188,
                "lon": 9.80264
            }
        },
        {
            "name": "Audi_retr",
            "id": 717361,
            "measure_units": 0,
            "position": {
                "lat": 53.8662383333,
                "lon": 27.4363433333
            }
        },
        {
            "name": "Bennie Champlin4469",
            "id": 18759632,
            "measure_units": 0
        },
        {
            "name": "Berneice Towne II20986",
            "id": 18759631,
            "measure_units": 0
        },
        {
            "name": "BicicletaChema",
            "id": 18215090,
            "measure_units": 0
        },
        {
            "name": "BicicletaChema",
            "id": 18665526,
            "measure_units": 0
        },
        {
            "name": "BicicletaChema",
            "id": 18665568,
            "measure_units": 0
        },
        {
            "name": "BicicletaChema",
            "id": 18666557,
            "measure_units": 0
        },
        {
            "name": "BicicletaChema",
            "id": 18667840,
            "measure_units": 0
        },
        {
            "name": "BicicletaPunksolid",
            "id": 18158577,
            "measure_units": 0
        },
        {
            "name": "BicicletaPunksolid",
            "id": 18158571,
            "measure_units": 0
        },
        {
            "name": "BicicletaPunksolid",
            "id": 18158570,
            "measure_units": 0
        },
        {
            "name": "BicicletaPunksolid",
            "id": 18158556,
            "measure_units": 0
        },
        {
            "name": "BicicletaPunksolid",
            "id": 18158564,
            "measure_units": 0
        },
        {
            "name": "BicicletaPunksolid",
            "id": 18158566,
            "measure_units": 0
        },
        {
            "name": "BicicletaPunksolid2",
            "id": 18158605,
            "measure_units": 0
        },
        {
            "name": "BicicletaPunksolid2",
            "id": 18158604,
            "measure_units": 0
        },
        {
            "name": "BicicletaPunksolid8",
            "id": 18158698,
            "measure_units": 0
        },
        {
            "name": "BicicletaPunksolid8",
            "id": 18158700,
            "measure_units": 0
        },
        {
            "name": "BicicletaPunksolid15",
            "id": 18158650,
            "measure_units": 0
        },
        {
            "name": "BicicletaPunksolid15",
            "id": 18158664,
            "measure_units": 0
        },
        {
            "name": "BicicletaPunksolid15",
            "id": 18158671,
            "measure_units": 0
        },
        {
            "name": "BicicletaPunksolid15",
            "id": 18158625,
            "measure_units": 0
        },
        {
            "name": "Buick Skylark Convertible",
            "id": 734455,
            "measure_units": 0,
            "position": {
                "lat": 52.3211272307,
                "lon": 9.80878472328
            }
        },
        {
            "name": "Bulah Wintheiser57156",
            "id": 18759537,
            "measure_units": 0
        },
        {
            "name": "Camaro",
            "id": 13795771,
            "measure_units": 0
        },
        {
            "name": "Chevrolet El Camino",
            "id": 734422,
            "measure_units": 0,
            "position": {
                "lat": 53.92286,
                "lon": 27.46748
            }
        },
        {
            "name": "Cleve Donnelly IV86758",
            "id": 18759535,
            "measure_units": 0
        },
        {
            "name": "Dodge M4S Turbo Interceptor",
            "id": 734459,
            "measure_units": 0,
            "position": {
                "lat": 52.3217142,
                "lon": 9.8017359
            }
        },
        {
            "name": "Dr. Aurelio Hackett Sr.44893",
            "id": 18759337,
            "measure_units": 0
        },
        {
            "name": "Dr. Lamar Bailey Sr.24676",
            "id": 18759539,
            "measure_units": 0
        },
        {
            "name": "Drew Roberts III15560",
            "id": 18759538,
            "measure_units": 0
        },
        {
            "name": "Elta Nader40675",
            "id": 18759388,
            "measure_units": 0
        },
        {
            "name": "GOL 2",
            "id": 13791580,
            "measure_units": 0
        },
        {
            "name": "Gunnar Mueller12883",
            "id": 18759626,
            "measure_units": 0
        },
        {
            "name": "Hayden Hoppe9479",
            "id": 18759649,
            "measure_units": 0
        },
        {
            "name": "Jetta",
            "id": 13795823,
            "measure_units": 0
        },
        {
            "name": "Krista Rath MD21043",
            "id": 18759389,
            "measure_units": 0
        },
        {
            "name": "Layne Monahan60962",
            "id": 18759635,
            "measure_units": 0
        },
        {
            "name": "Maudie Lindgren78228",
            "id": 18759541,
            "measure_units": 0
        },
        {
            "name": "Mr. Kieran Barrows MD44283",
            "id": 18759372,
            "measure_units": 0
        },
        {
            "name": "Mr. Nathaniel Labadie21700",
            "id": 18759633,
            "measure_units": 0
        },
        {
            "name": "Ms. Aniya Abshire35456",
            "id": 18759621,
            "measure_units": 0
        },
        {
            "name": "Prof. Elmer Ziemann DVM77833",
            "id": 18759370,
            "measure_units": 0
        },
        {
            "name": "red_gol",
            "id": 13684162,
            "measure_units": 0
        },
        {
            "name": "Sony phone",
            "id": 12813574,
            "measure_units": 0,
            "position": {
                "lat": 26.8410364333,
                "lon": 80.9399277833
            }
        },
        {
            "name": "test2",
            "id": 18118085,
            "measure_units": 0
        },
        {
            "name": "TestE3",
            "id": 6582733,
            "measure_units": 0,
            "position": {
                "lat": 47.1004316,
                "lon": 17.54746
            }
        },
        {
            "name": "tttt",
            "id": 18118088,
            "measure_units": 0
        },
        {
            "name": "Volvo FH 460",
            "id": 6582726,
            "measure_units": 0,
            "position": {
                "lat": 47.044432,
                "lon": 17.3282192
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
            "name": "Audi RS8",
            "id": 734477,
            "measure_units": 0,
            "position": {
                "lat": 52.32188,
                "lon": 9.80264
            }
        },
        {
            "name": "Audi_retr",
            "id": 717361,
            "measure_units": 0,
            "position": {
                "lat": 53.8662383333,
                "lon": 27.4363433333
            }
        },
        {
            "name": "Bennie Champlin4469",
            "id": 18759632,
            "measure_units": 0
        },
        {
            "name": "Berneice Towne II20986",
            "id": 18759631,
            "measure_units": 0
        },
        {
            "name": "BicicletaChema",
            "id": 18215090,
            "measure_units": 0
        },
        {
            "name": "BicicletaChema",
            "id": 18665526,
            "measure_units": 0
        },
        {
            "name": "BicicletaChema",
            "id": 18665568,
            "measure_units": 0
        },
        {
            "name": "BicicletaChema",
            "id": 18666557,
            "measure_units": 0
        },
        {
            "name": "BicicletaChema",
            "id": 18667840,
            "measure_units": 0
        },
        {
            "name": "BicicletaPunksolid",
            "id": 18158577,
            "measure_units": 0
        },
        {
            "name": "BicicletaPunksolid",
            "id": 18158571,
            "measure_units": 0
        },
        {
            "name": "BicicletaPunksolid",
            "id": 18158570,
            "measure_units": 0
        },
        {
            "name": "BicicletaPunksolid",
            "id": 18158556,
            "measure_units": 0
        },
        {
            "name": "BicicletaPunksolid",
            "id": 18158564,
            "measure_units": 0
        },
        {
            "name": "BicicletaPunksolid",
            "id": 18158566,
            "measure_units": 0
        },
        {
            "name": "BicicletaPunksolid2",
            "id": 18158605,
            "measure_units": 0
        },
        {
            "name": "BicicletaPunksolid2",
            "id": 18158604,
            "measure_units": 0
        },
        {
            "name": "BicicletaPunksolid8",
            "id": 18158698,
            "measure_units": 0
        },
        {
            "name": "BicicletaPunksolid8",
            "id": 18158700,
            "measure_units": 0
        },
        {
            "name": "BicicletaPunksolid15",
            "id": 18158650,
            "measure_units": 0
        },
        {
            "name": "BicicletaPunksolid15",
            "id": 18158664,
            "measure_units": 0
        },
        {
            "name": "BicicletaPunksolid15",
            "id": 18158671,
            "measure_units": 0
        },
        {
            "name": "BicicletaPunksolid15",
            "id": 18158625,
            "measure_units": 0
        },
        {
            "name": "Buick Skylark Convertible",
            "id": 734455,
            "measure_units": 0,
            "position": {
                "lat": 52.3211272307,
                "lon": 9.80878472328
            }
        },
        {
            "name": "Bulah Wintheiser57156",
            "id": 18759537,
            "measure_units": 0
        },
        {
            "name": "Camaro",
            "id": 13795771,
            "measure_units": 0
        },
        {
            "name": "Chevrolet El Camino",
            "id": 734422,
            "measure_units": 0,
            "position": {
                "lat": 53.92286,
                "lon": 27.46748
            }
        },
        {
            "name": "Cleve Donnelly IV86758",
            "id": 18759535,
            "measure_units": 0
        },
        {
            "name": "Dodge M4S Turbo Interceptor",
            "id": 734459,
            "measure_units": 0,
            "position": {
                "lat": 52.3217142,
                "lon": 9.8017359
            }
        },
        {
            "name": "Dr. Aurelio Hackett Sr.44893",
            "id": 18759337,
            "measure_units": 0
        },
        {
            "name": "Dr. Lamar Bailey Sr.24676",
            "id": 18759539,
            "measure_units": 0
        },
        {
            "name": "Drew Roberts III15560",
            "id": 18759538,
            "measure_units": 0
        },
        {
            "name": "Elta Nader40675",
            "id": 18759388,
            "measure_units": 0
        },
        {
            "name": "GOL 2",
            "id": 13791580,
            "measure_units": 0
        },
        {
            "name": "Gunnar Mueller12883",
            "id": 18759626,
            "measure_units": 0
        },
        {
            "name": "Hayden Hoppe9479",
            "id": 18759649,
            "measure_units": 0
        },
        {
            "name": "Jetta",
            "id": 13795823,
            "measure_units": 0
        },
        {
            "name": "Krista Rath MD21043",
            "id": 18759389,
            "measure_units": 0
        },
        {
            "name": "Layne Monahan60962",
            "id": 18759635,
            "measure_units": 0
        },
        {
            "name": "Maudie Lindgren78228",
            "id": 18759541,
            "measure_units": 0
        },
        {
            "name": "Mr. Kieran Barrows MD44283",
            "id": 18759372,
            "measure_units": 0
        },
        {
            "name": "Mr. Nathaniel Labadie21700",
            "id": 18759633,
            "measure_units": 0
        },
        {
            "name": "Ms. Aniya Abshire35456",
            "id": 18759621,
            "measure_units": 0
        },
        {
            "name": "Prof. Elmer Ziemann DVM77833",
            "id": 18759370,
            "measure_units": 0
        },
        {
            "name": "red_gol",
            "id": 13684162,
            "measure_units": 0
        },
        {
            "name": "Sony phone",
            "id": 12813574,
            "measure_units": 0,
            "position": {
                "lat": 26.8410364333,
                "lon": 80.9399277833
            }
        },
        {
            "name": "test2",
            "id": 18118085,
            "measure_units": 0
        },
        {
            "name": "TestE3",
            "id": 6582733,
            "measure_units": 0,
            "position": {
                "lat": 47.1004316,
                "lon": 17.54746
            }
        },
        {
            "name": "tttt",
            "id": 18118088,
            "measure_units": 0
        },
        {
            "name": "Volvo FH 460",
            "id": 6582726,
            "measure_units": 0,
            "position": {
                "lat": 47.044432,
                "lon": 17.3282192
            }
        }
    ]
}
```

### HTTP Request
`GET api/v1/units/with_localization`


<!-- END_2784cc932141defd94d1f43c872ca40c -->

#User
<!-- START_f17be99bbced26c1b06d05a3802f3018 -->
## api/v1/me/change_password

> Example request:

```bash
curl -X POST "http://localhost:8000/api/v1/me/change_password" \
    -H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/v1/me/change_password",
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
`POST api/v1/me/change_password`


<!-- END_f17be99bbced26c1b06d05a3802f3018 -->

<!-- START_1aff981da377ba9a1bbc56ff8efaec0d -->
## Display a listing of the users.

filtra usuarios por parametros enviados via get query parameters: "name","email","lastname","username"

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
            "id": 1038,
            "name": "Eldridge Franecki",
            "lastname": "",
            "email": "velitigusikowski@example.net",
            "username": ""
        },
        {
            "id": 1036,
            "name": "Golden Ratke",
            "lastname": "",
            "email": "adraphaelle27@example.org",
            "username": ""
        },
        {
            "id": 1037,
            "name": "Lucy Swift",
            "lastname": "",
            "email": "illumokeefe.rebeca@example.org",
            "username": ""
        },
        {
            "id": 1034,
            "name": "Laura Price",
            "lastname": "",
            "email": "corruptiwkoss@example.com",
            "username": ""
        },
        {
            "id": 1035,
            "name": "Ernest Deckow V",
            "lastname": "",
            "email": "quisngrady@example.org",
            "username": ""
        },
        {
            "id": 1033,
            "name": "Josefa Greenfelder",
            "lastname": "",
            "email": "nequelhoppe@example.org",
            "username": ""
        },
        {
            "id": 1032,
            "name": "Camron Murazik",
            "lastname": "",
            "email": "sintkhammes@example.net",
            "username": ""
        },
        {
            "id": 1031,
            "name": "Mustafa Fay Jr.",
            "lastname": "",
            "email": "utfbrown@example.com",
            "username": ""
        },
        {
            "id": 1030,
            "name": "Randal Senger",
            "lastname": "",
            "email": "minimayeichmann@example.net",
            "username": ""
        },
        {
            "id": 1028,
            "name": "Dora Klocko II",
            "lastname": "",
            "email": "repellendusdon.hammes@example.net",
            "username": ""
        },
        {
            "id": 1029,
            "name": "Deven Mann",
            "lastname": "",
            "email": "nonkertzmann.diana@example.net",
            "username": ""
        },
        {
            "id": 1026,
            "name": "Pearlie Murazik III",
            "lastname": "",
            "email": "eumnzemlak@example.net",
            "username": ""
        },
        {
            "id": 1027,
            "name": "Ms. Amy Toy DVM",
            "lastname": "",
            "email": "injeff99@example.net",
            "username": ""
        },
        {
            "id": 1024,
            "name": "Prof. Simone Jacobson DDS",
            "lastname": "",
            "email": "commodistiedemann.kristina@example.net",
            "username": ""
        },
        {
            "id": 1025,
            "name": "Dion Cassin",
            "lastname": "",
            "email": "nihilbecker.devon@example.net",
            "username": ""
        }
    ],
    "links": {
        "first": "http:\/\/localhost\/api\/v1\/users?page=1",
        "last": "http:\/\/localhost\/api\/v1\/users?page=61",
        "prev": null,
        "next": "http:\/\/localhost\/api\/v1\/users?page=2"
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 61,
        "path": "http:\/\/localhost\/api\/v1\/users",
        "per_page": 15,
        "to": 15,
        "total": 913
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
            "name": "report_template_en",
            "id": 98141
        },
        {
            "name": "SdkDemo",
            "id": 717351
        },
        {
            "name": "punksolid@twitter.com",
            "id": 18145865
        },
        {
            "name": "punksolid_testaaa13",
            "id": 18547586
        },
        {
            "name": "unodostres",
            "id": 18665224
        },
        {
            "name": "new_one",
            "id": 18665333
        },
        {
            "name": "new_one_new",
            "id": 18665361
        },
        {
            "name": "new_one_new1",
            "id": 18665366
        },
        {
            "name": "dolordolor",
            "id": 18665521
        },
        {
            "name": "etamet",
            "id": 18665522
        },
        {
            "name": "quisqui",
            "id": 18665539
        },
        {
            "name": "veronecessitatibus",
            "id": 18665540
        },
        {
            "name": "sednesciunt",
            "id": 18665554
        },
        {
            "name": "quidemmollitia",
            "id": 18665555
        },
        {
            "name": "autdoloremque",
            "id": 18665560
        },
        {
            "name": "sedcupiditate",
            "id": 18665562
        },
        {
            "name": "aliquidassumenda",
            "id": 18666554
        },
        {
            "name": "Prof. Bobbie Gleichner IVMason Simonis",
            "id": 18666565
        },
        {
            "name": "Juvenal SchoenNoelia Nikolaus",
            "id": 18666569
        },
        {
            "name": "Sophia TreutelReta Bechtelar DDS",
            "id": 18666571
        },
        {
            "name": "Albertha StantonRhoda Murray",
            "id": 18666574
        },
        {
            "name": "Dr. Fidel Lindgren VJanessa Romaguera",
            "id": 18666581
        },
        {
            "name": "Ella GoldnerMarlin Hayes",
            "id": 18666637
        },
        {
            "name": "asdewd1similiqueeaarchitecto",
            "id": 18737602
        },
        {
            "name": "asdewd1remoccaecatiducimus",
            "id": 18737608
        },
        {
            "name": "asdewd1doloremqueillumet",
            "id": 18759271
        },
        {
            "name": "asdewd1quodblanditiisquidem",
            "id": 18759283
        },
        {
            "name": "asdewd1dolorumnesciuntquas",
            "id": 18759289
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
    "data": []
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
            "id": 734477,
            "nm": "Audi RS8",
            "name": "Audi RS8"
        },
        {
            "id": 717361,
            "nm": "Audi_retr",
            "name": "Audi_retr"
        },
        {
            "id": 18759632,
            "nm": "Bennie Champlin4469",
            "name": "Bennie Champlin4469"
        },
        {
            "id": 18759631,
            "nm": "Berneice Towne II20986",
            "name": "Berneice Towne II20986"
        },
        {
            "id": 18215090,
            "nm": "BicicletaChema",
            "name": "BicicletaChema"
        },
        {
            "id": 18665526,
            "nm": "BicicletaChema",
            "name": "BicicletaChema"
        },
        {
            "id": 18665568,
            "nm": "BicicletaChema",
            "name": "BicicletaChema"
        },
        {
            "id": 18666557,
            "nm": "BicicletaChema",
            "name": "BicicletaChema"
        },
        {
            "id": 18667840,
            "nm": "BicicletaChema",
            "name": "BicicletaChema"
        },
        {
            "id": 18158577,
            "nm": "BicicletaPunksolid",
            "name": "BicicletaPunksolid"
        },
        {
            "id": 18158571,
            "nm": "BicicletaPunksolid",
            "name": "BicicletaPunksolid"
        },
        {
            "id": 18158570,
            "nm": "BicicletaPunksolid",
            "name": "BicicletaPunksolid"
        },
        {
            "id": 18158556,
            "nm": "BicicletaPunksolid",
            "name": "BicicletaPunksolid"
        },
        {
            "id": 18158564,
            "nm": "BicicletaPunksolid",
            "name": "BicicletaPunksolid"
        },
        {
            "id": 18158566,
            "nm": "BicicletaPunksolid",
            "name": "BicicletaPunksolid"
        },
        {
            "id": 18158605,
            "nm": "BicicletaPunksolid2",
            "name": "BicicletaPunksolid2"
        },
        {
            "id": 18158604,
            "nm": "BicicletaPunksolid2",
            "name": "BicicletaPunksolid2"
        },
        {
            "id": 18158698,
            "nm": "BicicletaPunksolid8",
            "name": "BicicletaPunksolid8"
        },
        {
            "id": 18158700,
            "nm": "BicicletaPunksolid8",
            "name": "BicicletaPunksolid8"
        },
        {
            "id": 18158650,
            "nm": "BicicletaPunksolid15",
            "name": "BicicletaPunksolid15"
        },
        {
            "id": 18158664,
            "nm": "BicicletaPunksolid15",
            "name": "BicicletaPunksolid15"
        },
        {
            "id": 18158671,
            "nm": "BicicletaPunksolid15",
            "name": "BicicletaPunksolid15"
        },
        {
            "id": 18158625,
            "nm": "BicicletaPunksolid15",
            "name": "BicicletaPunksolid15"
        },
        {
            "id": 734455,
            "nm": "Buick Skylark Convertible",
            "name": "Buick Skylark Convertible"
        },
        {
            "id": 18759537,
            "nm": "Bulah Wintheiser57156",
            "name": "Bulah Wintheiser57156"
        },
        {
            "id": 13795771,
            "nm": "Camaro",
            "name": "Camaro"
        },
        {
            "id": 734422,
            "nm": "Chevrolet El Camino",
            "name": "Chevrolet El Camino"
        },
        {
            "id": 18759535,
            "nm": "Cleve Donnelly IV86758",
            "name": "Cleve Donnelly IV86758"
        },
        {
            "id": 734459,
            "nm": "Dodge M4S Turbo Interceptor",
            "name": "Dodge M4S Turbo Interceptor"
        },
        {
            "id": 18759337,
            "nm": "Dr. Aurelio Hackett Sr.44893",
            "name": "Dr. Aurelio Hackett Sr.44893"
        },
        {
            "id": 18759539,
            "nm": "Dr. Lamar Bailey Sr.24676",
            "name": "Dr. Lamar Bailey Sr.24676"
        },
        {
            "id": 18759538,
            "nm": "Drew Roberts III15560",
            "name": "Drew Roberts III15560"
        },
        {
            "id": 18759388,
            "nm": "Elta Nader40675",
            "name": "Elta Nader40675"
        },
        {
            "id": 13791580,
            "nm": "GOL 2",
            "name": "GOL 2"
        },
        {
            "id": 18759626,
            "nm": "Gunnar Mueller12883",
            "name": "Gunnar Mueller12883"
        },
        {
            "id": 18759649,
            "nm": "Hayden Hoppe9479",
            "name": "Hayden Hoppe9479"
        },
        {
            "id": 13795823,
            "nm": "Jetta",
            "name": "Jetta"
        },
        {
            "id": 18759389,
            "nm": "Krista Rath MD21043",
            "name": "Krista Rath MD21043"
        },
        {
            "id": 18759635,
            "nm": "Layne Monahan60962",
            "name": "Layne Monahan60962"
        },
        {
            "id": 18759541,
            "nm": "Maudie Lindgren78228",
            "name": "Maudie Lindgren78228"
        },
        {
            "id": 18759372,
            "nm": "Mr. Kieran Barrows MD44283",
            "name": "Mr. Kieran Barrows MD44283"
        },
        {
            "id": 18759633,
            "nm": "Mr. Nathaniel Labadie21700",
            "name": "Mr. Nathaniel Labadie21700"
        },
        {
            "id": 18759621,
            "nm": "Ms. Aniya Abshire35456",
            "name": "Ms. Aniya Abshire35456"
        },
        {
            "id": 18759370,
            "nm": "Prof. Elmer Ziemann DVM77833",
            "name": "Prof. Elmer Ziemann DVM77833"
        },
        {
            "id": 13684162,
            "nm": "red_gol",
            "name": "red_gol"
        },
        {
            "id": 12813574,
            "nm": "Sony phone",
            "name": "Sony phone"
        },
        {
            "id": 18118085,
            "nm": "test2",
            "name": "test2"
        },
        {
            "id": 6582733,
            "nm": "TestE3",
            "name": "TestE3"
        },
        {
            "id": 18118088,
            "nm": "tttt",
            "name": "tttt"
        },
        {
            "id": 6582726,
            "nm": "Volvo FH 460",
            "name": "Volvo FH 460"
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

<!-- START_9b9936e5bc62f136bc41e777ce4ee24a -->
## Reset the given user&#039;s password.

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


