#Yii2 template for creating REST API backends.

Steps to start inside docker:

1. Build images
```text
docker compose build
```

2. Run
```text
docker compose up -d
```

3. Apply migrations
```text
docker exec app_php php yii migrate/up
```

Application will be available at http://localhost:8080

All main commands are in the Makefile. Use them.
