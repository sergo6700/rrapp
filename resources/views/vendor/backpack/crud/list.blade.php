@extends('backpack::layout')

@section('header')
	<section class="content-header">
	  <h1>
      <span class="text-capitalize">{!! $crud->getHeading() ?? $crud->entity_name_plural !!}</span>
      <small id="datatable_info_stack">{!! $crud->getSubheading() ?? trans('backpack::crud.all').'<span>'.$crud->entity_name_plural.'</span> '.trans('backpack::crud.in_the_database') !!}.</small>
	  </h1>
	  <ol class="breadcrumb">
	    <li><a href="{{ url(config('backpack.base.route_prefix'), 'dashboard') }}">{{ trans('backpack::crud.admin') }}</a></li>
	    <li><a href="{{ url($crud->route) }}" class="text-capitalize">{{ $crud->entity_name_plural }}</a></li>
	    <li class="active">{{ trans('backpack::crud.list') }}</li>
	  </ol>
	</section>
@endsection

@section('content')
<!-- Default box -->
  <div class="row">

    <!-- THE ACTUAL CONTENT -->
    <div class="{{ $crud->getListContentClass() }}">
      <div class="">

        @php
            $prefix = config('backpack.base.route_prefix', 'admin') . '/';
            $replace = '';
            $page_alias = str_replace($prefix, $replace, $crud->getRoute());

            $pageMetadata = \App\Models\PageMetadata\PageMetadata::where('page_alias', $page_alias)->first(); @endphp
        @if ($pageMetadata)
        <div class="row m-b-20">
          <div class="col-xs-6">
              <a href="#" id="pageMetaDataFormVisibilitySwitch">
                  Скрыть форму заполнения мета-тегов для раздела «{!! $crud->getHeading() ?? $crud->entity_name_plural !!}»
              </a>
              <form id="pageMetadataForm" action="#" method="POST" style="border: 1px dotted; overflow: hidden;">
                  <input type="hidden" name="page_alias" value="{{ $page_alias }}">
                  <div class="form-group col-xs-12">
                      <label>Название (title)</label>
                      <input type="text" name="title" value="{{ $pageMetadata->title }}" class="form-control">
                  </div>
                  <div class="form-group col-xs-12">
                      <label>Описание (description)</label>
                      <input type="text" name="description" value="{{ $pageMetadata->description }}" class="form-control">
                  </div>
                  <div id="saveActions" class="form-group col-xs-12">
                      <div class="btn-group">
                          <button type="submit" class="btn btn-success">
                              <span class="fa fa-save" role="presentation" aria-hidden="true"></span> &nbsp;
                              <span data-value="save_and_back">Сохранить</span>
                          </button>
                      </div>
                  </div>
              </form>
          </div>
        </div>
        @endif

        <div class="row m-b-10">
          <div class="col-xs-6">

            @if ( $crud->buttons->where('stack', 'top')->count() ||  $crud->exportButtons())
            <div class="hidden-print {{ $crud->hasAccess('create')?'with-border':'' }}">

              @include('crud::inc.button_stack', ['stack' => 'top'])

            </div>
            @endif
          </div>
          <div class="col-xs-6">
              <div id="datatable_search_stack" class="pull-right"></div>
          </div>
        </div>

        {{-- Backpack List Filters --}}
        @if ($crud->filtersEnabled())
          @include('crud::inc.filters_navbar')
        @endif

        <div class="overflow-hidden">

        @if($crud->getColumns())
        <table id="crudTable" class="box table table-striped table-hover display responsive nowrap m-t-0" cellspacing="0">
            <thead>
              <tr>
                {{-- Table columns --}}
                @foreach ($crud->columns as $column)
                  <th
                    data-orderable="{{ var_export($column['orderable'], true) }}"
                    data-priority="{{ $column['priority'] }}"
                    data-visible="{{ var_export($column['visibleInTable'] ?? true) }}"
                    data-visible-in-modal="{{ var_export($column['visibleInModal'] ?? true) }}"
                    data-visible-in-export="{{ var_export($column['visibleInExport'] ?? true) }}"
                    >
                    {!! $column['label'] !!}
                  </th>
                @endforeach

                @if ( $crud->buttons->where('stack', 'line')->count() )
                  <th data-orderable="false" data-priority="{{ $crud->getActionsColumnPriority() }}" data-visible-in-export="false">{{ trans('backpack::crud.actions') }}</th>
                @endif
              </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
              <tr>
                {{-- Table columns --}}
                @foreach ($crud->columns as $column)
                  <th>{!! $column['label'] !!}</th>
                @endforeach

                @if ( $crud->buttons->where('stack', 'line')->count() )
                  <th>{{ trans('backpack::crud.actions') }}</th>
                @endif
              </tr>
            </tfoot>
          </table>
          @endif

          @if ( $crud->buttons->where('stack', 'bottom')->count() )
          <div id="bottom_buttons" class="hidden-print">
            @include('crud::inc.button_stack', ['stack' => 'bottom'])

            <div id="datatable_button_stack" class="pull-right text-right hidden-xs"></div>
          </div>
          @endif

        </div><!-- /.box-body -->

      </div><!-- /.box -->
    </div>

  </div>

