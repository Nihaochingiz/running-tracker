-- Создаем таблицу пробежек
CREATE TABLE runs (
    id SERIAL PRIMARY KEY,
    run_date DATE NOT NULL,
    distance_km DECIMAL(5,2) NOT NULL,
    time_minutes INTEGER NOT NULL,
    notes TEXT
);

-- Создаем таблицу статистики пользователя
CREATE TABLE user_stats (
    user_id SERIAL PRIMARY KEY,
    level INTEGER DEFAULT 1,
    experience INTEGER DEFAULT 0,
    total_distance DECIMAL(10,2) DEFAULT 0,
    total_runs INTEGER DEFAULT 0
);

-- Инициализируем статистику пользователя
INSERT INTO user_stats (user_id) VALUES (1);
