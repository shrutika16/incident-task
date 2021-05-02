# Incedent Event 

An incident is an event that could lead to loss of, or disruption to, an organization's operations, services, or functions. Incident management is a term describing the activities of an organization to identify, analyze, and correct hazards to prevent future re-occurrence.

Technology used
-   PHP 7.4
-   Laravel/Lumen 8.0
-   MySQL

## Database Setup
1. Create new database and update connection details in .env
2. Create Migration

```bash
    php artisan migrate
```
3. Run database dependency
```bash
    php artisan db:seed --class=UserSeeder
    php artisan db:seed --class=CategorySeeder
```

## API Endpoint List

| Name                      | Method | Endpoint              |
| ------------------------- | ------ | --------------------- |
| /login                    | POST   | Login User            |
| /incidents                | GET    | Get List of Incidents |
| /incidents                | POST   | Post Incidents        |

### Login Credentials

```bash
    email : shrutika@boppotech.com
    Password: boppo@123
```

## Unit Test Cases For API List

1. GET request

```bash
    ./vendor/bin/phpunit --filter  {testGetIncident}
```

2. POST Request

```bash
    ./vendor/bin/phpunit --filter  {testlocationValidation}

    ./vendor/bin/phpunit --filter  {testCategoryIdRequire}

    ./vendor/bin/phpunit --filter  {testCategoryIdInvalid}

    ./vendor/bin/phpunit --filter  {testIncidentDateVAlidation}

    ./vendor/bin/phpunit --filter  {testPostIncident}

```
