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
    Cadastrar Aluno
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
      <form method="post" action="{{ route('aluno.store') }}" enctype="multipart/form-data">
          <div class="form-group">
              <label for="status">Instituição:</label>
              <select name="cursos" id="cursos" class="form-control" style="width: 100%" required="required">
                   <?php foreach ($cursos as $key => $value): ?>
                        <?php echo "<option value=\"$key\" >$value</option>"; ?>
                    <?php endforeach; ?>                 
              </select>
          </div>
          <div class="form-group">
              @csrf
              <label for="name">Nome:</label>
              <input type="text" class="form-control" name="nome" id="nome" style="width: 100%" required="required"/>
          </div>
          <div class="form-group">
              @csrf
              <div class="row">
              <div class="col">
                <label for="name">CPF:</label>
                <input type="text" class="form-control" name="cpf" id="cpf" onkeypress="return onlynumber();" maxlength="11" required="required">
              </div>
              <div class="col">
                <label for="name">Data de Nascimento:</label>
                <input type="date" name="data_nascimento" id="data_nascimento" class="form-control" required="required">
              </div>
              <div class="col">
                <label for="name">Celular:</label>
                <input type="text" name="celular" id="celular" class="form-control" onkeypress="return onlynumber();" maxlength="11" required="required">
              </div>
          </div>            
          </div>  
          <div class="form-group">
              @csrf
              <label for="name">E-mail:</label>
              <input type="text" class="form-control" name="email" id="email" style="width: 100%" required="required"/>
          </div>        
          <div class="form-group">
              @csrf
              <div class="row">
              <div class="col">
                <label for="name">Endereço:</label>
                <input type="text" name="endereco" id="endereco" class="form-control" required="required">
              </div>              
              <div class="col">
                <label for="name">Bairro:</label>
                <input type="text" name="bairro" id="bairro" class="form-control" required="required">
              </div>
          </div>
          </div> 
          <div class="form-group">
              @csrf
              <div class="row">
              <div class="col">
                <label for="name">Número:</label>
                <input type="text" name="numero" id="numero" class="form-control" onkeypress="return onlynumber();" maxlength="11" required="required">
              </div>              
              <div class="col">
                <label for="name">Cidade:</label>
                <input type="text" name="cidade" id="cidade" class="form-control" required="required">
              </div>
              <div class="col">
                <label for="name">UF:</label>
                <input type="text" name="uf" id="uf" class="form-control" required="required">
              </div>
              <div class="col">
                <label for="status">Status:</label>
                <select name="status" id="status" class="form-control">
                    <option value="0">0</option>
                    <option value="1" selected="selected">1</option>                  
                </select>
              </div>              
          </div>  
          </div>         
          <button type="submit" class="btn btn-primary">Salvar</button>
      </form>
  </div>
</div>
<br>
@endsection