 <div class="card m-md-5">
     <div class="card-body">
         @include('shared._errors')
         <form id="formProductStore" method="POST" action="{{ route('products.store') }}">
             @include('admin.product._fields')
             <div class="form-group mt-4">
                 <button type="button" onclick="store('Product')" class="btn btn-primary">Crear Producto</button>
             </div>
         </form>
     </div>
 </div>
