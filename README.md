Endpoints:

|Endpoint              | Method     | Auth | Note                        |
| -------------------- | ---------- | ---- | --------------------------- |
|\users\login          | POST       |      | add new user                |     x
|\users                | GET        |      | get all user                |     x
|\counties             | GET        |      | get all counties            |     x
|\counties             | POST       |  Y   | create new county           |     x
|\counties\{id}        | GET        |      | get one county              |     x
|\counties\{id}        | PUT/PATCH  |  Y   | edit one county             |     x   
|\counties\{id}        | DELETE     |  Y   | delete one county           |     x
|\cities               | GET        |      | get all cities              |     x
|\cities               | POST       |  Y   | create new city             |     x
|\cities\{id}          | GET        |      | get one city                |     x
|\cities\{id}          | PUT/PATCH  |  Y   | edit one city               |     x
|\cities\{id}          | DELETE     |  Y   | delete one city             |     x
|\counties\{id}\cities | GET        |      | get all cities in a county  |