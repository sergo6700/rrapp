@extends('/components/include')
@push('styles')
	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css"
	integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
	crossorigin=""/>
@endpush
<div class="map-container">
	<div id="map" class="map"></div>
	@include('components.layouts.includes.map-popup-card')
</div>
