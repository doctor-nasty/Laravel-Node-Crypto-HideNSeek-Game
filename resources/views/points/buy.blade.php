@extends('layouts.mainlayout')

@section('content')

<div class="content-wrapper">
    <nav aria-label="breadcrumb" role="navigation">
        <ol class="breadcrumb breadcrumb-custom">
            <li class="breadcrumb-item"><a href="{{ url('') }}">@lang('buypoints.dashboard')</a></li>
            <li class="breadcrumb-item"><a href="{{ url('points') }}">@lang('buypoints.points')</a></li>
            <li class="breadcrumb-item active" aria-current="page"><span>@lang('buypoints.buy_points')</span></li>
        </ol>
    </nav>
    @if(session()->get('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
    @endif
    <div class="card">

        <div class="card-body">

            <div class="row">
                <div class="table-sorter-wrapper col-lg-12 table-responsive">
                    <table class="table">
                        <tbody>
                            <tr>
                        <script src="https://js.stripe.com/v3/"></script>
                        <form action="{{ route('buy.points.coinbase') }}" method="post" id="payment-form">
                            @csrf
                            <div class="form-group">
                                <div class="card-header">
                                    <label for="card-element">
                                        @lang('buypoints.select_points')
                                    </label>
                                </div>
                                <div class="card-body">
                                    <select id="points" name="points" class="form-control">
                                        <!--<option value="0">Select Points</option>-->
                                        <!-- <option value="10">10</option>
                                        <option value="20">20</option>
                                        <option value="50">50</option> -->
                                        <option value="100">100</option>
                                        <!-- <option value="150">150</option> -->
                                        <option value="200">200</option>
                                        <!-- <option value="200">250</option> -->
                                        <option value="300">300</option>
                                    </select>
                                </div>
                                <div>
                                @lang('buypoints.ingel')  : <span id='amount_gel'>10</span><br>
                                @lang('buypoints.ineur') : <span id='amount_euro'>2</span>
                            </div>
                            </div>
<!--                            <div style="visibility: hidden;" class="form-group">
                                <div class="card-header">
                                    <label for="card-element">
                                        @lang('buypoints.enter_card_info')
                                    </label>
                                </div>
                                <div class="card-body">
                                    <div id="card-element">
                                         A Stripe Element will be inserted here.
                                    </div>
                                     Used to display form errors.
                                    <div id="card-errors" role="alert"></div>
                                </div>
                            </div>-->

                            <br>
                            <div class="card-footer">
                                <button id="btn_submit" class="btn btn-dark" type="submit" style="float: left;">@lang('buypoints.crypto')</button>
                                <div id="paypal-button" style="width: fit-content; float: left; margin-left: 10px;"></div>
                            </div>
                        </form>

                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>


        <div style="" class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="container text-center">
                            <div class="row pricing-table">
                                <!--<iframe id="coinbase_iframe" src="" style="display: none;" height="500" width="400"></iframe>-->
                                <div>
                                    <a style="display: none;" class="buy-with-crypto btn btn-dark" id="buy-with-crypto"
                                       href="">
                                        <span>@lang('buypoints.crypto')</span>
                                    </a>
                                    <script src="https://commerce.coinbase.com/v1/checkout.js?version=201807">
                                    </script>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>
    @endsection
    @section('stripe-scripts')
<!--<script
    src="https://www.paypal.com/sdk/js?client-id=AXPtHcLYOLb7qOPlncLfihlDb-TtZZEkTmtUBLHJh9Zs2PKI92QJ_Nkt-vo2oLClS-SCzvC3N8NzEMB-"> // Required. Replace SB_CLIENT_ID with your sandbox client ID.
</script>-->

<!-- sandbox -->
<!-- <script src="https://www.paypal.com/sdk/js?client-id=AXPtHcLYOLb7qOPlncLfihlDb-TtZZEkTmtUBLHJh9Zs2PKI92QJ_Nkt-vo2oLClS-SCzvC3N8NzEMB-&currency=EUR"></script> -->

<!-- live -->
<script src="https://www.paypal.com/sdk/js?client-id=Adwnj9dq31iOAZaZLC3QkrT4aubYCMVhyEZhztYwlMp2rh_L2X09-XeqpZQJ-CMixppwn-gnsXmKGKi6&currency=EUR"></script>

<script>
    amount = 2;
    // Render the PayPal button into #paypal-button-container
    paypal.Buttons({

        // Set up the transaction
        createOrder: function(data, actions) {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: amount
                    }
                }]
            });
        },

        // Finalize the transaction
        onApprove: function(data, actions) {
            return actions.order.capture().then(function(details) {
                console.log(details);
                $.ajax({
                    type:'POST',
                    url:'/buypointspaypal',
                    data:{
                    '_token': '{{ csrf_token() }}',
                    'data': details,
                    'points': $('#points').val(),
                    },
                    success:function(response) {
                        if(response.status) {
                            alert('Your points creadited to your account successfully');
                        } else {
                            alert('something went wrong. Please try again latter.');
                        }
                        location.reload();
                    }
                });
                // Show a success message to the buyer
                // alert('Transaction completed by ' + details.payer.name.given_name + '!');
            });
        },

        //Changes credit/debit button behavior to "old" version
        onShippingChange: function(data,actions){
            //if not needed do nothing..
            return actions.resolve();
        }


    }).render('#paypal-button');
