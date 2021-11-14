  <div class="form-group">
    <label for="cycle_id" class="col-form-label">Cycle:</label>
    <select name="cycle_id" class="form-control @error('cycle_id') is-invalid @enderror" required>

      <option selected disabled style="text-align:center;">-- Please choose a cycle --</option>
     
      @foreach($cycles as $cycle)
      <option value="{{$cycle->id}}">{{$cycle->name}}</option>
      @endforeach

  </select> 

    @error('cycle_id')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror 

  </div>

  <div class="form-group">
    <label for="number" class="col-form-labe @error('number') is-invalid @enderror">Number:</label>
    <input type="number"  class="form-control" name="number" required>

    @error('number')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror 
  </div>

  <div class="form-group">
    <label for="name" class="col-form-label @error('name') is-invalid @enderror">Name:</label>
    <input type="text"  class="form-control" name="name" required>

    @error('name')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror 
  </div>

