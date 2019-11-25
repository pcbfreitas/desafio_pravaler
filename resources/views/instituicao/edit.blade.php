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
    Atualizar Instituição
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
      <form method="post" action="{{ route('instituicao.update', $instituicao['0']['id_instituicao']) }}" enctype="multipart/form-data">
          <input value = "{{$instituicao['0']['id_instituicao']}}" type="hidden" class="form-control" name="id_instituicao" id="id_instituicao" style="width: 100%"/>
          <div class="form-group">
              @csrf
              <label for="name">Nome:</label>
              <input value = "{{$instituicao['0']['nome']}}" type="text" class="form-control" name="nome" id="nome" style="width: 100%"/>
          </div>
          <div class="form-group">
              <label for="price">CNPJ:</label>
              <input value = "{{$instituicao['0']['cnpj']}}" type="text" class="form-control" name="cnpj" id="cnpj" style="width: 40%" onkeypress="return onlynumber();" maxlength="20" />
          </div>
          <div class="form-group">
              <label for="status">Status:</label>
              <select name="status" id="status" class="form-control" style="width: 10%">
                  <option value="{{$instituicao['0']['status'] == 0 ? 1 : 0 }}">{{$instituicao['0']['status'] == 0 ? 1 : 0 }}</option>
                  <option value="{{$instituicao['0']['status']}}" selected="selected">{{$instituicao['0']['status']}}</option>                  
              </select>
          </div>
          <button type="submit" class="btn btn-primary">Atualizar</button>
      </form>
  </div>
</div>
<br>
@endsection