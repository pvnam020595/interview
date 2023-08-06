@include('test')
<form action="{{ url('/add-category') }}" class="row g-3" method="POST" name="add" id="add">
 @csrf
 <div class="col-md-4">
  <label for="profu_name" class="form-label">Category Name</label>
  <input type="text" class="form-control" id="category_name" value="" name="category_name">
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
    let category_name = document.getElementById('category_name').value;
    if(category_name == '') {
      alert("Please input Category Name");
      evt.preventDefault();
    }
  })
  </script>