@include('test')
@if (count($products) > 0)

    <form action="{{ url('/search') }}" class="row g-3" method="POST" name="search" id="search">
        @csrf
        <div class="col-auto">
            <select class="form-select" aria-label="Default select example" name="category" class="category" id="category">
                <option value="">-- Chose Category --</option>
                @php
                    echo $category;
                @endphp
            </select>
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary bg-primary" onsubmit="return validateData()">Search</button>
        </div>
    </form>
    <a href="{{ url('/product') }}" class="btn btn-primary" role="button">Add Product</a>
    <a href="{{ url('/category') }}" class="btn btn-primary" role="button">Add Category</a>
    @php
        $i = 0;
    @endphp
    <table class="table table-sm">
        <thead>
            <tr>
                <th></th>
                <th>Product Name</th>
                <th>Product Price</th>
                <th>Category</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                @php
                    $i++;
                    // dd($product);
                @endphp
                <tr>
                    <td>{{ $i }}</td>
                    <td>{{ $product->product_name }}</td>
                    <td>{{ number_format($product->price) }}</td>
                    <td>{{ $product->category_name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $products->links() }}
@endif

<script>

document.getElementById('search').addEventListener('submit', function(evt){
  let category = document.getElementById('category').value;
  if(category == '') {
    alert("Please choose data for search");
    evt.preventDefault();
  }
})
</script>
