@extends('layouts.app')

@section('title', 'Микрозаймы')
@section('content')
	<div class="fade"></div>
	<section class="activity-page-section">
		@section('header')
			@include('components.layouts.includes.header')
			@include('components.layouts.includes.mobile-menu')
		@show
		<div class="activity-page-content">
			<div class="container container_small">
				<h2 class="h2 section-title activity-page-title">Калькулятор микрозаймов</h2>
                <div class="docs-card docs-card--simple step-microcredit step-microcredit--show" id="content-step1">
                <div class="calculator-page">
                  <div class="calculator-page__header">
                    <h4>Узнайте какие продукты вам доступны</h4>
                    <div class="step-calculator">
                      Шаг <span class="step-calculator__step">1</span> из <span clas="step-calculator__total">2</span>
                    </div>
                  </div>
                  <form action="{{ route('microcredit.calculation') }}" id="microcredit-step-1">
                  <div class="form-item form-item--activity">
                    <div class="form-item__title">Направление деятельности</div>
                    <div class="form-element-container form-element-container_select">
                            <select name="okveds[]" class="select-okveds" aria-label="Выберите р">
                            </select>
                        </div>
                  </div>
                  <div class="form-item form-item--checkbox">
                    <div class="form-item__title">Какой-то заголовок</div>
                    <div class="checkboxes-container">
                        <label for="antiseptic" class="checkbox-label">
                          <input class="checkbox-input" checked type="checkbox" name="antiseptic" value="1" id="antiseptic">
                          Компания-резидент организаций, образующих инфраструктуру поддержки субъектов МСП
                        </label>
                        <label for="antiseptic2" class="checkbox-label">
                            <input class="checkbox-input" type="checkbox" name="antiseptic" value="1" id="antiseptic2">
                            Компания осуществляет реализацию Государственных и областных программ на 2020-2030 гг (экология, туризм, спорт)
                        </label>
                    </div>
                  </div>
                  <div class="form-item">
                    <div class="form-item__row">
                      <div class="item-col">
                        <div class="item-col__title">Дата рождения руководителя</div>
                        <div class="form-element-container ">
                            <input name="data" aria-label="Дата рождения" class="input"  id="data-masck">
                        </div>
                      </div>
                      <div class="item-col">
                        <div class="item-col__title">Город</div>
                        <div class="form-element-container form-element-container_select">
                            <select name="monogorod" class="select-simple" aria-label="Выберите р">
                              <option value="1">Гуково</option>
                              <option value="2">Зверево</option>
                              <option value="3">Донецк</option>
                              <option value="0" selected>Другой город РО</option>
                            </select>
                        </div>
                      </div>
                      <div class="item-col">
                        <div class="item-col__title">Срок регистрации МСП</div>
                        <div class="form-element-container form-element-container_select">
                            <select name="reg-date" class="select-simple" aria-label="Срок регистрации МСП">
                              <option value="1" selected>менее 12 месяцев</option>
                              <option value="2">более 12 месяцев</option>
                              <option value="3">более 24 месяцев</option>
                            </select>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-item">
                    <div class="form-item__row">
                      <div class="item-col">
                        <div class="item-col__title">Пол руководителя</div>
                        <div class="radio-container">
                            <label class="radio-custom">
                                <span>мужской</span> 
                                <input type="radio" checked="checked" name="sex" value="0">
                                <span class="checkmark"></span>
                            </label>
                            <label class="radio-custom">
                                <span>женский</span> 
                                <input type="radio" name="sex" value="1">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                      </div>
                      <div class="item-col">
                        <div class="item-col__title">Займы в РРАПП</div>
                        <div class="radio-container">
                            <label class="radio-custom">
                                <span>Есть действующие займы</span>  
                                <input type="radio" checked="checked" name="loan" value="1">
                                <span class="checkmark"></span>
                            </label>
                            <label class="radio-custom">
                                <span>Нет действующих займов</span>  
                                <input type="radio" name="loan" value="0">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-item form-item--checkbox">
                    <div class="form-item__title">Укажите особенности получения займа</div>
                    <div class="checkboxes-container">
                        <label for="pledge" class="checkbox-label">
                          <input class="checkbox-input" checked type="checkbox" name="pledge" value="1" id="pledge">
                          Есть залог в виде движимого/не движемого имущества
                        </label>
                        <label for="surety" class="checkbox-label">
                            <input class="checkbox-input" type="checkbox" name="surety" value="1" id="surety">
                            Есть поручительство от бенефициаров бизнеса
                        </label>
                        <label for="part-pledge" class="checkbox-label">
                            <input class="checkbox-input" type="checkbox" name="part-pledge" value="1" id="part-pledge">
                            Есть частичный залог и поручительство НКО «Гарантийный фонд РО» в размере не менее 70%
                        </label>
                    </div>
                  </div>
                    <div class="action-form">
                      <button class="button button_big button_brown button_rounded activity-column-brief__button" type="submit">
                        <span class="text text_solid text_23 text_PT-font">Рассчитать</span>
                      </button>
                   </div>
                  </form>
                </div>
                </div>

                <div class="docs-card docs-card--simple step-microcredit" id="content-step2">
                <div class="calculator-page">
                  <div class="calculator-page__header calculator-page__header--row">
                    <button class="back-step"><span>Назад</span></button>
                    <div class="step-calculator">
                      Шаг <span class="step-calculator__step">2</span> из <span clas="step-calculator__total">2</span>
                    </div>
                  </div>
                  <div class="rates">
                    <div class="rates__title">Доступные тарифы</div>
                    <div class="rates__content">
                      <div class="rate-item">
                        <div class="rate-item__header">
                          <div class="rate-title">Моногород</div>
                          <label class="radio-custom">
                                <input type="radio" checked="checked" name="rate" value="0">
                                <span class="checkmark"></span>
                          </label>
                        </div>
                        <div class="rate-item__content">
                            <div class="rate-detail">
                               <div class="rate-detail__title">Сумма займа:</div>
                               <div class="rate-detail__value">от 100 тыс руб до 1,5 млн руб</div>
                            </div>
                            <div class="rate-detail">
                               <div class="rate-detail__title">Процентная ставка:</div>
                               <div class="rate-detail__value">2,12%</div>
                            </div>
                            <div class="rate-detail">
                               <div class="rate-detail__title">Срок займа:</div>
                               <div class="rate-detail__value">Не более 24 месяцев</div>
                            </div>
                        </div>
                        <div class="rate-item__action">
                          <button class="rate-more">Подробнее о займе</button>
                        </div>
                      </div>
                      <div class="rate-item">
                        <div class="rate-item__header">
                          <div class="rate-title">Моногород</div>
                          <label class="radio-custom">
                                <input type="radio" checked="checked" name="rate" value="0">
                                <span class="checkmark"></span>
                          </label>
                        </div>
                        <div class="rate-item__content">
                            <div class="rate-detail">
                               <div class="rate-detail__title">Сумма займа:</div>
                               <div class="rate-detail__value">от 100 тыс руб до 1,5 млн руб</div>
                            </div>
                            <div class="rate-detail">
                               <div class="rate-detail__title">Процентная ставка:</div>
                               <div class="rate-detail__value">2,12%</div>
                            </div>
                            <div class="rate-detail">
                               <div class="rate-detail__title">Срок займа:</div>
                               <div class="rate-detail__value">Не более 24 месяцев</div>
                            </div>
                        </div>
                        <div class="rate-item__action">
                          <button class="rate-more">Подробнее о займе</button>
                        </div>
                      </div>
                      <div class="rate-item">
                        <div class="rate-item__header">
                          <div class="rate-title">Моногород</div>
                          <label class="radio-custom">
                                <input type="radio" checked="checked" name="rate" value="0">
                                <span class="checkmark"></span>
                          </label>
                        </div>
                        <div class="rate-item__content">
                            <div class="rate-detail">
                               <div class="rate-detail__title">Сумма займа:</div>
                               <div class="rate-detail__value">от 100 тыс руб до 1,5 млн руб</div>
                            </div>
                            <div class="rate-detail">
                               <div class="rate-detail__title">Процентная ставка:</div>
                               <div class="rate-detail__value">2,12%</div>
                            </div>
                            <div class="rate-detail">
                               <div class="rate-detail__title">Срок займа:</div>
                               <div class="rate-detail__value">Не более 24 месяцев</div>
                            </div>
                        </div>
                        <div class="rate-item__action">
                          <button class="rate-more">Подробнее о займе</button>
                        </div>
                      </div>
                      <div class="rate-item">
                        <div class="rate-item__header">
                          <div class="rate-title">Моногород</div>
                          <label class="radio-custom">
                                <input type="radio" checked="checked" name="rate" value="0">
                                <span class="checkmark"></span>
                          </label>
                        </div>
                        <div class="rate-item__content">
                            <div class="rate-detail">
                               <div class="rate-detail__title">Сумма займа:</div>
                               <div class="rate-detail__value">от 100 тыс руб до 1,5 млн руб</div>
                            </div>
                            <div class="rate-detail">
                               <div class="rate-detail__title">Процентная ставка:</div>
                               <div class="rate-detail__value">2,12%</div>
                            </div>
                            <div class="rate-detail">
                               <div class="rate-detail__title">Срок займа:</div>
                               <div class="rate-detail__value">Не более 24 месяцев</div>
                            </div>
                        </div>
                        <div class="rate-item__action">
                          <button class="rate-more">Подробнее о займе</button>
                        </div>
                      </div>
                      <div class="rate-item">
                        <div class="rate-item__header">
                          <div class="rate-title">Моногород</div>
                          <label class="radio-custom">
                                <input type="radio" checked="checked" name="rate" value="0">
                                <span class="checkmark"></span>
                          </label>
                        </div>
                        <div class="rate-item__content">
                            <div class="rate-detail">
                               <div class="rate-detail__title">Сумма займа:</div>
                               <div class="rate-detail__value">от 100 тыс руб до 1,5 млн руб</div>
                            </div>
                            <div class="rate-detail">
                               <div class="rate-detail__title">Процентная ставка:</div>
                               <div class="rate-detail__value">2,12%</div>
                            </div>
                            <div class="rate-detail">
                               <div class="rate-detail__title">Срок займа:</div>
                               <div class="rate-detail__value">Не более 24 месяцев</div>
                            </div>
                        </div>
                        <div class="rate-item__action">
                          <button class="rate-more">Подробнее о займе</button>
                        </div>
                      </div>
                    </div>
                  </div>
                 </div>
                </div>


				<!-- <div class="template-text-container activity-column-container">
					<div class="activity-column-text">
						<img src="/img/pictures/signup-bg.jpg" alt="">
                        <form action="{{ route('microcredit.calculation') }}">
                            <p>Здесь будут инпуты для параметров микрозайма</p>
                            <p>
                                Окведы
                                <select multiple size="5" name="okveds[]">
                                    <option value="01">01 - Растениеводство и животноводство, охота и предоставление соответствующих услуг в этих областях</option>
                                    <option value="02">02 - Лесоводство и лесозаготовки</option>
                                    <option value="03">03 - Рыболовство и рыбоводство</option>
                                    <option value="05">05 - Добыча угля</option>
                                    <option value="10">10 - Производство пищевых продуктов (со всеми подгруппами)</option>
                                </select>
                            </p>
                            <p>
                                <input type="checkbox" name="antiseptic" value="1">Производство антисептиков
                            </p>
                            <p>
                                <input type="checkbox" name="social" value="1">Социальное предпринимательство
                            </p>
                            <p>
                                <input type="checkbox" name="support" value="1">Компания-резидент организаций, образующих инфраструктуру поддержки субъектов МСП
                            </p>
                            <p>
                                <input type="checkbox" name="gov-program" value="1">Компания осуществляет реализацию Государственных и областных программ на 2020-2030 гг (экология, туризм, спорт)
                            </p>
                            <p>
                                Пол
                                <input type="radio" name="sex" value="1">М
                                <input type="radio" name="sex" value="2">Ж
                                <input type="radio" name="sex" value="3" checked>Другое
                            </p>
                            <p>
                                Действующие займы
                                <input type="radio" name="loan" value="1">Есть
                                <input type="radio" name="loan" value="0">Нет
                            </p>
                            <p>
                                Дата рождения
                                <input type="date" id="start" name="birth-date"
                                       value="2018-07-22"
                                       min="1900-01-01" max="2022-12-31">
                            </p>
                            <p>
                                Город
                                <select name="monogorod">
                                    <option value="1">Гуково</option>
                                    <option value="1">Зверево</option>
                                    <option value="1">Донецк</option>
                                    <option value="0" selected>Другой город РО</option>
                                </select>
                            </p>
                            <p>
                                Срок регистрации
                                <select name="reg-date">
                                    <option value="1" selected>менее 12 месяцев</option>
                                    <option value="2">более 12 месяцев</option>
                                    <option value="3">более 24 месяцев</option>
                                </select>
                            </p>
                            Особенности получения займа
                            <p>
                                <input type="checkbox" name="pledge" value="1">Есть залог в виде движимого/не движемого имущества
                            </p>
                            <p>
                                <input type="checkbox" name="surety" value="1">Есть поручительство от бенефициаров бизнеса
                            </p>
                            <p>
                                <input type="checkbox" name="part-pledge" value="1">Есть частичный залог и поручительство НКО «Гарантийный фонд РО» в размере не менее 70%
                            </p>
                            <button class="button button_big button_brown button_rounded activity-column-brief__button" type="submit"><span class="text text_solid text_23 text_PT-font">Рассчитать</span></button>
                        </form>
					</div>
				</div> -->


			</div>
		</div>
	</section>
@endsection

@push('scripts')
{{--	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>--}}
@endpush