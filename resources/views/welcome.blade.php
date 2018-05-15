<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name') ?? 'Library' }}</title>

        <!-- CSS -->
        <link href="{{ mix('css/app.css') }}" rel="stylesheet">
        <!-- JS -->
        <script src="{{ asset('js/lang.js') }}"></script>
        <script src="{{ mix('js/app.js') }}"></script>
    </head>
    <body>
        <div id="app">
            <v-app>
                <v-content>
                    <v-container>
                        <books-table></books-table>
                    </v-container>
                </v-content>
            </v-app>
        </div>
    </body>
</html>
