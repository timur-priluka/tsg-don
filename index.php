<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>TSGas Транс Сервис Групп ДНР Донецк</title>
  <link href="styles/style.css" type="text/css" rel="stylesheet" />
  <link href="styles/style-index.css" type="text/css" rel="stylesheet" />
  <link href="styles/style-modal.css" type="text/css" rel="stylesheet" />
  <link rel="icon" href="./favicon.png" type="image/x-icon" />
  <link rel="stylesheet" href="styles/sfprodisp.css" type="text/css" media="all" />
  <link rel="stylesheet" href="styles/rubik.css" type="text/css" media="all" />

  <script src="https://yastatic.net/jquery/2.2.3/jquery.min.js"></script>

  <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&amp;coordorder=longlat&amp;apikey=be405e28-389c-4e51-b673-5508986cd74d"></script>
  <script>
    ymaps.ready(function() {

      var map = new ymaps.Map('modal_map', {
          center: [38.491786, 47.577932],
          zoom: 8,
          controls: ['zoomControl']
        }),
        objectManager = new ymaps.ObjectManager();
      map.controls.get('zoomControl').options.set({
        size: 'small'
      });
      // Загружаем GeoJSON файл, экспортированный из Конструктора карт.
      $.getJSON('../docs/tsgaz.geojson')
        .done(function(geoJson) {

          geoJson.features.forEach(function(obj) {
            // Задаём контент балуна.
            obj.properties.balloonContent = obj.properties.description;
            // Задаём пресет для меток с полем iconCaption.
            if (obj.properties.iconCaption) {
              obj.options = {
                preset: "islands#yellowFuelStationCircleIcon"
              }
            }
          });
          // Добавляем описание объектов в формате JSON в менеджер объектов.
          objectManager.add(geoJson);
          // // Добавляем объекты на карту.
          map.geoObjects.add(objectManager);

          objectManager.objects.events.add('click', function(e) {
            var objectId = e.get('objectId'),
              obj = objectManager.objects.getById(objectId);
            // let element01 = document.getElementById('location');
            // element01.innerHTML = obj.properties.description;

            let textField = document.getElementById('findCity');
            textField.value = obj.properties.description;
            searchCity();

          });
        });
    });
    // });
  </script>
  <script>
    var tmpDesr01;

    function searchCity() {
      var requestURL = "../docs/tsgaz.geojson";
      var request = new XMLHttpRequest();
      request.open("GET", requestURL);
      request.responseType = "json";
      request.send();
      request.onload = function() {
        let addrs = request.response;
        let textField = document.getElementById('findCity');
        let city = textField.value;
        if (city.length > 2) {
          var feat;
          let fsList = document.getElementById('fsList');
          let fsListChild;
          while (fsList.firstChild) {
            fsList.removeChild(fsList.firstChild);
          }
          for (let i = 0; i < addrs.features.length; i++) {
            feat = addrs.features[i].properties.iconCaption + ', ' + addrs.features[i].properties.description;
            if (typeof feat === "undefined")
              feat = '';
            if (feat.includes(city)) {
              fsListChild = document.createElement("div");
              fsListChild.className = "fsListItem";
              fsListChild.textContent = feat;

              fsListChild.onclick = function() {
                if (typeof tmpDesr01 != "undefined") {
                  if ((this.children[0].style.display == 'block') && (tmpDesr01.style.display == 'block')) {
                    tmpDesr01.style.display = "none";
                  } else {
                    tmpDesr01.style.display = "none";
                    this.children[0].style.display = "block";
                  }
                } else
                  this.children[0].style.display = "block";
                tmpDesr01 = this.children[0];
              }

              fsList.appendChild(fsListChild);
              if ("content" in document.createElement("template")) {

                var template = document.querySelector("#fsDescr");

                var clone = template.content.cloneNode(true);
                var style01 = clone.querySelectorAll("div");
                style01[0].style.display = "none";
                fsListChild.appendChild(clone);

              }
            }
          }
        }
      };

    }
  </script>
</head>

