# Headhunter updater

Автообновление резюме на сайте hh.ru

## Подготовка

Для работы скрипта необходимо получить некоторые значения:

- *API_TOKEN* (можно получить здесь: [https://dev.hh.ru/admin]())
- *RESUME_ID* (можно взять из URL с вашим резюме: [https://hh.ru/resume/RESUME_ID]())

## Установка

```
git clone git@github.com:neoantox/headhunter-updater.git hh-updater
cd hh-updater
composer install
```

Убедитесь, что создался файл `.env`. Если его нет, выполните в консоли:

```cp .env.example .env```

## Настройка

1. В файле `.env` укажите *RESUME_ID* и *API_TOKEN*, которые вы получили ранее.
2. Добавьте задачу в cron: `0 */4 * * * php /path/to/hh-updater/updater.php`
