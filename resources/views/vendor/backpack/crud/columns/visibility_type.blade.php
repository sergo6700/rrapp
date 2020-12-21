@php
	$visibility_type_id = data_get($entry, $column['name']);

	$visibility_type = '-';
	switch ($visibility_type_id) {
		case App\Support\Enum\Post\VisibilityType::FULL:
			$visibility_type = 'Нет';
			break;
		case App\Support\Enum\Post\VisibilityType::PARTIAL:
			$visibility_type = 'Частичное';
			break;
		case App\Support\Enum\Post\VisibilityType::AUTH_ONLY:
			$visibility_type = 'Полное';
			break;
	}
@endphp

<span>
	{{ $visibility_type }}
</span>