@endsection

@section('after_styles')
  <!-- DATA TABLES -->
  <link href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.1.5/css/fixedHeader.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.bootstrap.min.css">

  <link rel="stylesheet" href="{{ asset('vendor/backpack/crud/css/crud.css') }}">
  <link rel="stylesheet" href="{{ asset('vendor/backpack/crud/css/form.css') }}">
  <link rel="stylesheet" href="{{ asset('vendor/backpack/crud/css/list.css') }}">

  <!-- CRUD LIST CONTENT - crud_list_styles stack -->
  @stack('crud_list_styles')
@endsection

@section('after_scripts')
	@include('crud::inc.datatables_logic')

  <script src="{{ asset('vendor/backpack/crud/js/crud.js') }}"></script>
  <script src="{{ asset('vendor/backpack/crud/js/form.js') }}"></script>
  <script src="{{ asset('vendor/backpack/crud/js/list.js') }}"></script>

  <script type="text/javascript">
    jQuery(document).ready(function($) {
        $form = $('#pageMetadataForm');

        $form.submit(function (event) {
            event.preventDefault();

            const URL = '{{ route('admin.pagemetadata.store') }}'
            let data = $(this).serialize();

            $.ajax({
                type: "POST",
                url: URL,
                data: data,
                dataType: 'json',
                success: function(data) {
                    $form.find('input[type="text"]').each(function () {
                        $(this).parent('.form-group').removeClass('has-error');
                        $(this).siblings('.help-block').remove();
                    })
                },
                error: function (jqXHR) {
                    let responseText = JSON.parse(jqXHR.responseText)

                    $.each( responseText.errors, function( key, value ) {
                        let el = $form.find('input[name="'+key+'"]');
                        if (el.length > 0) {
                            el.parent('.form-group').addClass('has-error');
                            el.after('<span class="help-block">' + value + '</span>')
                        }
                    });

                }
            });

        });

        $( "#pageMetaDataFormVisibilitySwitch" ).click(function(event) {
            event.preventDefault();
            let $this = $(this);

            if ($form.is(":visible")) {
                $this.text('Развернуть форму заполнения мета-тегов для раздела «{!! $crud->getHeading() ?? $crud->entity_name_plural !!}»');
                $form.slideUp( "slow");
            } else {
                $this.text('Скрыть форму заполнения мета-тегов для раздела «{!! $crud->getHeading() ?? $crud->entity_name_plural !!}»');
                $form.slideDown( "slow");
            }
        });
    });
  </script>


  <!-- CRUD LIST CONTENT - crud_list_scripts stack -->
  @stack('crud_list_scripts')
@endsection
