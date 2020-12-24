<form action="/reports/preview" id="reportForm" method="POST">
@csrf
<div class="custom-control custom-radio custom-control-inline">
  <input type="radio" id="disposed" name="option" class="custom-control-input">
  <label class="custom-control-label" for="disposed">Disposed</label>
</div>

<div class="custom-control custom-radio custom-control-inline">
  <input type="radio" id="transfered" name="option" class="custom-control-input">
  <label class="custom-control-label" for="transfered">Transfered</label>
</div>

<div class="custom-control custom-radio custom-control-inline">
  <input type="radio" id="available" name="option" class="custom-control-input">
  <label class="custom-control-label" for="available">Available</label>
</div>

<hr>
  <h5>Period</h5>
<div class="form-row">
  
    <div class="form-group col-md-4">
      <label for="inputState">Start</label>
      <input type="date" class="form-control" name="period_start">
    </div>

    <div class="form-group col-md-4">
      <label for="inputState">End</label>
      <input type="date" class="form-control" name="period_end">
    </div>

  </div>

  <hr id='seperator'>
  <h5>Department wise</h5>
  <div class="form-row">

    <div class="form-group col-md-4">
      <label for="inputState">Location</label>
      <select id="location" class="form-control" name="location_code">
          <option value="">Location</option>
          @foreach($locations as $location)
          <option value="{{ $location->location_code }}">{{$location->location_name}}</option>
          @endforeach
      </select>
    </div>

    <div class="form-group col-md-4">
      <label for="inputState">Sub Location</label>
      <select id="sublocation" class="form-control" name="subLocation_code" value="">
          <option value="" >Sub Location</option>
      </select>
    </div>

  </div>

  <hr>
  <h5>Purchase Date wise</h5>

  <div class="form-row">

    <div class="form-group col-md-4">
      <label for="inputState">Start Date</label>
      <input type="date" class="form-control" name="purchased_start">
    </div>

    <div class="form-group col-md-4">
      <label for="inputState">End Date</label>
      <input type="date" class="form-control" name="purchased_end">
    </div>

  </div>

  <hr>
  <h5>Supplier wise</h5>

  <div class="form-row">

    <div class="form-group col-md-4">
      <label for="inputState">Supplier</label>
      <select class="form-control" name="supplier">
      <option value="">Select Supplier</option>
        @foreach($suppliers as $supplier)
        <option value="{{ $supplier->supplier_code}}">{{ $supplier->supplier_name }}</option>
        @endforeach
      </select>
    </div>

  </div>

  <button type="submit" class="btn btn-primary">Generate</button>
</form>
