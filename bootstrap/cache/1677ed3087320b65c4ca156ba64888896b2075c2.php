<?php $__env->startSection("title"."Cafe"); ?>

<?php $__env->startSection('content'); ?>

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
    </table>
    <!-- Table end -->
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script>
    function loadProduct() {
        $.ajax({
            type: "POST",
            url: "/cart",
            data: {
                "cart": getCartItem()
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
            <tr>
                <td colspan="6" style="text-align: right;">
                <button class="btn btn-sm" style="border:none;  background-color:#BCB88A;">Check Out</button>
                </td>
                <td>2000</td>
            </tr>
            `;
        $('#tablebody').html(str);
    }

    function payout() {

    }
    loadProduct();
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("layout.master", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>