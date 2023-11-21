@extends("layout.master")

@section("title"."Cafe")

@section('content')
<input type="hidden" id="token" value="{{\App\Classes\CSRFToken::_token()}}">
<div class="container my-5">
    <!-- Table start -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Image</th>
                <th>Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Action</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody id="tablebody">
        </tbody>
        @if(\App\Classes\Auth::check())
        <tr>
            <td colspan="7" style="text-align: right;" id="checkOutBtn">
                <button class="btn btn-sm" style="border:none;  background-color:#BCB88A; color:black;" onclick="payout()">Check Out</button>
            </td>
        </tr>
        <tr style="visibility:hidden;" id="stripeTR">
            <td colspan="6" class="text-right">
                <span id="paypal-button"></span>
            </td>
            <td class="text-right">
                <form action="/payment/stripe" method="post" style="display:none;" id="stripeForm">
                    <script src="https://checkout.stripe.com/checkout.js" class="stripe-button" data-key="{{\App\Classes\Session::get("publishable_key")}}" data-name="Dear Shop" data-description="Not like other,We could gin!" data-amount="100000" data-image="https://file.stripe.com/files/f_test_GyahDgTmUINBddh4frdbt7CY" data-email="{{\App\Classes\Auth::user()->email}}" data-zip-code="true" data-locale="auto">
                    </script>
                </form>
            </td>
        </tr>
        @else
        <tr>
            <td colspan="7" style="text-align: right;">
                <a class="btn btn-sm" style="border:none;  background-color:#BCB88A; color:black;" onclick="payout()" href="/user/login">Login to Checkout</a>
            </td>

        </tr>
        @endif
    </table>
    <!-- Table end -->

</div>
@endsection

@section('script')
<script src="https:://www.paypalobjects.com/api/checkout.js"></script>
<script>
    paypal.Button.render({
        env: 'sandbox',
        client: {
            sandbox: 'AX3TX8vyYA9d0mM8OLDVyDWzZ6f-TLAe__ANo2sP95DGMGiX4_UjZY3nqXkT4kR7diZ4Mx-Gvthn8VpG',
            production: 'demo_production_client_id'
        },
        locale: 'en_US',
        style: {
            size: 'small',
            color: 'gold',
            shape: 'pill',
        },
        payment: function(data, actions) {
            return actions.payment.create({
                tranctions: ({
                    amount: {
                        total: '10.0',
                        currency: 'USD'
                    }
                })
            });
        },
        onAuthorize: function(data, actions) {
            return actions.payment.execute().then(function() {
                window.alert("Thank You For Your Purchase!");
                window.location.href="https://e_commence/paypal/success"+
                data.paymentID+"/"+data.payerID+"/"+data.paymentToken;
            });
        }
    }, '#paypal-button');
</script>
<script>
    function loadProduct() {
        $.ajax({
            type: "POST",
            url: "/cart",
            data: {
                "cart": getCartItem(),
                "token": $("#token").val()
            },
            success: function(results) {
                saveProducts(results);
            },
            errors: function(response) {
                console.log(response.responseText);
            }

        })
    }

    function saveProducts(res) {
        localStorage.setItem("products", res);
        results = JSON.parse(localStorage.getItem("products"));
        showProducts(results);
    }

    function addProductQty(id) {
        var results = JSON.parse(localStorage.getItem("products"));
        results.forEach((result) => {
            if (result.id === id) {
                result.qty = result.qty + 1;
            }
        });
        saveProducts(JSON.stringify(results));
    }

    function deduceProductQty(id) {
        var results = JSON.parse(localStorage.getItem("products"));
        results.forEach((result) => {
            if (result.qty > 1) {
                result.qty = result.qty - 1;
            }
        });
        saveProducts(JSON.stringify(results));
    }

    function showProducts(results) {
        var str = "";
        var total = 0;
        results.forEach((result) => {
            total += result.qty * result.price;
            str += "<tr>";
            str += `
                <td>${result.id}</td>
                <td><img src='${result.image}' alt='' style="max-width:150px; max-height:200px;"></td>
                <td>${result.name}</td>
                <td>${result.price}</td>
                <td>${result.qty}</td>
                <td>
                    <i class="fa fa-plus" style="cursor:pointer;" onclick="addProductQty(${result.id})"></i>
                    <i class="fa fa-minus" style="cursor:pointer;" onclick="deduceProductQty(${result.id})"></i>
                    <i class="fa fa-trash" style="cursor:pointer;" onclick="deleteProduct(${result.id})"></i>
                </td>
                <td>${(result.qty*result.price).toFixed(2)}</td>
                
            `;
            str += "</tr>";
        });
        str += `
            <tr>
                <td colspan="6" style="text-align: right;">Grand Total</td>
                <td>${total.toFixed(2)}</td>
            </tr>
            
            `;
        $('#tablebody').html(str);
    }

    function deleteProduct(id) {
        //clearCart();
        var results = JSON.parse(localStorage.getItem("products"));
        results.forEach((result) => {
            if (result.id === id) {
                var ind = results.indexOf(result);
                results.splice(ind, 1);
            }
        });
        deleteItem(id);
        saveProducts(JSON.stringify(results));
    }

    function payout() {
        var results = JSON.parse(localStorage.getItem("products"));
        $.ajax({
            type: "POST",
            url: "/payout",
            data: {
                "items": results,
                "token": $("#token").val()
            },
            success: function(results) {
                console.log(results);
                $('#checkOutBtn').css("display", "none");
                $('#stripeTR').css("visibility", "visible");
                $('#stripeForm').css("display", "block");
                // clearCart();
                // showCartItem();
                // showProducts([]);

            },
            errors: function(response) {
                console.log(response.responseText);
            }

        });
    }
    loadProduct();
</script>
@endsection