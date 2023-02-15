<h1 align="center">Station</h1>
  <p> Этот проект реализован с помощью: PHP 8.0, фреймворк Yii2, СУБД MySQL.
 <h2>Описание:</h2>
  <p> Это облачное хранилище файлов. Для начала необходимо зарегистрироваться и пройти аутентификацию, чтобы получить JWT токен. Пользователь имеет ограниченное хранилище в 100 Мб.
При загрузке файлов используйте полученный токен. Файл можно загрузить, указать срок хранения, удалить. Создание новых директорий и загрузки в них файлов также поддерживается.
Генерация уникальной публичной ссылки на файл/p>

<h2>API:</h2>
<ul>

- POST /lines?expand=translations - Создание линии
  - в рамках этого метода заполнение переводов линии (lines_translation)

- GET /lines/{id}?expand=translations,stations.translations&sort=number - Вывод списка линий(с сортировкой по полям таблицы lines) со всеми связями (станции и их связи)

- POST /stations?expand=translations,transfers,audios,features - Создание станции
  - в рамках этого метода заполнение переводов станции (stations_translation)
  - в рамках этого метода заполнение пересадок станции (stations_transfers)
  - в рамках этого метода заполнение аудио-сообщений станции (stations_audio)
  - в рамках этого метода заполнение сервисов на станции (stations_features)

- GET /stations/{id}?expand=translations,transfers,audios,features - Редактирование пользователя

- POST /stations/{id}?expand=translations,transfers,audios,features - Редактирование данных станции

</ul>

h2> Чтобы запустить проект, выполните следующие шаги:</h2>

1. Создайте контейнеры:

```docker compose build```

2. Запустите их:

```docker compose up -d```

3. Проверьте созданные docker-контейнеры:

```docker ps```

4. Зайдите в контейнер php-fpm:

```docker compose exec php-fpm bash```

5. Далее необходимо перейти в директорию app и создать таблицы

```cd app && php yii migrate```

6. Теперь можете отправлять запросы. 
7. Готово 😊