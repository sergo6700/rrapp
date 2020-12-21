@extends('/components/include')

<div class="popup" id="popup-registration-error">
	<button class="popup-close" aria-label="Закрыть форму">
		<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path d="M14 1.41L12.59 0L7 5.59L1.41 0L0 1.41L5.59 7L0 12.59L1.41 14L7 8.41L12.59 14L14 12.59L8.41 7L14 1.41Z" fill="black"/>
		</svg>
	</button>
	<div class="popup-error">
		<p class="text text_28 text_brown text_solid popup-error__title text_center">При регистрации что-то<br>пошло не так</p>
		<p class="text text_19 text_solid text_PT-font text_center">Попробуйте позже.</p>
	</div>
</div>

@push('scripts')
	<script src="/utils/js/jquery.modal.min.js"></script>
@endpush
