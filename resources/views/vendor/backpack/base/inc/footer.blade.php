@if (config('backpack.base.show_powered_by'))
    {{ trans('backpack::base.powered_by') }} <a target="_blank" href="http://backpackforlaravel.com?ref=panel_footer_link">Backpack for Laravel</a>
@endif
@if (config('backpack.base.developer_link') && config('backpack.base.developer_name'))
    <div class="pull-right hidden-xs">
    {{ trans('backpack::base.handcrafted_by') }} <a target="_blank" href="{{ config('backpack.base.developer_link') }}">{{ config('backpack.base.developer_name') }}</a>.
    </div>
@endif

<!-- Modal -->
<div class="modal fade" id="viewUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Предпросмотр пользователя
                    #<span class="modal-title__id"></span> —
                    <span class="modal-title__name"></span>
                </h4>
            </div>
            <div class="modal-body" style="font-size: 14px;">

                <div role="tabpanel">

                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#personTab" aria-controls="personTab" role="tab" data-toggle="tab">{{ trans('labels.personal_info') }}</a>
                        </li>
                        <li role="presentation">
                            <a href="#upcomingTab" aria-controls="upcomingTab" role="tab" data-toggle="tab">{{ trans('labels.upcoming_events') }}</a>
                        </li>
                        <li role="presentation">
                            <a href="#pastTab" aria-controls="pastTab" role="tab" data-toggle="tab">{{ trans('labels.past_events') }}</a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="personTab">
                            <table id="viewUserTable" class="table table-striped table-condensed m-b-0" style="font-size: 16px;">
                                <tbody id="viewUserTbody">
                                    <tr>
                                        <td><b>ID</b></td>
                                        <td data-key="id"></td>
                                    </tr>
                                    <tr>
                                        <td><b>Дата регистрации:</b></td>
                                        <td data-key="created_at"></td>
                                    </tr>
                                    <tr>
                                        <td><b>ФИО:</b></td>
                                        <td data-key="name"></td>
                                    </tr>
                                    <tr>
                                        <td><b>Email:</b></td>
                                        <td data-key="email"></td>
                                    </tr>
                                    <tr>
                                        <td><b>Телефон:</b></td>
                                        <td data-key="phone"></td>
                                    </tr>
                                    <tr>
                                        <td><b>Роль:</b></td>
                                        <td data-key="role_in_company_id"></td>
                                    </tr>
                                    <tr>
                                        <td><b>ИНН:</b></td>
                                        <td data-key="tin"></td>
                                    </tr>
                                    <tr>
                                        <td><b>Своя роль:</b></td>
                                        <td data-key="custom_role"></td>
                                    </tr>
                                    <tr>
                                        <td><b>Наименование компании:</b></td>
                                        <td data-key="company_name"></td>
                                    </tr>
                                    <tr>
                                        <td><b>Юридический адрес:</b></td>
                                        <td data-key="legal_address"></td>
                                    </tr>
                                    <tr>
                                        <td><b>КПП:</b></td>
                                        <td data-key="kpp"></td>
                                    </tr>
                                    <tr>
                                        <td><b>ОГРН:</b></td>
                                        <td data-key="ogrn"></td>
                                    </tr>
                                    <tr>
                                        <td><b>Функция:</b></td>
                                        <td data-key="function"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="upcomingTab">...</div>
                        <div role="tabpanel" class="tab-pane" id="pastTab">...</div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
