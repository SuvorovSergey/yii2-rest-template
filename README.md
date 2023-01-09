# Yii2 template for creating REST API backends.

Steps to start inside docker:

1. Copy .env.example to .env
```text
cp .env.example .env
```
2. Build images
```text
docker compose build
```
3. Run
```text
docker compose up -d
```
4. Install dependencies
```text
docker exec app_php composer install
```
5. Apply migrations
```text
docker exec app_php php yii migrate/up
```

Application will be available at http://localhost:8080

All main commands are in the Makefile. Use them.
