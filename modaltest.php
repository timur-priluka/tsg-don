<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Топливные карты для предприятий | TSGaz</title>
  <link href="styles/style.css" type="text/css" rel="stylesheet" />
  <link href="styles/style-boncard.css" type="text/css" rel="stylesheet" />

  <link href="styles/style-modal.css" type="text/css" rel="stylesheet" />

  <link rel="icon" href="./favicon.png" type="image/x-icon" />
  <link rel="stylesheet" href="styles/sfprodisp.css" type="text/css" media="all" />
  <link rel="stylesheet" href="styles/rubik.css" type="text/css" media="all" />
  <!-- <script src="https://yastatic.net/jquery/2.2.3/jquery.min.js"></script> -->
  <!-- <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&amp;coordorder=longlat&amp;apikey=be405e28-389c-4e51-b673-5508986cd74d"></script> -->

  <!-- <script src="scripts/modal.js"></script> -->

  <!-- <script>
      function showDocInForm(varL) {
        let idElement;
        if (varL == 1) {
          idElement = "coll-text01";
        } else {
          idElement = "coll-text02";
        }
        let element = document.getElementById(idElement);
        if (element.style.display === "none" || element.style.display === "") {
          element.style.display = "block";
          element.style.margin = "0 auto 40px auto";
        } else {
          element.style.display = "none";
        }
      }

      ymaps.ready(function () {
        var map = new ymaps.Map("map", {
            center: [38.491786, 47.577932],
            zoom: 8,
            controls: ["zoomControl"],
          }),
          objectManager = new ymaps.ObjectManager();
        map.controls.get("zoomControl").options.set({
          size: "small",
        });
        // Загружаем GeoJSON файл, экспортированный из Конструктора карт.
        $.getJSON("../docs/tsgaz.geojson").done(function (geoJson) {
          geoJson.features.forEach(function (obj) {
            // Задаём контент балуна.
            obj.properties.balloonContent = obj.properties.description;
            // Задаём пресет для меток с полем iconCaption.
            if (obj.properties.iconCaption) {
              obj.options = {
                preset: "islands#yellowFuelStationCircleIcon",
              };
            }
          });
          // Добавляем описание объектов в формате JSON в менеджер объектов.
          objectManager.add(geoJson);
          // // Добавляем объекты на карту.
          map.geoObjects.add(objectManager);

          objectManager.objects.events.add("click", function (e) {
            var objectId = e.get("objectId"),
              obj = objectManager.objects.getById(objectId);
            let element01 = document.getElementById("location");
            element01.innerHTML = obj.properties.description;
          });
        });
      });
      // });
    </script> -->
</head>

<body>
  <div class="wrapper">
    <?php
    require "header.php";
    ?>


    <a class="open_modal" href="#open">Открыть окно</a>
    <div id="modal" class="modal bounceIn">
      <div id="close_modal">+</div>
      <div class="modal_txt">Текст в модальном окне</div>
    </div>
    <?php
    require "footer.php";
    ?>
  </div>
  <script>
    let open_modal = document.querySelectorAll('.open_modal');
    let close_modal = document.getElementById('close_modal');
    let modal = document.getElementById('modal');
    let body = document.getElementsByTagName('body')[0];
    for (let i = 0; i < open_modal.length; i++) {
      open_modal[i].onclick = function() { // клик на открытие
        modal.classList.add('modal_vis'); // добавляем видимость окна
        modal.classList.remove('bounceOutDown'); // удаляем эффект закрытия
        body.classList.add('body_block'); // убираем прокрутку
      };
    }
    close_modal.onclick = function() { // клик на закрытие
      modal.classList.add('bounceOutDown'); // добавляем эффект закрытия
      window.setTimeout(function() { // удаляем окно через полсекунды (чтобы увидеть эффект закрытия).
        modal.classList.remove('modal_vis');
        body.classList.remove('body_block'); // возвращаем прокрутку
      }, 500);
    };
  </script>
</body>

</html>