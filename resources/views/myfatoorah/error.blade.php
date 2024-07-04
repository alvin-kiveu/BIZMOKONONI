<!DOCTYPE html>
<html lang="{{app()->getLocale()}}">
    <head>
        <title>{{__('myfatoorah.pageError')}}</title>
        <link rel="stylesheet" href="{{asset('vendor/myfatoorah/css/style.css')}}"/>
    </head>

    <body dir="{{App::isLocale('ar') ? 'rtl' : 'ltr'}}">
        <div class="mf-payment-methods-container">
            <div class="mf-danger-text">
                {{$exMessage}}
            </div>
        </div>
    </body>
</html>
