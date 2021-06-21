@if(auth()->guest())
@else
<div class="container-lg" style="background: transparent !important;">
    <div class="row mb-1">
      <div id="loyaltybanner" class="col-md-4 col-12 mt-1 d-none d-sm-block">
                  <div class="container-container" style="z-index: 1;">
        <div class="card text-center" style="min-height: 150px; background: transparent !important;">
        <div class="card-body" style="background: url(/img/misc/carbon.png) !important;">
            <img src="/img/logo/ico.png" style="max-height: 19px;"> Loyalty Club
            <hr>
            @if(auth()->user()->vipLevel() > '0')
            <a onclick="$.vip()" class="btn btn-primary p-1 m-1">Loyalty Rewards</a>
            @else
            <a onclick="$.vip()" class="btn btn-primary p-1 m-1">Loyalty Rewards</a>
            <a onclick="redirect('/bonus/')" class="btn btn-primary p-1 m-1">Bonus</a>
            @endif
            @if(auth()->user()->weekly_bonus_obtained)
            <a onclick="$.vipBonus()" class="btn btn-primary p-1 m-1 disabled">Royalty Claimed</a>
            @elseif(auth()->user()->vipLevel() > '0')
            @php
            $bonuses = number_format(((auth()->user()->weekly_bonus ?? 0) / 100) * auth()->user()->vipBonus(), 8, '.', '');
            $bonususd = number_format(($bonuses * \App\Http\Controllers\Api\WalletController::rateDollarxBLZD()), 2, '.', '');
            @endphp
            <a onclick="$.vipBonus()" class="btn btn-primary p-1 m-1">Daily Royalty - {!! __('general.takeindex', ['value' => floatval($bonususd), 'icon' => "fas fa-usd-circle"]) !!}</a>
            @else
            @endif
          </div>
        </div>
      </div>
      </div>
      <div class="col-md-8 col-sm-12 ">
          <div class="container-flex owl-carousel topcarousel" style="z-index: 1;">
              <div class="carousel-container" style="background: url(img/misc/races.svg); background-size: cover; background-position: center; min-height: 148px;">
                <div class="card-body">
                  @php
                  $first = (\App\Settings::where('name', 'races_prize_1st')->first()->value);
                  $second = (\App\Settings::where('name', 'races_prize_2nd')->first()->value);
                  $third = (\App\Settings::where('name', 'races_prize_3rd')->first()->value);
                  $fs = (\App\Settings::where('name', 'races_prize_freespins')->first()->value * 7);
                  $prizes = $first + $second + $third;
                  @endphp
                  <div class="card-text" style="padding: 5px; position: absolute;bottom: 0;text-shadow: 1px 1px black !important;">
                    <b>Today's Race</b>
                    <br>
                    <small><i class="fas fa-usd-circle me-1" style="color: #0fd560;"></i> Total Prizepool:  {{ $prizes }}$ and {{ $fs }} Free Spins</small>
                    <br>
                  <small><i style="color: #0fd560;" class="fas fa-stopwatch me-1"></i> Ending in <?php $timeLeft = 86400 - (time() - strtotime("today")); echo date("H\\h  i\\m", $timeLeft); ?></small></p>
                </p></div>
                <button style="position: absolute;bottom: 15px;right: 15px;text-shadow: 0px 1px black !important;" onclick="$.races()" class="btn btn-danger p-2">Check Race</button>
              </div>
            </div>
            <div class="carousel-container" style="background: url(img/misc/bonus-box.svg); background-size: cover; background-position: center; min-height: 148px;">
              <div class="card-body">
                <p class="card-text" style="text-shadow: 1px 1px black !important;">
               <p><i style="color: #0fd560;" class="fas fa-gift me-1"></i> Use our <b>Deposit Doubler</b> or <b>Faucet</b> for chunky bonuses.</p>

                  <div style="left: 0px; text-shadow: 1px 1px black !important;" class="carousel-caption d-none d-md-block">
                <button style="position: absolute;bottom: 45%;left: 5%;text-shadow: 0px 1px black !important;" onclick="redirect('/bonus')" class="btn btn-danger p-2">Bonus Section</button>
                  </div>
                </p>
              </div>
            </div>
            <div class="carousel-container" style="background: url(/img/misc/earncrypto.svg); background-size: cover; background-position: center; min-height: 148px;">
              <div class="card-body">
                <div class="card-text" style="padding: 5px; position: absolute;bottom: 0;text-shadow: 1px 1px black !important;">
                  <br>
                  <small><i class="fad fa-money-bill-alt me-1" style="color: #0fd560;"></i> Earn ETHEREUM <i class="{{ \App\Currency\Currency::find('xBLZD')->icon() }}" style="color: {{ \App\Currency\Currency::find('xBLZD')->style() }}"></i> instantly completing surveys & offers</small>
                </p></div>
                <button style="position: absolute;bottom: 15px;right: 15px;text-shadow: 0px 1px black !important;" onclick="redirect('/earn')" class="btn btn-danger p-2">Earn Wall</button>
              </div>
            </div>
            <div class="carousel-container" style="background: url(/img/misc/promocodes.svg); background-size: cover; background-position: center; min-height: 148px;">
              <div class="card-body">
                <div class="card-text" style="padding: 5px; position: absolute;bottom: 0;right:5%;text-shadow: 1px 1px black !important;">
                  <br>
                  <small>We automatically share promocodes on our socials!</small>
                </p></div>
                <button style="position: absolute;bottom: 35%;right: 14%;text-shadow: 0px 1px black !important;" onclick="redirect('/bonus')" class="btn btn-primary p-2">Enter Promocode</button>
              </div>
            </div>
      </div>
    </div>

