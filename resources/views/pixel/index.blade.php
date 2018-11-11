@php
// Инициализация
// use Yandex\Metrica\Management\ManagementClient;
// use Yandex\Metrica\Stat\StatClient;
// $managementClient = new ManagementClient('AQAAAAAhqCzUAAVIZ8DetkvHYEkbj-dYTXyTJE8');

// API отчетов v1
// Инициализация
// $statClient = new StatClient('AQAAAAAhqCzUAAVIZ8DetkvHYEkbj-dYTXyTJE8');

// Пример получения отчета «Технологии — Браузеры»
// $paramsModel = new Yandex\Metrica\Stat\Models\TableParams();
// $paramsModel
//      ->setPreset(\Yandex\Metrica\Stat\AvailableValues::PRESET_TECH_PLATFORMS)
//    ->setDimensions(\Yandex\Metrica\Stat\DimensionsConst::S_BROWSER)
//    ->setId(50830009);
// $data = $statClient->data()->getTable($paramsModel)

// $url = 'https://api-metrika.yandex.ru/stat/v1/data';

// $params = [
//    'ids'         => '46303371',
//    'oauth_token' => 'AQAAAAAhqCzUAAVIZ8DetkvHYEkbj-dYTXyTJE8',
//    'metrics'     => 'ym:s:visits, ym:s:users, ym:s:affinityIndexInterests, ym:s:bounceRate, ym:s:pageDepth, ym:s:avgVisitDurationSeconds',
//];
@endphp



    {{--{!! strip_tags($result_op->body) !!}--}}

            <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
    </head>
    <body>
    <div class="container">
        <code>
                 {{--@php--}}

//                     $metrica = file_get_contents('https://api-metrika.yandex.ru/stat/v1/data?&id=50830009&oauth_token=AQAAAAAhqCzUAAVIZ8DetkvHYEkbj-dYTXyTJE8&metrics=ym:s:visits,%20ym:s:users,%20ym:s:affinityIndexInterests,%20ym:s:bounceRate,%20ym:s:pageDepth,%20ym:s:avgVisitDurationSeconds');
//
//                     //var_dump($data) ;

//                 var_dump($metrica)  ;
                 {{--@endphp--}}
        </code>
    </div>

    </body>
    </html>


