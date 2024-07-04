<!-- Static navbar -->
<nav class="navbar-default navbar-static-top tw-transition-all tw-duration-5000 tw-shrink-0 tw-rounded-2xl tw-m-[16px] tw-border-2 tw-bg-white">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar" style="margin-top: 3px; margin-right: 3px;">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/">{{config('app.name', 'ultimatePOS')}}</a>
    </div>
    <div id="navbar" class="navbar-collapse collapse">
      <ul class="nav navbar-nav">
        @if(Auth::check())
            <li><a href="{{ action([\App\Http\Controllers\HomeController::class, 'index']) }}">@lang('home.home')</a></li>
        @endif
        @if(Route::has('frontend-pages') && config('app.env') != 'demo' 
        && !empty($frontend_pages))
            @foreach($frontend_pages as $page)
                <li><a href="{{ action([\Modules\Superadmin\Http\Controllers\PageController::class, 'showPage'], $page->slug) }}">{{$page->title}}</a></li>
            @endforeach
        @endif
        @if(Route::has('pricing') && config('app.env') != 'demo')
        <li><a href="{{ action([\Modules\Superadmin\Http\Controllers\PricingController::class, 'index']) }}">@lang('superadmin::lang.pricing')</a></li>
        @endif
        @if(Route::has('repair-status'))
        <li>
          <a href="{{ action([\Modules\Repair\Http\Controllers\CustomerRepairStatusController::class, 'index']) }}">
            @lang('repair::lang.repair_status')
          </a>
        </li>
        @endif
      </ul>
      <ul class="nav navbar-nav navbar-right">
        @if (Route::has('login'))
            @if(!Auth::check())
                <li><a href="{{ route('login') }}">@lang('lang_v1.login')</a></li>
                @if(config('constants.allow_registration'))
                    <li><a href="{{ route('business.getRegister') }}">@lang('lang_v1.register')</a></li>
                @endif
            @endif
        @endif
      </ul>
    </div><!-- nav-collapse -->
  </div>
</nav>