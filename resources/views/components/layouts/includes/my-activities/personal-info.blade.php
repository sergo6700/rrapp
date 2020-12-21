@extends('/components/include')

<div class="swiper-slide personal-info-slide">
	<form class="personal-info-form" id="personal-info-form" action="{{ route('profile.user.update') }}" method="post">
		@method('PUT')
		@csrf
		<div class="personal-info-form__content">
			<h3 class="text text_28 section-title-extra-small">Персональная информация</h3>
			<div class="personal-info-form__section personal-info-form__section_first">
				<div class="personal-info-form__section-column">
					<div class="personal-info-form__element">
						<label for="full-name" class="personal-info-form__label text text_20 text_massive">ФИО</label>
						<input name="name" id="full-name" aria-label="ФИО" class="input {{ $errors->has('name') ? 'error' : '' }}"
							   placeholder="ФИО" value="{{ old('name', $user->name ?? null) }}">
						@error('name')
							<label class="popup-select-error popup-error-show" for="name">{{ $message }}</label>
						@enderror
					</div>
					<div class="personal-info-form__element">
						<label for="phone" class="personal-info-form__label text text_20 text_massive">Телефон</label>
						<input name="phone" aria-label="Телефон" id="personal-phone" class="input {{ $errors->has('phone') ? 'error' : '' }}"
							   placeholder="+7(___) ___ __ __" value="{{ old('phone', $user->phone ?? null) }}">
						@error('phone')
							<label class="popup-select-error popup-error-show" for="phone">{{ $message }}</label>
						@enderror
					</div>
				</div>
				<div class="personal-info-form__section-column">
					<div class="personal-info-form__element">
						<label for="email" class="personal-info-form__label text text_20 text_massive">E-mail</label>
						<input name="email" id="email" aria-label="Email" class="input {{ $errors->has('email') ? 'error' : '' }}"
							   placeholder="E-mail" value="{{ old('email', $user->email ?? null) }}">
						@error('email')
							<label class="popup-select-error popup-error-show" for="email">{{ $message }}</label>
						@enderror
					</div>
				</div>
			</div>

			<h3 class="text text_28 section-title-extra-small">Мой бизнес</h3>
			<div class="personal-info-form__section">
				<div class="personal-info-form__section-column">
					<div class="personal-info-form__element form-element-container_select">
						<label for="role" class="personal-info-form__label text text_20 text_massive">Роль</label>
						<select name="role_in_company_id" id="role"
								class="personal-info-select {{ $errors->has('role_in_company_id') ? 'select-error-border' : '' }}"
								style="width: 100%">
							<option value="" selected hidden disabled>Роль</option>
							@foreach ($user_roles as $role)
								<option value="{{ $role['id'] }}"
									data-inn_placeholder="{{ $role['inn_placeholder'] }}"
									{{ old('role_in_company_id', $user->role_in_company_id ?? null) == $role['id'] ? 'selected' : '' }}>
									{{ $role['name'] }}
								</option>
							@endforeach
						</select>
						@error('role_in_company_id')
							<label class="popup-select-error popup-error-show" for="role_in_company_id">{{ $message }}</label>
						@enderror
					</div>
					<div class="personal-info-form__text-block">
						<p class="text text_20 text_massive personal-info-form__text-title">Наименование компании</p>
						<p id="organization" class="text text_19 text_black-1 personal-info-form__text">{{$user->company_name ?? '—'}}</p>
					</div>
					<div class="personal-info-form__text-block">
						<p class="text text_20 text_massive personal-info-form__text-title">Юридический адрес</p>
						<p id="legal-adress" class="text text_19 text_black-1 personal-info-form__text">{{$user->legal_address ?? '—'}}</p>
					</div>
				</div>
				<div class="personal-info-form__section-column">
					<div class="personal-info-form__element">
						<label for="inn" id="inn-label" class="personal-info-form__label text text_20 text_massive">
							ИНН
						</label>
						<input name="tin" id="inn" aria-label="inn" class="input {{ $errors->has('tin') ? 'error' : '' }}"
							   placeholder="ИНН"
							   value="{{ old('tin', $user->tin ?? null) }}"
							   type="number"
						>
						@error('tin')
							<label class="popup-select-error popup-error-show" for="tin">{{ $message }}</label>
						@enderror
					</div>

                    <div id="custom-role-div" class="personal-info-form__element">
                        <label for="custom-role" id="custom-role-label" class="personal-info-form__label text text_20 text_massive">
                            Роль в компании
                        </label>
                        <input name="custom_role" id="custom-role" aria-label="custom-role" class="input {{ $errors->has('custom_role') ? 'error' : '' }}"
                               placeholder="Укажите роль"
                               value="{{ old('custom_role', $user->custom_role ?? null) }}"
                               type="text"
                        >
                        @error('custom_role')
                        <label class="popup-select-error popup-error-show" for="custom_role">{{ $message }}</label>
                        @enderror
                    </div>
					<div class="flex-container-space-btw">
						<div class="personal-info-form__text-block">
							<p class="text text_20 text_upper text_massive personal-info-form__text-title">Кпп</p>
							<p id="kpp" class="text text_19 text_black-1 personal-info-form__text">{{$user->kpp ?? '—'}}</p>
						</div>
						<div class="personal-info-form__text-block">
							<p class="text text_20 text_upper text_massive personal-info-form__text-title">Огрн</p>
							<p id="ogrn" class="text text_19 text_black-1 personal-info-form__text">{{$user->ogrn ?? '—'}}</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<input id="company_name_input" type="text" class="hidden-inputs" name="company_name" value="{{$user->company_name ?? ''}}">
		<input id="kpp_input" type="text" class="hidden-inputs" name="kpp" value="{{$user->kpp ?? ''}}">
		<input id="ogrn_input" type="text" class="hidden-inputs" name="ogrn" value="{{$user->ogrn ?? ''}}">
		<input id="legal_address_input" type="text" class="hidden-inputs" name="legal_address" value="{{$user->legal_address ?? ''}}">
		<button type="submit" class="button button_rounded button_big button_brown button_save-personal-info">
			<span class="text text_23 text_white text_PT-font">Сохранить</span>
		</button>

	</form>
</div>

@push('scripts')
{{--	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>--}}
@endpush
