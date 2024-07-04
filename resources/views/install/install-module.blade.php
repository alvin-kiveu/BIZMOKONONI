@extends('layouts.install')
@section('title', 'Installation/Update')

@section('content')
<div class="container">
    <div class="row">

        <div class="col-md-8 col-md-offset-2">
            <br/><br/>

            <div class="box box-primary active">
                <!-- /.box-header -->
                <div class="box-body">

              @if(session('error'))
                <div class="alert alert-danger">
                    {!! session('error') !!}
                </div>
              @endif

              @if ($errors->any())
                <div class="alert alert-danger">
                  <ul>
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                  </ul>
                </div>
              @endif

              <form class="form" id="details_form" method="post" 
                      action="{{$action_url}}">
                    {{ csrf_field() }}

                    <h2> License Details - <code>{{$module_display_name}} Module</code><br/><small class="text-danger"> Make sure to provide correct licensing information</small></h2>
                    <hr/>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="license_code">License Code:*</label>
                            <input type="text" name="license_code" required class="form-control" id="license_code">

                            @if($intruction_type == 'uf')
                                <p class="help-block"><a href="https://ultimatefosters.com/docs/ultimate-fosters-shop/license-key/#Getting-License-Details-for-products-purchased-from-ultimatefosterscom" target="_blank">Where is my License Key?</a></p>
                            @endif

                            @if($intruction_type == 'cc')
                                <p class="help-block"><a href="https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code-#:~:text=Hover%20the%20mouse%20over%20your,as%20PDF%20or%20text%20file)." target="_blank">Where is my License Key?</a></p>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="login_username">Login Username:*</label>
                            <input type="text" name="login_username" required class="form-control" id="login_username">

                            @if($intruction_type == 'uf')
                                <p class="help-block"><a href="https://ultimatefosters.com/docs/ultimate-fosters-shop/user-name/#Steps-to-get-your-username-for-all-products-purchased-from-UltimateFosters" target="_blank" class="text-success">Where is my Username?</a></p>
                            @endif

                            @if($intruction_type == 'cc')
                                <p class="help-block">Enter the username that you use for codecanyon or envato login</p>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                          <label for="envato_email">Your Email:</label>
                          <input type="email" name="ENVATO_EMAIL" class="form-control" id="envato_email" placeholder="optional">
                          <p class="help-block">For Newsletter & support</p>
                        </div>
                    </div>

                    @if($intruction_type == 'cc')
                        @include('install.partials.e_license')
                    @endif

                    <div class="col-md-12">
                        <button type="submit" id="install_button" class="btn btn-primary pull-right">I Agree, SUBMIT</button>
                    </div>
              </form>
            </div>
          <!-- /.box-body -->
          </div>

            
        </div>

    </div>
</div>
@endsection

@section('javascript')
  <script type="text/javascript">
    $(document).ready(function(){
      $('form#details_form').submit(function(){
        $('button#install_button').attr('disabled', true).text('Installing...');
        $('div.install_msg').removeClass('hide');
        $('.back_button').hide();
      });
    })
  </script>
@endsection