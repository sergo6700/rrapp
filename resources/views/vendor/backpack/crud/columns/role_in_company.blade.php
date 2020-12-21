{{-- show the current role of user in company --}}
@php
	$value = $entry->{$column['name']};

	$role_name = '—';
	if ($value) {
		$user_roles_in_company = config('handbook.user_roles');
		$key = keySearchInMultidimensionalArray($user_roles_in_company, 'id', $value);

		if (array_key_exists($key, $user_roles_in_company)) {
			$role_name = $user_roles_in_company[$key]['name'];
		}
	}
@endphp

<span>
	{{$role_name}}
</span>
