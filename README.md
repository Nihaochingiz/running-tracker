# Running Tracker - трекер пробежек с игровыми элементами

Трекер пробежек с системой уровней и опыта. Записывайте пробежки, отслеживайте прогресс и повышайте уровень!

## Установка

```bash
git clone https://github.com/Nihaochingiz/running-tracker.git
cd running-tracker
docker-compose up -d --build


Приложение доступно: http://localhost:8000


Особенности
📅 Запись пробежек (дата, дистанция, время)

📊 Статистика и прогресс

🎮 Уровни и опыт (20 опыта за пробежку)

🏆 Визуализация достижений

📱 Адаптивный дизайн

Технологии
PHP 8.2 + PostgreSQL

Docker

Чистый CSS (без фреймворков)



# Остановка
docker-compose down

# Пересборка
docker-compose down -v && docker-compose up -d --build

# Просмотр логов
docker-compose logs -f


Лицензия
MIT
