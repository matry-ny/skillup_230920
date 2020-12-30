```bash
docker-compose exec app /bin/bash
cd yii2/basic/
php yii migrate --migrationPath=@yii/i18n/migrations/ --interactive=0
php yii message/extract @app/config/messages.php
php yii migrate --migrationPath=@yii/rbac/migrations/
```