@extends('layouts\app')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<script>

  function onlynumber(evt) {
   var theEvent = evt || window.event;
   var key = theEvent.keyCode || theEvent.which;
   key = String.fromCharCode( key );
   //var regex = /^[0-9.,]+$/;
   var regex = /^[0-9]+$/;
   if( !regex.test(key) ) {
      theEvent.returnValue = false;
      if(theEvent.preventDefault) theEvent.preventDefault();
   }
}

</script>
<div class="card uper" style="width: 60%">
  <div class="card-header">
    Cadastrar Instituição
  </div>
  <div class="card-body">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
      <form method="post" action="{{ route('instituicao.store') }}" enctype="multipart/form-data">
          <div class="form-group">
              @csrf
              <label for="name">Nome:</label>
              <input type="text" class="form-control" name="nome" id="nome" style="width: 100%" required="required"/>
          </div>
          <div class="form-group">
              <label for="price">CNPJ:</label>
              <input type="text" class="form-control" name="cnpj" id="cnpj" style="width: 40%" onkeypress="return onlynumber();" maxlength="20" required="required" />
          </div>
          <div class="form-group">
              <label for="status">Status:</label>
              <select name="status" id="status" class="form-control" style="width: 10%" required="required">
                  <option value="0">0</option>
                  <option value="1" selected="selected">1</option>                  
              </select>
          </div>
          <button type="submit" class="btn btn-primary">Salvar</button>
      </form>
  </div>
</div>
<br>
@endsection