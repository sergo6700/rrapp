<div class="services-container services-container_small">
    @if($services->count())
        @each('components.layouts.includes.services-card-with-tag', $services, 'item')
    @else
        <p class="services-container__item-center">Услуги не найдены, попробуйте удалить тег.</p>
    @endif
</div>
@include('components.layouts.includes.pagination', ['paginator' => $services])