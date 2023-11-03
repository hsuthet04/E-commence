<nav class="navbar navbar-expand-lg navbar-light" style="background-color:#BCB88A;">
    <img src="<?php echo e(asset("images/logo.jpg")); ?>" alt="" width="35px" height="35px" class="rounded-circle">
    <a class="navbar-brand" href="#" style="padding-left: 10px; color:#513B1C;">
        <span>Dear Cottage^^</span>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="/" style="color:#513B1C;">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/admin" style="color:#513B1C;">Admin Panel</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" style="color:#513B1C; cursor:pointer;" onclick="goToCartPage()" href="/cart">
                    Cart
                    <span class="badge badge-danger badge-pill" style="position:relative; top:-10px;left:-5px;" id="cart-count">0</span>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" style="color:#513B1C;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Dropdown link
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </li>
        </ul>
    </div>
</nav>
<?php $__env->startSection('script'); ?>