</script>


<!-- <script src="https://www.paypalobjects.com/api/checkout.js"></script> -->
<script>
//     amount = 0;
//     paypal.Button.render({
//       env: 'sandbox', // Or 'production'
//       client: {
//           sandbox: 'AXPtHcLYOLb7qOPlncLfihlDb-TtZZEkTmtUBLHJh9Zs2PKI92QJ_Nkt-vo2oLClS-SCzvC3N8NzEMB-',
//           production: ''
//       },
//       funding: {
//         allowed: [ paypal.FUNDING.CARD ],
//         disallowed: [ paypal.FUNDING.CREDIT ]
//         },
//       style: {
//         layout: 'vertical',
//         size: 'medium',
//         color: 'black',
//         shape: 'rect',
// //        label: 'paypal',
//         tagline: false
//       },
//       payment: function(data, actions) {
//         return actions.payment.create({
//             transactions: [{
//                 amount: {
//                     total: amount/10,
//                     currency: 'EUR'
//                 }
//             }]
//         })
//       },
//       onAuthorize: function(data, actions) {
//         return actions.order.capture().then(function(details) {
//             $.ajax({
//                 type:'POST',
//                 url:'/buypointspaypal',
//                 data:{
//                    '_token': '{{ csrf_token() }}',
//                    'data': data,
//                    'points': amount,
//                 },
//                 success:function(response) {
//                     if(response.status) {
//                         alert('Your points creadited to your account successfully');
//                     } else {
//                         alert('something went wrong. Please try again latter.');
//                     }
//                     location.reload();
//                 }
//             });
//         });
//       }
//     }, '#paypal-button');

