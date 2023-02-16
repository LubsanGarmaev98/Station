<h1 align="center">Station</h1>
  <p> Этот проект реализован с помощью: PHP 8.0, фреймворк Yii2, СУБД MySQL.
 <h2>Описание:</h2>
  <p> Это тестовое задание на позицию Backend Developer Junior. Задание представляет собой создание линий и станций с соблюдением зависимостей.</p>

<h2>API:</h2>
<ul>

1. POST /lines - Создание линии
   - /lines?expand=translations - создание линии с переводами линии.
     - в рамках этого метода заполнение переводов линии (lines_translation)
   - параметры form-data смотрите в коллекции POSTMAN
  
2. POST /stations - Создание станции
   - /stations?expand=translations,transfers,audios,features - создание станции и вывод всех зависимостей
     - в рамках этого метода заполнение переводов станции (stations_translation)
     - в рамках этого метода заполнение пересадок станции (stations_transfers)
     - в рамках этого метода заполнение аудио-сообщений станции (stations_audio)
     - в рамках этого метода заполнение сервисов на станции (stations_features)
   - параметры form-data смотрите в коллекции POSTMAN

3. GET /lines - Вывод списка линий
    - /lines?sort=number&expand=translations,stations.translations,stations.transfers,stations.audios,stations.features - 
   Вывод списка линий(с сортировкой по полям таблицы lines) со всеми связями (станции и их связи)


4. DELETE /stations/{id} - удаление станции по id, удаляться все зависимости (CASCADE)

5. POST /stations/{id} - Редактирование данных станции
   - /stations/{id}?expand=translations,transfers,audios,features - Редактирование данных станции и вывод всех зависимостей
   - параметры form-data смотрите в коллекции POSTMAN - там есть пример как изменять зависимости станции

</ul>

<h2> Чтобы запустить проект, выполните следующие шаги:</h2>

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