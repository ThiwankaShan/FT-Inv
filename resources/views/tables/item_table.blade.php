<!-- here is the filter form -->
<?php
use App\SubCategory;
?>
<div class="container-fluid" id="dataTable">
  <table class="table table-striped table-bordered table-hover">
    <thead class="thead text-white" style="background-color:#691330">
      <tr class="text-center">
        <th scope="col">Asset Code</th>
        <th scope="col">Name</th>
        <th scope="col">GRN No</th>
        <th scope="col">Purchased date</th>
        <th scope="col">Supplier</th>
        <th scope="col">Serial No</th>
        <th scope="col">Model No</th>
        <th scope="col">Brand Name</th>
        <th scope="col">Rate</th>
        <th scope="col">Tax</th>
        <th scope="col">Total</th>

        @if(auth()->user()->role == 'admin' || auth()->user()->role == 'manager')
        <th scope="col" class="text-center">Action</th>
        @endif
      </tr>
    </thead>
    <tbody id="dataBody">
      @foreach($items as $item)

      <tr id="{{ str_replace('/', '', $item->item_code) }}">
        <th scope="row">{{$item->item_code}}</th>
        @if($item->subCategory->subCategory_name == 'Default')
        <td>{{$item->category->category_name}}</td>
        
        @else
        <td><?php echo(SubCategory::select('subCategory_name')->where('category_code',"=", $item->category_code)->where('subCategory_code',"=" ,$item->subCategory_code )->get()[0]["subCategory_name"])?></td>
        @endif
        <td>{{$item->GRN_number}}</td>
        <td>{{$item->purchased_date}}</td>
        <td>{{$item->GRN->supplier->supplier_name ?? 'Deleted'}}</td>
        <td>{{$item->serial_number}}</td>
        <td>{{$item->model_number}}</td>
        <td>{{$item->brandName}}</td>
        <td class="text-right">{{number_format($item->gross_price,2)}}</td>
        <td class="text-right">{{number_format($item->tax,2)}}</td>
        <td class="text-right">{{number_format($item->net_price,2)}}</td>

        <td class="d-flex flex-row justify-content-end">
          @if(auth()->user()->role == 'admin')
         
          <a id="actionButton" class="btn btn-primary mr-1 text-light highlight_row item_edit_button" href="/item/edit/{{$item->item_code}}">Edit</a>
          <a id="actionButton"  href="/item/delete/{{$item->item_code}}" data-method="POST" class="btn btn-danger delete-item text-light"
            token='{!! csrf_token() !!}'>Delete</a>

          @elseif(auth()->user()->role == 'manager')
          <a id="actionButton"  class="btn btn-primary mr-1 text-light" href="/item/edit/{{$item->item_code}}">Edit</a>
          @endif
        </td>


      </tr>
      @endforeach

    </tbody>
  </table>


</div>

<div >
<script src="{{ asset('js/validation.js') }}"> </script>