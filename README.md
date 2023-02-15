<h1 align="center">Station</h1>
  <p> Этот проект реализован с помощью: PHP 8.0, фреймворк Yii2, СУБД MySQL.
 <h2>Описание:</h2>
  <p> Это тестовое задание на позицию Backend Developer Junior. Задание представляет собой создание линий и станций с соблюдением зависимостей./p>

<h2>API:</h2>
<ul>

- POST /lines - Создание линии
  - дополнения (expand = ): 
    - /lines?expand=translations - вывод зависимостей с таблицей lines_translation
  - в рамках этого метода заполнение переводов линии (lines_translation)

- GET /lines/{id} - Вывод линий
  - дополнения (expand = ):
    - /lines/{id}?expand=translations - вывод зависимостей с таблицей lines_translation
    - /lines/{id}?expand=stations. - вывод зависимостей с таблицей station
      - /lines/{id}?expand=stations.translations - вывод зависимостей с таблицей stations_translation
      - /lines/{id}?expand=stations.transfers - вывод зависимостей с таблицей stations_transfers
      - /lines/{id}?expand=stations.audios - вывод зависимостей с таблицей stations_audio
      - /lines/{id}?expand=stations.features - вывод зависимостей с таблицей stations_features
    - /lines/{id}?expand=stations.translations&sort=number - Вывод списка линий(с сортировкой по полям таблицы lines)

- POST /stations - Создание станции
  - дополнения (expand): 
    - /stations?expand=translations - вывод зависимостей с таблицей stations_translation
    - /stations?expand=transfers - вывод зависимостей с таблицей stations_transfers
    - /stations?expand=audios - вывод зависимостей с таблицей stations_audio
    - /stations?expand=features - вывод зависимостей с таблицей stations_features
  - пример: - /stations?expand=translations,transfers,audios,features - сразу все зависимости
  
  - в рамках этого метода заполнение переводов станции (stations_translation)
  - в рамках этого метода заполнение пересадок станции (stations_transfers)
  - в рамках этого метода заполнение аудио-сообщений станции (stations_audio)
  - в рамках этого метода заполнение сервисов на станции (stations_features)

- GET /stations/{id} - Вывод станций
  - дополнения (expand = ):
    - /stations/{id}?expand=translations - вывод зависимостей с таблицей stations_translation
    - /stations/{id}?expand=transfers - вывод зависимостей с таблицей stations_transfers
    - /stations/{id}?expand=audios - вывод зависимостей с таблицей stations_audio
    - /stations/{id}?expand=features - вывод зависимостей с таблицей stations_features
  - /stations/{id}?expand=translations&sort=number - Вывод списка станций с сортировкой по полям

- POST /stations/{id} - Редактирование данных станции
  - дополнения (expand = ):
    - /stations/{id}?expand=translations - вывод зависимостей с таблицей stations_translation
    - /stations/{id}?expand=transfers - вывод зависимостей с таблицей stations_transfers
    - /stations/{id}?expand=audios - вывод зависимостей с таблицей stations_audio
    - /stations/{id}?expand=features - вывод зависимостей с таблицей stations_features
  - пример: /stations/{id}?expand=translations,transfers,audios,features - Редактирование данных станции и вывод всех возможных зависимостей
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