//    paypal.Buttons({
////        style: {
////            layout: 'horizontal',
////            size: 'small',
////            color: 'black',
////            shape: 'rect',
////            label: 'paypal',
////            tagline: false
////        },
//        createOrder: function(data, actions) {
//            // This function sets up the details of the transaction, including the amount and line item details.
//            return actions.order.create({
//                purchase_units: [{
//                    amount: {
//                        value: amount/10
//                    }
//                }]
//            });
//        },
//      onApprove: function(data, actions) {
//        return actions.order.capture().then(function(details) {
//            $.ajax({
//                type:'POST',
//                url:'/buypointspaypal',
//                data:{
//                   '_token': '{{ csrf_token() }}',
//                   'data': details,
//                   'points': amount,
//                },
//                success:function(response) {
//                    if(response.status) {
//                        alert('Your points creadited to your account successfully');
//                    } else {
//                        alert('something went wrong. Please try again latter.');
//                    }
//                    location.reload();
//                }
//            });
//        });
//      }
//    }).render('#paypal-button');



    $(document).ready(function() {
        // amount = $('#points').val();
        // amount = Math.floor(amount/3.78);
        // amount = $(this).val()/10;
        //     $('#amount_gel').text(amount);
        //     $('#amount_euro').text(Math.floor(amount/3.78));
        //     alert(amount + '--' + (amount/3.78));
        $('#points').change(function() {
            amount = $(this).val()/10;
            $('#amount_gel').text(amount);
            $('#amount_euro').text(Math.floor(amount/3.78));
            amount = Math.floor(amount/3.78);
            // alert(amount + '--' + (amount/3.78));
        });
    });
</script>
<script>

    $('#points').change(function() {
//        $.ajax({
//            type : 'post',
//            url : 'buy-points',
//            data :  {"_token": "{{ csrf_token() }}", 'points': $(this).val()}, //Pass $id
//            success : function(data){
//                console.log(data);
////                $('#coinbase_iframe').attr('src', data);
////                $('#coinbase_iframe').css('display', 'block');
//                $('#buy-with-crypto').css('display', 'block');
//                $('#buy-with-crypto').attr('href', data);
//                //$('#buy-with-crypto')[0].click();
//            }
//        });
        //$('#btn_submit').text('{{ Lang::trans('buypoints.pay') }} ' + ($(this).val()/2) + '.00 {{ Lang::trans('buypoints.gel') }}');
    });
    $('#btn_submit').click(function() {
//        $.ajax({
//            type : 'post',
//            url : 'buy-points',
//            data :  {"_token": "{{ csrf_token() }}", 'points': $('#points').val()}, //Pass $id
//            success : function(data){
//                console.log(data);
////                $('#coinbase_iframe').attr('src', data);
////                $('#coinbase_iframe').css('display', 'block');
////                $('#buy-with-crypto').attr('href', data);
////                $('#buy-with-crypto')[0].click();
//            }
//        });
    });

var stripe = Stripe('pk_test_I3FUDwI8Selr4nBN9zYoLtgb00I2bygnuR');
var elements = stripe.elements();

var style = {
  base: {
    color: '#32325d',
    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
    fontSmoothing: 'antialiased',
    fontSize: '16px',
    '::placeholder': {
      color: '#aab7c4'
    }
  },
  invalid: {
    color: '#fa755a',
    iconColor: '#fa755a'
  }
};

var card = elements.create('card', {style: style});

//card.mount('#card-element');

//card.addEventListener('change', function(event) {
//  var displayError = document.getElementById('card-errors');
//  if (event.error) {
//    displayError.textContent = event.error.message;
//  } else {
//    displayError.textContent = '';
//  }
//});

//var form = document.getElementById('payment-form');
//form.addEventListener('submit', function(event) {
//  event.preventDefault();
//
//  stripe.createToken(card).then(function(result) {
//    if (result.error) {
//      // Inform the user if there was an error.
//      var errorElement = document.getElementById('card-errors');
//      errorElement.textContent = result.error.message;
//    } else {
//      // Send the token to your server.
//      stripeTokenHandler(result.token);
//    }
//  });
//});

// Submit the form with the token ID.
function stripeTokenHandler(token) {
  // Insert the token ID into the form so it gets submitted to the server
  var form = document.getElementById('payment-form');
  var hiddenInput = document.createElement('input');
  hiddenInput.setAttribute('type', 'hidden');
  hiddenInput.setAttribute('name', 'stripeToken');
  hiddenInput.setAttribute('value', token.id);
  form.appendChild(hiddenInput);

  // Submit the form
  form.submit();
}

</script>
@endsection