<body>
  <div class="wrapper">
    <?php
    require "header.php";
    ?>
    <div class="main-content">
      <div class="fuel-cards">
        <div class="fc-text">
          <div class="fc-h">Топливные карты</div>
          <div class="fc-contr">Контролируйте каждый литр</div>
          <div class="fc-conv">Удобный и гибкий инструмент </br> для владельцев бизнеса</div>
          <img src="../images/logo-white.svg" />
        </div>
        <div class="cards-image">
          <img src="../images/fuelCard.svg" />
        </div>
      </div>
      <div class="allsheet">
        <div class="asfstcol">
          <a href="bonus-card.php">
            <div class="bonuscards">
              <div class="bonusfstcol">
                <div class="fsttext">Бонусные карты</div>
                <div class="sectext">Возвращай часть денег</br>с каждой покупки</div>
                <div class="thrtext">Условия программы лояльности</div>
              </div>
              <div class="bonusseccol">
                <img src="../images/tsgbonus.png" />
              </div>
            </div>
          </a>
          <div class="wholesale">
            <div class="whsfstcol">
              <div class="fsttext">ГСМ оптом</div>
              <div class="sectext">Крупный опт</div>
              <div class="thrtext">От 20 метрических тонн</div>
              <img src="../images/vehicle.png" />
            </div>
            <div class="whsseccol">
              <div class="sectext">Мелкий опт</div>
              <div class="thrtext">До 20 метрических тонн</div>
              <div class="canister"><img src="../images/canister01.png" /></div>
            </div>
          </div>
          <div class="weonmap">
            <div class="mapfstcol">
              <div class="gsmaptext">АЗС</br>на карте</div>
              <div class="gsmaparr"><img src="../images/arrowright.png" /></div>
            </div>
            <div class="mapseccol"><img src="../images/geomap.png" /></div>
          </div>

        </div>
        <div class="asseccol">
          <div class="fuelprice">
            <a class="open_modal" href="#">Выберите АЗС на карте</a>
            <div class="ourfuel">Топливо</div>
            <div id="location">АЗС Донецк, улица Баумана, 15</div>
            <div id="modal" class="modal bounceIn">
              <div id="modal_map"></div>
              <div class="ourfuelsts">
                <div>
                  <div class="findfscap">Поиск АЗС</div>
                  <div id="close_modal">+</div>
                </div>
                <div class="findwin">
                  <form onsubmit=searchCity()>
                    <input id="findCity" type="text" placeholder="Введите адрес город" class="" autocomplete="off" onsubmit="searchCity()">
                    <button type="button" class="search_btn" onclick="searchCity()">
                      <!-- <i class="icon icon-s-search-md"></i> -->
                    </button>
                  </form>
                </div>
                <div class="farfs">Ближайшие АЗС</div>
                <div id="fsList">

                </div>

              </div>
            </div>
            <div class="ga9592">
              <div class="prfstcol">
                <div class="ftype">95</div>
                <div class="moredetails">Подробнее</div>
              </div>
              <div class="prseccol">58.00</div>
            </div>
            <div class="ga9592">
              <div class="prfstcol">
                <div class="ftype">92</div>
                </br>
                <div class="moredetails">Подробнее</div>
              </div>
              <div class="prseccol">58.00</div>
            </div>
            <div class="df">
              <div class="prfstcol">
                <div class="ftype">ДТ</div>
                </br>
                <div class="moredetails">Подробнее</div>
              </div>
              <div class="prseccol">58.00</div>
            </div>
            <div class="gas">
              <div class="prfstcol">
                <div class="ftype">Газ</div>
                </br>
                <div class="moredetails">Подробнее</div>
              </div>
              <div class="prseccol">58.00</div>
            </div>
            <!-- <div class="concrpr">Цены на конкретной АЗС могут отличаться от указанных на сайте</div> -->
          </div>
          <div class="vacancy">
          </div>
        </div>
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
<template id="fsDescr">
  <div class="fsDescr01">
    <div class="fuelTypes">
      <div class="fuelCap">Топливо</div>
      <div class="fuelName">
        <div class="a9201">А92</div>
        <div class="a9501">А95</div>
        <div class="df01">ДТ</div>
        <div class="gas01">Газ</div>
      </div>
      <div class="fuelCap">Особенности</div>
      <div class="pecul">
        <div><img src="../images/market.png"></div>
        <div><img src="../images/car_wash.png"></div>
      </div>
      <div class="pecul">
        <div><img src="../images/invalid.png"></div>
        <div><img src="../images/bonus_card_ico.png"></div>
      </div>
      <div class="fuelCap">Способы оплаты</div>
      <div class="pecul">
        <div><img src="../images/cash_pay.png"></div>
        <div><img src="../images/card_pay.png"></div>
      </div>
    </div>
  </div>
  </div>
</template>

</html>