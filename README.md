# Guest API

## Описание

Проект реализует REST API для управления списком пользователей с использованием Laravel. API предоставляет возможности для создания, чтения, обновления и удаления данных о пользователях.

Сущность "Гость" имеет следующие обязательные поля:

- Имя
- Email (уникальное значение)
- Возраст ((целое число, больше 0))

## Что было реализовано:

- **CRUD операции для гостей**:
    - Создание, получение, обновление и удаление гостей.
- **Валидация входных данных**:
    - Проверка уникальности email.
- **Swagger документация API**:
    - Документация для всех API-эндпоинтов с использованием Swagger.
- **Docker контейнеризация**:
    - Использование Docker для развертывания приложения и базы данных.

### Структура проекта

Проект разделен на несколько слоев:

- **Controllers** — Контроллер для обработки запросов о гостях.
- **Requests** — Запросы и валидация данных гостя.
- **Resources** — Ресурс для форматирования данных гостя в API.
- **Models** — Модель для работы с данными гостя.
- **Services** — Логика работы с пользователем.
- **config** — Конфигурация документации API Swagger (l5-swagger.php).
- **migrations** — Миграция для создания таблицы гостей.
- **routes** — Определения маршрутов для API.
- **Dockerfile** — Конфигурация для создания контейнера Docker.
- **docker-compose.yml** — Настройки для запуска контейнеров с помощью Docker Compose.
- **.env** — Файл с переменными окружения для настройки конфигураций.
- **README.md** — Описание проекта, инструкция по установке и запуску.

## Эндпоинты

###  Swagger документация API:
-  Чтобы получить доступ к Swagger UI, запустите приложение и перейдите по следующему маршруту:

   ```bash
   http://localhost:80/api/documentation
   ```


### 1. Создание нового пользователя

- **POST** `http://localhost:80/api/users`

  **Запрос**:

  ```json
  {
    "name": "Alic Smith",
    "email": "johned@example.com",
    "age": 45
  }
  ```

  **Ответ**:

- **Статус:** `201 Created`

  ```json
  {
    "id": 1,
    "name": "Alic Smith",
    "email": "johned@example.com",
    "age": 45
  }
  ```

  **Коды состояния**:
    - `201 Created`: Пользователь успешно создан.
    - `422 Unprocessable Content`: Ошибка валидации данных.

### 2. Получение пользователя по ID

- **GET** `http://localhost:80/api/users/{id}`

  **Ответ**:

- **Статус:** `200 OK`
  ```json
  {
    "id": 1,
    "name": "Alic Smith",
    "email": "johned@example.com",
    "age": 45
  }
  ```

  **Коды состояния**:
    - `200 OK`: Данные пользователя успешно получены.
    - `404 Not Found`: Пользователь с указанным ID не найден.

### 3. Получение всех пользователей

- **GET** `http://localhost:80/api/users`

  **Ответ**:

- **Статус:** `200 OK`
  ```json
  {
    "id": 1,
    "name": "Alic Smith",
    "email": "johned@example.com",
    "age": 45
  }
  ```

  **Коды состояния**:
    - `200 OK`: Данные пользователя успешно получены.


### 4. Обновление данных пользователя

- **PUT** `http://localhost:80/api/users/{id}`

  **Запрос**:

  ```json
  {
    "name": "Alic Smith2",
    "email": "johned2@example.com",
    "age": 20
  }
  ```
    ```json
  {
      "name": "Alic Smith2",
      "age": 20
  }
  ```
    ```json
  {
      "age": 20
  }
  ```

  **Ответ**:

- **Статус:** `200 OK`

  ```json
  {
    "id": 1,
    "name": "Alic Smith2",
    "email": "johned2@example.com",
    "age": 20
  }
  ```

  **Коды состояния**:
    - `200 OK`: Пользователь успешно обновлен.
    - `404 Not Found`: Пользователь с указанным ID не найден.

### 5. Удаление пользователя

- **DELETE** `http://localhost:80/api/users/{id}`

  **Ответ**:

- **Статус:** `204 No Content`

**Коды состояния**:
- `204 No Content`: Пользователь успешно удален.
- `404 Not Found`: Пользователь с указанным ID не найден.

## Запуск приложения

1. Убедитесь, что у вас установлен Docker и Docker Compose.
2. Клонируйте репозиторий:

   ```bash
   git clone https://github.com/Adlerprogr/GuestAPIManager
   ```

3. Настройте файл `.env`:

   ```bash
   DB_CONNECTION=pgsql
   DB_HOST=db
   DB_PORT=5432
   DB_DATABASE=laravel
   DB_USERNAME=root
   DB_PASSWORD=root
   ```

4. Запустите сервер:

   ```bash
   docker-compose up --build
   ```

5. Перейти в контейнер php-fpm:

   ```bash
   docker compose exec php-fpm bash
   ```

6. Из контейнера php-fpm установите зависимости:

   ```bash
   composer install
   ```

7. Из контейнера php-fpm запустите миграции:

   ```bash
   php artisan migrate
   ```

8. После запуска сервера вы можете работать с API через такие сервисы как Postman.

Автор: [Aldar]
# ApiUsers