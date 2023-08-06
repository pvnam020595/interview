@include('test')
<form action="{{ url('/add-product') }}" class="row g-3" method="POST" name="add" id="add">
 @csrf
 <div class="col-md-4">
  <label for="profu_name" class="form-label">Product Name</label>
  <input type="text" class="form-control" id="product_name" value="" name="product_name">
</div>
<div class="col-md-4">
  <label for="price" class="form-label">Price</label>
  <input type="number" class="form-control" id="price" value="" name="price">
</div>
 <div class="col-md-2">
  <label for="" class="form-label">Category</label>
     <select class="form-select" aria-label="Default select example" name="category" class="category" id="category">
         <option value="">-- Chose Category --</option>
         @php
             echo $category;
         @endphp
     </select>
 </div>
 <div class="col-md-2" style="align-items: end;justify-content: space-between;display: flex;">
    <button type="submit" class="btn btn-primary bg-primary">Add</button>
 </div>
</form>
<script>

  document.getElementById('add').addEventListener('submit', function(evt){
    let category = document.getElementById('category').value;
    let product_name = document.getElementById('product_name').value;
    let price = document.getElementById('price').value;
    if(category == '') {
      alert("Please choose Category");
      evt.preventDefault();
    }
    if(product_name == '') {
      alert("Please input Product Name");
      evt.preventDefault();
    }
    if(price == '') {
      alert("Please input Price");
      evt.preventDefault();
    }
    if(price < 0) {
      alert("Please input Price more than 0");
      evt.preventDefault();
    }
  })
  </script>