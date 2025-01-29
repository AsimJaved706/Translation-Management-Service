# Translation Service

## Setup
1. Clone the repository.
2. Run `docker-compose up -d`.
3. Run `docker-compose exec app php artisan migrate --seed`.
4. Access the API at `http://localhost:8000`.

## API Documentation
View Swagger docs at `http://localhost:8000/docs`.

## Testing
Run tests with `docker-compose exec app php artisan test`.

## Populate Database with Test Data

To populate the database with 100k+ translations for testing scalability, run:

```bash
php artisan translations:populate 100000


## Testing the Endpoints

### Create a Translation:
```bash
curl -X POST http://localhost:8000/api/translations -d '{
    "locale": "en",
    "key": "welcome",
    "content": "Welcome",
    "tags": ["web"]
}'

### Update a Translation:


curl -X PUT http://localhost:8000/api/translations/1 -d '{
    "content": "Welcome to our website"
}'

### View a Translation:

curl http://localhost:8000/api/translations/1

### Search Translations

curl http://localhost:8000/api/translations/search?locale=en&tags=web

### Export Translations:

curl http://localhost:8000/api/translations/export


---

### **Step 4: Authentication (if required)**
If your API uses Laravel Sanctum for token-based authentication, you’ll need to pass a valid API token with your `curl` commands:

```bash
curl -X POST http://localhost:8000/api/translations \
-H "Authorization: Bearer <your_token>" \
-d '{
    "locale": "en",
    "key": "welcome",
    "content": "Welcome",
    "tags": ["web"]
}'


