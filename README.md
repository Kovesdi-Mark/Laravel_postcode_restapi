Endpoints:

|Endpoint              | Method     | Auth | Note                        |
| -------------------- | ---------- | ---- | --------------------------- |
|\users                | POST       |      | add new user                |
|\users                | GET        |      | get all user                |
|\counties             | GET        |      | get all counties            |
|\counties             | POST       |  Y   | create new county           |
|\counties\{id}        | GET        |      | get one county              |
|\counties\{id}        | PUT/PATCH  |  Y   | edit one county             |
|\counties\{id}        | DELETE     |  Y   | delete one county           |
|\cities               | GET        |      | get all cities              |
|\cities               | POST       |  Y   | create new city             |
|\cities\{id}          | GET        |      | get one city                |
|\cities\{id}          | PUT/PATCH  |  Y   | edit one city               |
|\cities\{id}          | DELETE     |  Y   | delete one city             |
|\counties\{id}\cities | GET        |      | get all cities in a county  |