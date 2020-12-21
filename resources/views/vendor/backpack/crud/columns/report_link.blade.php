<span>
	@if ($entry->report_file)
		<a href="{{ asset($entry->report_file->path) }}">{{ $entry->report_file->filename }}</a>
	@endif
</span>