</div>
@foreach(\App\GlobalNotification::get() as $notification)
<div class="col-md-12">
  <div class="d-flex">
    @if(!auth()->guest() && auth()->user()->isDismissed($notification)) @continue @endif
    <div class="alert alert-info globalNotification p-2 m-0 mb-3" id="emailNotification" style="border-radius: 14px !important;
    padding: 0.75rem !important;
    margin-bottom: 1rem;
    border: 1px solid #ffffff0d;
    color: #ebebeb !important;
    font-family: 'geogrotesque wide med';
    background: url(/img/misc/arrows.svg), #182132 !important";>
      <div class="icon"><i class="{{ $notification->icon }}"></i></div>
      <div class="text">{{ $notification->text }}</div>
    </div>
  </div>

</div>
@endforeach

@php
$freespins = \App\Settings::where('name', 'freespin_slot')->first()->value;
$slotname = \App\Slotslist::get()->where('id', $freespins)->first();
$freespinevo = \App\Settings::where('name', 'evoplay_freespin_slot')->first()->value;
$evoslotname = \App\Slotslist::get()->where('u_id', $freespinevo)->first()->n;
$evoslotabsolute = \App\Slotslist::get()->where('u_id', $freespinevo)->first()->id;

$notify = auth()->user()->unreadNotifications();
@endphp
@if(auth()->user()->freegames > '1')
<div class="alert alert-info mb-3 mt-3" role="alert">
  You have <strong>{{ auth()->user()->freegames }} free <i class="{{ \App\Currency\Currency::find('xBLZD')->icon() }}" style="color: {{ \App\Currency\Currency::find('xBLZD')->style() }}"></i> spins</strong> on your account! Get spinning on {{ $slotname->p }}'s <a href="/slots/{{ $slotname->id }}" span style="capitalize; font-weight: 600 !important;">{{ $slotname->n }}</a> or on EvoPlay's <a href="/slots-evo/{{ $evoslotabsolute }}" span style="capitalize; font-weight: 600 !important;">{{ $evoslotname }}</a>.</b>
</span>
</div>
@endif
</div>
@endif
<div class="container-lg">

@if(auth()->guest())
<div class="row">
<div class="col-12 col-sm-12 col-md-6">
  <div class="bonus-box-small" style="min-height: 335px;">
    <div class="banner-img banner-welcome-slots" style="background: url(img/misc/races.svg); background-size: cover; background-position: center; min-height: 145px;"></div>
    <div class="text">
      <div class="header"><h5>Daily Races Playing Slots!</h5></div>
      <p>In addition to <a href="/fairness">Provably Fair</a> games, we offer fun daily races and events to compete playing your favorite slots.</p>
      <p>From Netent to Pragmatic Play, here at {{ \App\Settings::where('name', 'platform_name')->first()->value }} you will never get bored with over 23 game providers.</p>
      <div class="btn btn-primary m-1 p-2" style="float: right;" onclick="$.races()">Races</div>
      <div class="btn btn-secondary m-1 p-2" style="float: right;" onclick="redirect('/gamelist')">Our Games</div>
    </div></div>
  </div>
  <div class="col-12 col-sm-12 col-md-6">
    <div class="bonus-box-small" style="min-height: 335px;">
    <div class="banner-img banner-welcome-slots" style="background: url(img/misc/earncrypto.svg); background-size: cover; background-position: center; min-height: 145px;"></div>
      <div class="text">
        <div class="header"><h5>Tons of Rewards!</h5></div>
        <p>We offer constant bonuses, check out our Loyalty Reward Program, Daily Rakeback, partner program and more.</p>
        <p>Get paid in ETHEREUM <i class="{{ \App\Currency\Currency::find('xBLZD')->icon() }}" style="color: {{ \App\Currency\Currency::find('xBLZD')->style() }}"></i> instantly without a single deposit by completing offers on our earn section.</p>
        <div class="btn btn-primary m-1 p-2" style="float: right;" onclick="redirect('/earn/')">Earn Wall</div>
        <div class="btn btn-secondary m-1 p-2" style="float: right;" onclick="redirect('/bonus/')">Promotions</div>

      </div></div>
    </div>
  </div>


          @endif


            <div class="games-box" style="z-index: 1;">
              @foreach(\App\Games\Kernel\Game::list() as $game)
              @if(!$game->isDisabled() &&  $game->metadata()->id() !== "slotmachine" && $game->metadata()->id() !== "evoplay")
              <div class="card" onclick="redirect('/game/{{ $game->metadata()->id() }}')" style="cursor: pointer; margin: 10px !important; width: 230px;">
                <div class="game_poster" style="background-image:url(/img/game/{{ $game->metadata()->id() }}.png)" @if(!$game->isDisabled()) onclick="redirect('/game/{{ $game->metadata()->id() }}')" @endif>
                  <?php
                  $getname = $game->metadata()->name();
                  ?>

                @if($getname == "Slide")
                  <div class="label-red">
                    NEW!
                  </div>
                  @endif
                  <div class="label-fair">
                    FAIR
                  </div>
                </div>
                <div class="card-footer" style="width: 230px;">
                  <h6 class="card-title">{{ $game->metadata()->name() }}</h5>
                 </div>
                </div>
                @else
                @endif
                @endforeach
              </div>
          </div>