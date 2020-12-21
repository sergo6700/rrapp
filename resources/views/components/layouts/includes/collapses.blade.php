
@extends('/components/include')
@push('styles')
	<link rel="stylesheet" href="/utils/css/jquery-ui.min.css">
@endpush

<div class="template-collapses-container">

	<div class="template-collapse-wrapper">
		<h3 class="template-collapse__title text text_brown text_semi-bold">Мероприятия</h3>
		<div class="template-collapse calendar-collapse">
			<div class="template-collapse__item">
				@if ($first = $latest_events->shift())
				<span class="template-collapse__data text text_14m text_white-f6">
					{{ $first ? formatDateForView($first->date_from ?? null) : null }}
				</span>
				<a href="{{ route('event.show', $first->only('slug')) }}"
				   class="template-collapse__text text text_14m "
				   title="{{ $first->title ?? null }}">
					{{ $first->title ?? null }}
				</a>
				<button class="button template-collapse__icon-button" aria-label="Свернуть или развернуть список мероприятий">
					<svg class="template-collapse__icon" width="11" height="7" viewBox="0 0 11 7" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path fill-rule="evenodd" clip-rule="evenodd" d="M10.5938 1.93791C10.8778 1.67164 10.8778 1.23994 10.5938 0.973668C10.3098 0.707405 9.84929 0.707405 9.56529 0.973668L5.71591 4.58246L1.86654 0.973668C1.58251 0.707404 1.12203 0.707404 0.838014 0.973668C0.553996 1.23994 0.553996 1.67164 0.838014 1.93791L5.20165 6.02882C5.48567 6.29508 5.94615 6.29508 6.23017 6.02882L10.5938 1.93791Z" fill="#F17757"/>
					</svg>
				</button>
				@endif
			</div>
			<ul class="collapse-content">
				@foreach ($latest_events ?? [] as $item)
					<li class="template-collapse__list-item">
						<div class="template-collapse__item">
							<span class="template-collapse__data text text_14m text_white-f6">
								{{ formatDateForView($item->date_from ?? null) }}
							</span>
							<a class="template-collapse__text text text_14m "
							   href="{{ route('event.show', $item->only('slug')) }}"
							   title="{{ $item->title ?? null }}"
							>
								{{ $item->title ?? null }}
							</a>
						</div>
					</li>
				@endforeach
			</ul>
		</div>
	</div>

	<div class="template-collapse-wrapper">
		<h3 class="template-collapse__title text text_brown text_semi-bold">Новости</h3>
		<div class="template-collapse news-collapse">
			<div class="template-collapse__item">
				@if ($first = $latest_news->shift())
				<span class="template-collapse__data text text_14m text_white-f6">
					{{ $first ? formatDateForView($first->date ?? null) : null }}
				</span>
				<a href="{{ route('news.show', $first->only('slug')) }}"
				   class="template-collapse__text text text_14m "
				   title="{{ $first->title ?? null }}"
				>
					{{ $first->title ?? null }}
				</a>
				<button class="button template-collapse__icon-button" aria-label="Свернуть или развернуть список новостей">
					<svg class="template-collapse__icon" width="11" height="7" viewBox="0 0 11 7" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path fill-rule="evenodd" clip-rule="evenodd" d="M10.5938 1.93791C10.8778 1.67164 10.8778 1.23994 10.5938 0.973668C10.3098 0.707405 9.84929 0.707405 9.56529 0.973668L5.71591 4.58246L1.86654 0.973668C1.58251 0.707404 1.12203 0.707404 0.838014 0.973668C0.553996 1.23994 0.553996 1.67164 0.838014 1.93791L5.20165 6.02882C5.48567 6.29508 5.94615 6.29508 6.23017 6.02882L10.5938 1.93791Z" fill="#F17757"/>
					</svg>
				</button>
				@endif
			</div>
			<ul class="collapse-content">
				@foreach ($latest_news ?? [] as $item)
					<li class="template-collapse__list-item">
						<div class="template-collapse__item">
							<span class="template-collapse__data text text_14m text_white-f6">
								{{ formatDateForView($item->date ?? null) }}
							</span>
							<a class="template-collapse__text text text_14m "
							   href="{{ route('news.show', $item->only('slug')) }}"
							   title="{{ $item->title ?? null }}"
							>
								{{ $item->title ?? null }}
							</a>
						</div>
					</li>
				@endforeach
			</ul>
		</div>
	</div>
	<div class="template-collapse-wrapper">
		<h3 class="template-collapse__title text text_brown text_semi-bold">Меры поддержки</h3>
		<div class="template-collapse services-collapse">
			<div class="template-collapse__item">
				@if ($first = $latest_services->shift())
				<a href="{{ route('service.show', $first->only('slug')) }}"
				   class="template-collapse__text text text_14m template-collapse__text-services"
				   title="{{ $first->title ?? null }}"
				>
					{{ $first->title ?? null }}
				</a>
				<button class="button template-collapse__icon-button" aria-label="Свернуть или развернуть список сервисов">
					<svg class="template-collapse__icon" width="11" height="7" viewBox="0 0 11 7" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path fill-rule="evenodd" clip-rule="evenodd" d="M10.5938 1.93791C10.8778 1.67164 10.8778 1.23994 10.5938 0.973668C10.3098 0.707405 9.84929 0.707405 9.56529 0.973668L5.71591 4.58246L1.86654 0.973668C1.58251 0.707404 1.12203 0.707404 0.838014 0.973668C0.553996 1.23994 0.553996 1.67164 0.838014 1.93791L5.20165 6.02882C5.48567 6.29508 5.94615 6.29508 6.23017 6.02882L10.5938 1.93791Z" fill="#F17757"/>
					</svg>
				</button>
				@endif
			</div>
			<ul class="collapse-content">
				@foreach ($latest_services ?? [] as $item)
					<li class="template-collapse__list-item">
						<div class="template-collapse__item">
							<a class="template-collapse__text text text_14m "
							   href="{{ route('service.show', $item->only('slug')) }}"
							   title="{{ $item->title ?? null }}"
							>
								{{ $item->title ?? null }}
							</a>
						</div>
					</li>
				@endforeach
			</ul>
		</div>
	</div>
</div>

@push('scripts')
	<script src="/utils/js/jquery-ui.min.js"></script>
@endpush
