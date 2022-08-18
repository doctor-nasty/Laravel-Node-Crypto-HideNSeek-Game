@extends('layouts.mainlayout')

@section('content')

<div id="app">
</div>
          <div class="content-wrapper">
            @if(session()->get('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
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
            @if (session('status'))
              <div class="alert alert-success" role="alert">
                {{ session('status') }}
              </div>
            @endif
            <div class="row">
              <div class="col-md-6 grid-margin">
                <div class="dashboard-card">
                  <div class="dashboard-card-text">
                    <h5>@lang('dashboard.games_played')</h5>
                    <span class="dashboard-card-number">{{$games_played}}</span>
                  </div>
                  <div class="dashboard-card-image">
                    <img src="{{ asset('images/component2.png') }}" alt="">
                  </div>
                </div>
              </div>
              <div class="col-md-6 grid-margin">
                <div class="dashboard-card">
                  <div class="dashboard-card-text">
                    <h5>@lang('dashboard.points_earned')</h5>
                    <span class="dashboard-card-number">120</span>
                  </div>
                  <!-- <span class="dashboard-card-number">{{Auth::user()->total_winning_points}}</span> -->
                  <div class="dashboard-card-image">
                    <img src="{{ asset('images/component.png') }}" alt="">
                  </div>
                </div>
              </div>
            </div>
            <div class="row AccountData_player_card__8sRvn">
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 AccountData_player_avatar__YjLms" style="display: flex; justify-content: center;">
                <span class="AccountData_avatar_image___srYL"><img class="avatar-picture main" src="/storage/avatars/{{Auth::user()->avatar}}" style="background-color: rgb(59, 59, 59); width: 180px; display: flex;">
                <a href="https://hidenseek.test/settings" class="avatar-edit-circle"><svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" style="margin: 12px;"><path d="M15.2656 3.85938L13.7422 5.38281L10.6172 2.25781L12.1406 0.734375C12.2969 0.578125 12.4922 0.5 12.7266 0.5C12.9609 0.5 13.1562 0.578125 13.3125 0.734375L15.2656 2.6875C15.4219 2.84375 15.5 3.03906 15.5 3.27344C15.5 3.50781 15.4219 3.70312 15.2656 3.85938ZM0.5 12.375L9.71875 3.15625L12.8438 6.28125L3.625 15.5H0.5V12.375Z" fill="white"></path></svg></a>
            </span>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 AccountData_player_name__55xMi" style="display: flex; flex-direction: column; flex: 1 1 0%; margin-left: 30px; padding-left: 0px; padding-right: 0px;">
        <span style="display: flex; flex-direction: column;">
        <h4 style="padding-left: 8px; margin-top: -4px;"></h4>
        <span class="account-copy" style="display: flex; margin-top: 5px;">
        <p class="account-address">0x4f...33b0<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" style="margin-left: 8px;"><path d="M1.54907 15.7588L10.9241 15.7588C11.7151 15.7588 12.3303 15.1143 12.3303 14.3525L12.3303 12.9463L13.7366 12.9463C14.5276 12.9463 15.1428 12.3018 15.1428 11.54L15.1428 2.16504C15.1428 1.37402 14.5276 0.758789 13.7366 0.758789L4.36157 0.758788C3.59985 0.758788 2.95532 1.37402 2.95532 2.16504L2.95532 3.57129L1.54907 3.57129C0.787355 3.57129 0.142823 4.18652 0.142823 4.97754L0.142822 14.3525C0.142822 15.1143 0.787354 15.7588 1.54907 15.7588ZM4.53735 2.16504L13.5608 2.16504C13.678 2.16504 13.7366 2.22363 13.7366 2.34082L13.7366 11.3643C13.7366 11.4521 13.678 11.54 13.5608 11.54L12.3303 11.54L12.3303 4.97754C12.3303 4.18652 11.7151 3.57129 10.9241 3.57129L4.36157 3.57129L4.36157 2.34082C4.36157 2.22363 4.44946 2.16504 4.53735 2.16504ZM1.72485 4.97754L10.7483 4.97754C10.8655 4.97754 10.9241 5.03613 10.9241 5.15332L10.9241 14.1768C10.9241 14.2646 10.8655 14.3525 10.7483 14.3525L1.72485 14.3525C1.63696 14.3525 1.54907 14.2646 1.54907 14.1768L1.54907 5.15332C1.54907 5.03613 1.63696 4.97754 1.72485 4.97754Z" fill="white"></path></svg>
    </p>
</span>
</span>
<div style="display: flex;">
<div class="AccountData_token_container__9p1w1">
    <div class="AccountData_tokenImgDiv__uuW3r"><img class="AccountData_token_background__iap7s" src="https://res.cloudinary.com/dnzambf4m/image/upload/c_scale,w_210,q_auto:good/v1631324990/image_24_geei7u.png"><img class="AccountData_token_ice_img__Q6J4J" src="https://res.cloudinary.com/dnzambf4m/image/upload/c_scale,w_210,q_auto:good/v1631324990/ICE_Diamond_ICN_kxkaqj.svg">
</div>
<div class="AccountData_tokenBalance__PaQw4">
    <p class="AccountData_title__x9cIh"> ICE Earned 
        <div class="AccountTooltip_question_mark__Bjq5R"><svg width="8" height="9" viewBox="0 0 11 12" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M5.5026 11.5C8.51864 11.5 11 9.01864 11 6.0026C11 2.98136 8.51864 0.5 5.4974 0.5C2.47617 0.5 0 2.98136 0 6.0026C0 9.01864 2.48136 11.5 5.5026 11.5ZM5.4974 4.33624C5.05097 4.33624 4.67721 3.96248 4.67721 3.51605C4.67721 3.05403 5.05097 2.69066 5.4974 2.69066C5.94384 2.69066 6.31241 3.05403 6.31241 3.51605C6.31241 3.96248 5.94384 4.33624 5.4974 4.33624ZM4.51109 8.9252C4.22039 8.9252 3.99198 8.72275 3.99198 8.41647C3.99198 8.14134 4.22039 7.91812 4.51109 7.91812H5.10807V6.07008H4.61491C4.31902 6.07008 4.0958 5.86244 4.0958 5.56654C4.0958 5.28622 4.31902 5.06819 4.61491 5.06819H5.67909C6.05286 5.06819 6.24493 5.32256 6.24493 5.71708V7.91812H6.71732C7.00802 7.91812 7.23643 8.14134 7.23643 8.41647C7.23643 8.72275 7.00802 8.9252 6.71732 8.9252H4.51109Z" fill="white"></path></svg></div></p><p class="AccountData_amount__BKwci"> 0 </p></div></div><div class="AccountData_token_container__9p1w1"><div class="AccountData_tokenImgDiv__uuW3r"><img class="AccountData_token_xp_background__1g8sJ" src="https://res.cloudinary.com/dnzambf4m/image/upload/c_scale,w_210,q_auto:good/v1631324990/image_24_geei7u.png"><img class="AccountData_token_xp_img__b_IHI" src="https://res.cloudinary.com/dnzambf4m/image/upload/c_scale,w_210,q_auto:good/v1631324990/ICE_XP_ICN_f9w2se.svg"></div><div class="AccountData_tokenBalance__PaQw4"><p class="AccountData_title__x9cIh"> XP Earned <div class="AccountTooltip_question_mark__Bjq5R"><svg width="8" height="9" viewBox="0 0 11 12" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M5.5026 11.5C8.51864 11.5 11 9.01864 11 6.0026C11 2.98136 8.51864 0.5 5.4974 0.5C2.47617 0.5 0 2.98136 0 6.0026C0 9.01864 2.48136 11.5 5.5026 11.5ZM5.4974 4.33624C5.05097 4.33624 4.67721 3.96248 4.67721 3.51605C4.67721 3.05403 5.05097 2.69066 5.4974 2.69066C5.94384 2.69066 6.31241 3.05403 6.31241 3.51605C6.31241 3.96248 5.94384 4.33624 5.4974 4.33624ZM4.51109 8.9252C4.22039 8.9252 3.99198 8.72275 3.99198 8.41647C3.99198 8.14134 4.22039 7.91812 4.51109 7.91812H5.10807V6.07008H4.61491C4.31902 6.07008 4.0958 5.86244 4.0958 5.56654C4.0958 5.28622 4.31902 5.06819 4.61491 5.06819H5.67909C6.05286 5.06819 6.24493 5.32256 6.24493 5.71708V7.91812H6.71732C7.00802 7.91812 7.23643 8.14134 7.23643 8.41647C7.23643 8.72275 7.00802 8.9252 6.71732 8.9252H4.51109Z" fill="white"></path></svg></div></p><p class="AccountData_amount__BKwci"> 0 </p></div></div><div class="AccountData_token_container__9p1w1"><div class="AccountData_tokenImgDiv__uuW3r"><img class="AccountData_token_xdg_img__99GUx" src="https://res.cloudinary.com/dnzambf4m/image/upload/v1637260602/grayLogo_ojx2hi.png" alt="xDG"></div><div class="AccountData_tokenBalance__PaQw4"><p class="AccountData_title__x9cIh"> xDG Held <div class="AccountTooltip_question_mark__Bjq5R"><svg width="8" height="9" viewBox="0 0 11 12" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M5.5026 11.5C8.51864 11.5 11 9.01864 11 6.0026C11 2.98136 8.51864 0.5 5.4974 0.5C2.47617 0.5 0 2.98136 0 6.0026C0 9.01864 2.48136 11.5 5.5026 11.5ZM5.4974 4.33624C5.05097 4.33624 4.67721 3.96248 4.67721 3.51605C4.67721 3.05403 5.05097 2.69066 5.4974 2.69066C5.94384 2.69066 6.31241 3.05403 6.31241 3.51605C6.31241 3.96248 5.94384 4.33624 5.4974 4.33624ZM4.51109 8.9252C4.22039 8.9252 3.99198 8.72275 3.99198 8.41647C3.99198 8.14134 4.22039 7.91812 4.51109 7.91812H5.10807V6.07008H4.61491C4.31902 6.07008 4.0958 5.86244 4.0958 5.56654C4.0958 5.28622 4.31902 5.06819 4.61491 5.06819H5.67909C6.05286 5.06819 6.24493 5.32256 6.24493 5.71708V7.91812H6.71732C7.00802 7.91812 7.23643 8.14134 7.23643 8.41647C7.23643 8.72275 7.00802 8.9252 6.71732 8.9252H4.51109Z" fill="white"></path></svg>
    </div>
</p>
<p class="AccountData_amount__BKwci"> 0 </p>
</div>
</div>
</div>
</div>
</div>
<div class="container">
  <div class="menu">
    <button class="button_active">Games Bidded</button>
    <button>Own Games</button>
    <button>Test</button>
  </div>
  <div class="content">
    <div class="content_inside content_inside_active">
    <table class="display nowrap" id="data-table-bid" cellspacing="0" width="100%"></table>
    </div>
    <div class="content_inside">
    <table class="display nowrap" id="data-table" cellspacing="0" width="100%"></table>
    </div>
    <div class="content_inside">
<span>test</span>
</div>
  </div>
</div>
            <!-- <div class="row grid-margin" id="bidded">
              <div class="col-12">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">@lang('dashboard.bidded')</h4>
                      <table class="display nowrap" id="data-table-bid" cellspacing="0" width="100%"></table>
                  </div>
                </div>
              </div>
            </div>
            <div class="row grid-margin">
              <div class="col-12">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">@lang('dashboard.your_games')</h4>
                    
                        <table class="display nowrap" id="data-table" cellspacing="0" width="100%"></table>
                  </div>
                </div>
              </div>
            </div> -->
            
            <div id="myModal" id="darkModalForm" tabindex="-1" class="modal fade" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg">

                    <!-- Modal content-->
                    <div class="modal-content">
<!--                        <div class="modal-header">
                            <h4 class="modal-title">Details</h4>
                            <button style="color:white" type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>-->
                        <div id="modal-body" class="modal-body">

                        </div>
                    </div>

                </div>
            </div>
            <div id="myModal2" id="darkModalForm" class="modal fade" role="dialog">
                <div class="modal-dialog modal-lg">

                    <!-- Modal content-->
                    <div class="modal-content">
<!--                        <div class="modal-header">
                            <h4 class="modal-title">Details</h4>
                            <button style="color:white" type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>-->
                        <div id="modal-body2" class="modal-body">

                        </div>
                    </div>

                </div>
            </div>

          </div>
          <script>
            dataTableInit('#data-table', [4, 'desc'], 'POST', '{{ url('list/own_games') }}', [
                {
                    title: 'Photo',
                    data: 'photo', render : function(data, type, row){
                      return '<img src="/storage/game-photos/'+data+'" class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}" alt="">'
                }},
                {
                    title: 'Title',
                    data: 'title'
                },
                {
                    title: 'City',
                    data: 'city'
                },
                {
                    title: 'District',
                    data: 'district'
                },
                {
                    title: 'Price',
                    data: 'points'
                },
                // {
                //     title: 'Type',
                //     data: 'type'
                // },
                {
                    title: 'Created At',
                    data: 'created_at'
                }
                ,
                {
                title: 'Status',
                data: 'status', render : function(data, type, row)
                {
                    switch (data)
                    {
                        case 1: return '<span class="btn btn-success">Going</span>';
                            break;
                        case 2: return '<span class="btn btn-danger">Disabled</span>';
                            break;
                        case 3: return '<a href="game/activate/'+row['id']+'" class="btn btn-warning" onclick=" name="activate" value="1">Activate</a>';
                        break;
                        
//                        case '3': return '<form enctype="multipart/form-data" action="{{ route('games.activate') }}" method="post">' +
//                          '<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />'+
//                          '<input hidden type="numbers" name="user_id" class="form-control"/ value="{{ Auth::user()->id }}">'+
//                                        ' <button class="btn btn-warning" name="activate" value="1">Activate</button>' +
//                                    '</form>';

                    }
                }
            }
//                {
//                    title: 'Actions',
//                    defaultContent: '<div class="data-table-buttons-wrapper">' +
//                                        '<button type="button" class="btn btn-info details-button" title="Details">View</button> ' +
//                                    '</div>'
//                }
            ]);
//            detailsButton('{{ url('games/{id}') }}');
        </script>
        <script>
              dataTableInit('#data-table-bid', [4, 'desc'], 'POST', '{{ url('list/bid_games') }}', [
                {
                    title: 'Photo',
                    data: 'photo', render : function(data, type, row){
                      return '<img src="/storage/game-photos/'+data+'" class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}" alt="">'
                }},
                {
                    title: 'Title',
                    data: 'title'
                },
                {
                    title: 'City',
                    data: 'city'
                },
                {
                    title: 'District',
                    data: 'district'
                },
                {
                    title: 'Price',
                    data: 'points'
                },
                // {
                //     title: 'Type',
                //     data: 'type'
                // },
                {
                    title: 'Created At',
                    data: 'created_at'
                },
                {
                title: 'Status',
                data: 'status', render : function(data, type, row)
                {
                    switch (data)
                    {
                        case 1: return '<span class="btn btn-success">Going</span>';
                            break;
                        case 2: return '<span class="btn btn-danger">Disabled</span>';
                            break;
                    }
                }
            },
            @if (session('can_play'))
                {
                    title: 'Actions',
                    data: 'status', render : function(data, type, row)
                    {
                        return '<div class="data-table-buttons-wrapper"><button type="button" class="btn btn-info details-button" title="Details" data-id="'+row['id']+'" data-toggle="modal" data-target="#myModal">Play</button></div>';
                    }
                }
            @endif
//                {
//                    title: 'Actions',
//                    defaultContent: '<div class="data-table-buttons-wrapper">' +
//                                        '<button type="button" class="btn btn-info details-button" title="Details">View</button> ' +
//                                    '</div>'
//                }
            ]);
//            detailsButton('{{ url('games/{id}') }}');
$(document).ready(function(){
    $('#myModal').on('show.bs.modal', function (e) {
        var rowid = $(e.relatedTarget).attr('data-id');
        $.ajax({
            type : 'post',
            url : 'getGameModalHtml', //Here you will fetch records
            data :  {"_token": "{{ csrf_token() }}", 'id': rowid}, //Pass $id
            success : function(data){
            $('#modal-body').html(data);//Show fetched data from database
            }
        });
     });

     $('#myModal2').on('show.bs.modal', function (e) {
         //$('#myModal').modal('hide');
        var rowid = $(e.relatedTarget).attr('data-id');
        $.ajax({
            type : 'post',
            url : 'getGameEditModalHtml', //Here you will fetch records
            data :  {"_token": "{{ csrf_token() }}", 'id': rowid}, //Pass $id
            success : function(data){
            $('#modal-body2').html(data);//Show fetched data from database
            }
        });
     });
});
        </script>
<script>
let button = document.querySelectorAll('.menu button');
let content_inside = document.querySelectorAll('.content_inside');

Array.from(button).forEach(function(buttonArray, i) {
buttonArray.addEventListener('click', function() {

    Array.from(button).forEach(buttonAll => buttonAll.classList.remove('button_active'));
    
    Array.from(content_inside).forEach(content_insideAll => content_insideAll.classList.remove('content_inside_active'));
    
    button[i].classList.add('button_active'); 
    
    content_inside[i].classList.add('content_inside_active');  
  });
});
</script>
<style>
    .menu {
  display: flex;
}

.menu button {
  margin: 10px;
  cursor: pointer;
}

.button_active {
  color: teal;
}

.content_inside {
  display: none;
  border: 1px solid #000000;
  border-radius: 10px;
  padding: 10px;
}

.content_inside_active {
  display: block;
}
</style>

<style>
 .AccountData_player_card__8sRvn{
    position:relative;
    z-index:0;
    margin:210px auto auto;
    padding:28px;
    width:600px;
    border:1px solid #2a2a2a;
    border-radius:28px;
    display:flex;
    align-items:center
}
.AccountData_player_card__8sRvn .AccountData_avatar_image___srYL{
    align-self:center
}
.AccountData_player_card__8sRvn .AccountData_spinner__w4QTn{
    display:flex;
    justify-content:center;
    align-items:center;
    width:160px;
    height:160px
}
.AccountData_player_card__8sRvn .AccountData_premium_badge__J7WhH{
    background:#006eff;
    color:#fff;
    display:flex;
    font-size:12px;
    border-radius:7px!important;
    width:-webkit-fit-content;
    width:-moz-fit-content;
    width:fit-content;
    box-shadow:0 4px 16px rgba(0,0,0,.25),inset 0 -5px 10px rgba(22,13,1,.1);
    position:absolute;
    top:28px;
    right:28px
}
.AccountData_player_card__8sRvn .AccountData_premium_badge__J7WhH>div{
    margin-left:4px
}
.AccountData_player_card__8sRvn .AccountData_premium_badge__J7WhH:hover{
    background:#006eff;
    color:#fff
}
.AccountData_player_card__8sRvn .AccountData_age_multiplier_container__Cybff{
    position:absolute;
    top:25px;
    right:20px
}
.AccountData_player_card__8sRvn .AccountData_age_multiplier_container__Cybff .AccountData_header__AS20q{
    padding-left:8px
}
.AccountData_player_card__8sRvn .AccountData_age_multiplier_container__Cybff .AccountData_header__AS20q p{
    font-family:Larsseit-Regular;
    font-style:normal;
    font-weight:400;
    font-size:10px;
    line-height:12px;
    text-align:left;
    color:rgba(255,255,255,.5)!important
}
.AccountData_player_card__8sRvn .AccountData_age_multiplier_container__Cybff .AccountData_content__lwBhQ{
    width:110px;
    height:20px;
    margin:5px 5px 0;
    background:#3b3b3b;
    box-shadow:0 22.8571px 45.7143px rgba(0,0,0,.24);
    border-radius:1000px
}
.AccountData_player_card__8sRvn .AccountData_age_multiplier_container__Cybff .AccountData_content__lwBhQ .AccountData_box__1_o5Z{
    display:flex;
    justify-content:center;
    align-items:center;
    width:30px;
    height:20px;
    background:linear-gradient(180.53deg,#2e2e2e .46%,#1b1b1b 99.54%);
    box-shadow:0 4px 4px rgba(0,0,0,.25);
    border-radius:1000px;
    font-family:Larsseit-Regular;
    font-style:normal;
    font-weight:700;
    font-size:9px;
    line-height:12px;
    text-align:right;
    color:#fff!important;
    margin-left:0
}
.AccountData_player_card__8sRvn .AccountData_age_multiplier_container__Cybff .AccountData_bottom__1YicL{
    padding-left:12px;
    margin-top:5px;
    font-family:Larsseit-Regular;
    font-style:normal;
    font-weight:400;
    font-size:7px;
    line-height:8px;
    word-spacing:5.5px;
    text-align:left;
    color:rgba(255,255,255,.5)!important
}
.AccountData_player_card__8sRvn .AccountData_token_container__9p1w1{
    flex:1 1;
    text-align:center
}
.AccountData_player_card__8sRvn .AccountData_token_container__9p1w1 .AccountData_tokenImgDiv__uuW3r{
    position:relative;
    margin-left:-25px;
    top:10px
}
.AccountData_player_card__8sRvn .AccountData_token_container__9p1w1 .AccountData_tokenImgDiv__uuW3r .AccountData_token_background__iap7s{
    width:35px
}
.AccountData_player_card__8sRvn .AccountData_token_container__9p1w1 .AccountData_tokenImgDiv__uuW3r .AccountData_token_ice_img__Q6J4J{
    margin-left:-29px;
    width:26px;
    position:relative;
    top:-6px
}
.AccountData_player_card__8sRvn .AccountData_token_container__9p1w1 .AccountData_tokenImgDiv__uuW3r .AccountData_token_xp_background__1g8sJ{
    width:35px;
    margin-left:25px
}
.AccountData_player_card__8sRvn .AccountData_token_container__9p1w1 .AccountData_tokenImgDiv__uuW3r .AccountData_token_xp_img__b_IHI{
    width:21px;
    position:relative;
    left:-27px;
    top:-11px
}
.AccountData_player_card__8sRvn .AccountData_token_container__9p1w1 .AccountData_tokenImgDiv__uuW3r .AccountData_token_chips_background__p0EGZ{
    width:35px;
    margin-left:26px
}
.AccountData_player_card__8sRvn .AccountData_token_container__9p1w1 .AccountData_tokenImgDiv__uuW3r .AccountData_token_xdg_img__99GUx{
    width:35px;
    height:35px;
    position:relative;
    left:0;
    top:-2px
}
.AccountData_player_card__8sRvn .AccountData_token_container__9p1w1 .AccountData_token_img__GbMDg{
    width:72px;
    margin-left:-22px;
    margin-bottom:-22px!important
}
.AccountData_player_card__8sRvn .AccountData_token_container__9p1w1 .AccountData_tokenBalance__PaQw4{
    border:1px solid #2a2a2a;
    border-radius:14px;
    width:88px;
    height:54px;
    text-align:center;
    display:flex;
    flex-direction:column;
    justify-content:center
}
.AccountData_player_card__8sRvn .AccountData_token_container__9p1w1 .AccountData_tokenBalance__PaQw4 .AccountData_title__x9cIh{
    display:flex;
    justify-content:center;
    grid-gap:4px;
    gap:4px;
    font-size:10px;
    color:"white";
    opacity:.5;
    margin-bottom:0
}
.AccountData_player_card__8sRvn .AccountData_token_container__9p1w1 .AccountData_tokenBalance__PaQw4 .AccountData_title__x9cIh img{
    width:9px;
    position:relative;
    margin-left:1px
}
.AccountData_player_card__8sRvn .AccountData_token_container__9p1w1 .AccountData_tokenBalance__PaQw4 .AccountData_amount__BKwci{
    font-weight:bold;
    font-size:18px;
    color:"white"
}
@media(max-width:47.99em){
    .AccountData_player_card__8sRvn{
        max-width:500px;
        width:100%
    }
    .AccountData_player_card__8sRvn .AccountData_token_container__9p1w1{
        display:flex;
        justify-content:center;
        align-items:center;
        flex-direction:column
    }
    .AccountData_player_card__8sRvn .AccountData_token_container__9p1w1 .AccountData_tokenImgDiv__uuW3r{
        margin-left:0
    }
    .AccountData_player_card__8sRvn .AccountData_token_container__9p1w1 .AccountData_tokenImgDiv__uuW3r .AccountData_token_ice_img__Q6J4J{
        margin-left:-28px;
        top:-5px
    }
    .AccountData_player_card__8sRvn .AccountData_player_avatar__YjLms{
        margin-left:0
    }
    .AccountData_player_card__8sRvn .AccountData_player_avatar__YjLms img{
        width:150px!important
    }
    .AccountData_player_card__8sRvn .AccountData_player_name__55xMi{
        margin-left:0!important
    }
    .AccountData_player_card__8sRvn .AccountData_player_name__55xMi span{
        display:flex;
        justify-content:center;
        align-items:center;
        margin-top:15px
    }
    .AccountData_player_card__8sRvn .AccountData_player_name__55xMi span p{
        margin-left:10px
    }
    .AccountData_player_card__8sRvn .AccountData_account_hover__YZS4d{
        font-size:18px!important;
        margin-left:6px!important;
        margin-right:12px!important
    }
}
@media(max-width:35.99em){
    .AccountData_player_card__8sRvn .AccountData_account_hover__YZS4d{
        font-size:14px!important;
        margin-left:5px!important;
        margin-right:5px!important
    }
}
     </style>
@endsection
