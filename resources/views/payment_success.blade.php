@extends("layout.master")

@section('title',"Payment Success")

@section('content')
    <div class="container">
        <h1>Payment Success</h1>
        <a href="/">Go Back Home</a>
    </div>
@endsection

@section('script')
<script>
    localStorage.removeItem('products');
    localStorage.removeItem('items');
</script>
@endsection