<!-- number input -->
<div @include('crud::inc.field_wrapper_attributes') >
    <label for="{{ $field['name'] }}">{!! $field['label'] !!}</label>
    @include('crud::inc.field_translatable_icon')

    @if(isset($field['prefix']) || isset($field['suffix']))
        <div class="input-group"> @endif
            @if(isset($field['prefix']))
                <div class="input-group-addon">{!! $field['prefix'] !!}</div> @endif
            @php
                $default_cords = [47.222078, 39.720349];
                $address_title = null;
                if (isset($field['value'])) {
                    $address_data = json_decode($field['value'],true);

                    if (!empty($address_data)) {
                        $address_id = $address_data['id'];
                        $address_title = $address_data['title'];
                        $address_latitude = $address_data['latitude'];
                        $address_longitude = $address_data['longitude'];
                        $coords = [$address_latitude, $address_longitude];
                    }
                } else {
                    $address_id = null;
                    $coords = $default_cords;
                }
            @endphp
            <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&amp;apikey={{ config('services.yandex_maps.api_key') }}"
                    type="text/javascript"></script>
            <style>
                #event-map {
                    width: 100%;
                    height: 400px;
                }
            </style>
            <script>
                ymaps.ready(init);

                function init() {
                    var myPlacemark,
                        myMap = new ymaps.Map('event-map', {
                            center: {!! json_encode($coords,true) !!},
                            zoom: 13
                        }, {
                            searchControlProvider: 'yandex#search'
                        });

                    var firstBoot = true;
                    var address_title = "{!! addslashes($address_title) !!}"

                    @if ($default_cords !== $coords)
                        coords_new = {!! json_encode($coords,true) !!};

                        if (coords_new.length) {
                            myPlacemark = createPlacemark(coords_new);
                            myMap.geoObjects.add(myPlacemark);
                            getAddress(coords_new);
                        }
                    @endif

                    // Слушаем клик на карте.
                    myMap.events.add('click', function (e) {
                        var coords = e.get('coords');

                        // Если метка уже создана – просто передвигаем ее.
                        if (myPlacemark) {
                            myPlacemark.geometry.setCoordinates(coords);
                        }
                        // Если нет – создаем.
                        else {
                            myPlacemark = createPlacemark(coords);
                            myMap.geoObjects.add(myPlacemark);
                            // Слушаем событие окончания перетаскивания на метке.
                            myPlacemark.events.add('dragend', function () {
                                getAddress(myPlacemark.geometry.getCoordinates());
                            });
                        }
                        getAddress(coords);
                    });

                    // Создание метки.
                    function createPlacemark(coords) {
                        return new ymaps.Placemark(coords, {
                            iconCaption: 'поиск...'
                        }, {
                            preset: 'islands#violetDotIconWithCaption',
                            draggable: true
                        });
                    }

                    // Определяем адрес по координатам (обратное геокодирование).
                    function getAddress(coords) {
                        myPlacemark.properties.set('iconCaption', 'поиск...');
                        ymaps.geocode(coords).then(function (res) {
                            var firstGeoObject = res.geoObjects.get(0);

                            var $tempAddress = $("#address");
                            var $address = $($tempAddress[0]);
                            var $tempHiddenAddress = $("#address_hidden");
                            var $hidden_address = $($tempHiddenAddress[0]);
                            var address = {};

                            if (firstBoot && address_title) {
                                address.title = address_title;
                            } else {
                                address.title = firstGeoObject.getAddressLine();
                            }

                            firstBoot = false;

                            address.latitude = coords[0];
                            address.longitude = coords[1];
                            $address.val(address.title);
                            $hidden_address.val(JSON.stringify(address));

                            myPlacemark.properties
                                .set({
                                    // Формируем строку с данными об объекте.
                                    iconCaption: [
                                        // Название населенного пункта или вышестоящее административно-территориальное образование.
                                        firstGeoObject.getLocalities().length ? firstGeoObject.getLocalities() : firstGeoObject.getAdministrativeAreas(),
                                        // Получаем путь до топонима, если метод вернул null, запрашиваем наименование здания.
                                        firstGeoObject.getThoroughfare() || firstGeoObject.getPremise()
                                    ].filter(Boolean).join(', '),
                                    // В качестве контента балуна задаем строку с адресом объекта.
                                    balloonContent: firstGeoObject.getAddressLine()
                                });
                        });
                    }

                    // отслеживаем ввод данных в поле Адрес
                    document.getElementById('address').oninput = function () {
                        let addressHidden = $("#address_hidden");
                        if (addressHidden.val()) {
                            let addressObject = JSON.parse(addressHidden.val());
                            addressObject.title = $(this).val();

                            addressHidden.val(
                                JSON.stringify(addressObject)
                            )
                        }
                    };
                }

            </script>
            <div id="event-map" class="form-group"></div>
            @if(isset($field['suffix']))
                <div class="input-group-addon">{!! $field['suffix'] !!}</div> @endif
            <label for="{{ $field['name'] }}">Адрес</label>
            <input
                    type="text"
                    name="{{ $field['name'] }}"
                    id="{{ $field['name'] }}"
                    value="{{ old(square_brackets_to_dots($field['name'])) ?? $address_title ?? $field['default'] ?? '' }}"
                    @include('crud::inc.field_attributes')
            >
            <input
                    type="hidden"
                    name="{{ $field['name'] }}_hidden"
                    id="{{ $field['name'] }}_hidden"
                    value="{{ old(square_brackets_to_dots($field['name'].'_hidden')) ?? $field['value'] ?? $field['default'] ?? '' }}"
            >
            @if ($address_id)
                <input
                        type="hidden"
                        name="address_id"
                        id="address_id"
                        value="{{$address_id}}"
                >
            @endif
            @if(isset($field['prefix']) || isset($field['suffix'])) </div> @endif

    {{-- HINT --}}
    @if (isset($field['hint']))
        <p class="help-block">{!! $field['hint'] !!}</p>
    @endif
</div>