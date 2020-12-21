<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Статистика для мероприятия: {{ $event->title }}</title>
    <!-- Bootstrap 3.4.1 -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    <link rel="stylesheet" href="http://localhost:31080/vendor/adminlte/bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/') }}/dist/css/AdminLTE.min.css">

</head>
<body>

    <section class="content-header">
        <h1>Статистика</h1>
    </section>

    <section class="content">

        <div class="row">
            <div class="col-md-12">
                <div class="box">

                    <div class="box-header with-border">
                        <div class="box-title">Для мероприятия: <strong>{{ $event->title }}</strong></div>
                    </div>

                    <div class="box-body">
                        <h3>Всего зарегистрированных пользователей: {{ $event->registrations->count() }}</h3>
                        <br>

                        <div id="newUsersBlock" class="table-responsive">
                            <table class="table table-striped text-center">
                                <tbody>
                                    <tr>
                                        <td>ФИО</td>
                                        <td>Email</td>
                                        <td>Телефон</td>
                                        <td>ИНН</td>
{{--                                        <td>Наименование бизнеса</td>--}}
                                        <td>Источник</td>
                                    </tr>

                                    @foreach ($event->registrations as $registration)
                                    <tr>
                                        <td>{{ $registration->user->name }}</td>
                                        <td>{{ $registration->user->email }}</td>
                                        <td>{{ $registration->user->phone }}</td>
                                        <td>{{ $registration->user->tin }}</td>
{{--                                        <td>{{ $registration->user->company_name }}</td>--}}
                                        <td>{{ \App\Support\Enum\User\UserSourceType::getValue(
                                                $registration->user->userSource->source
                                            ) }}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <br>
                        <div class="contentDivider"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</body>
</html>
