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
    Atualizar Aluno
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
      <form method="post" action="{{ route('gestao.update', $aluno['0']->id_aluno) }}" enctype="multipart/form-data">
          <input value = "{{$aluno['0']->id_aluno}}" type="hidden" class="form-control" name="id_aluno" id="id_aluno" style="width: 100%"/>
          <div class="form-group">
              <label for="status">Instituição:</label>
              <select name="cursos" id="cursos" class="form-control" style="width: 100%" required="required">
                   <option value="{{$curso_aluno['0']->id_curso}}">{{$curso_aluno['0']->curso_inst}}</option>
                   <?php foreach ($cursos as $key => $value): ?>
                        <?php echo "<option value=\"$key\" >$value</option>"; ?>
                   <?php endforeach; ?>                 
              </select>            
          </div>
          <div class="form-group">
              @csrf
              <label for="name">Nome:</label>
              <input value="{{$aluno['0']->aluno}}" type="text" class="form-control" name="nome" id="nome" style="width: 100%" required="required"/>
          </div>
          <div class="form-group">
              @csrf
              <div class="row">
              <div class="col">
                <label for="name">CPF:</label>
                <input value="{{$aluno['0']->cpf}}" type="text" class="form-control" name="cpf" id="cpf" onkeypress="return onlynumber();" maxlength="11" required="required">
              </div>
              <div class="col">
                <label for="name">Data de Nascimento:</label>
                <input value="{{$aluno['0']->data_nascimento}}" type="date" name="data_nascimento" id="data_nascimento" class="form-control" required="required">
              </div>
              <div class="col">
                <label for="name">Celular:</label>
                <input value="{{$aluno['0']->celular}}" type="text" name="celular" id="celular" class="form-control" onkeypress="return onlynumber();" maxlength="11" required="required">
              </div>
          </div>            
          </div>  
          <div class="form-group">
              @csrf
              <label for="name">E-mail:</label>
              <input value="{{$aluno['0']->email}}" type="text" class="form-control" name="email" id="email" style="width: 100%" required="required"/>
          </div>        
          <div class="form-group">
              @csrf
              <div class="row">
              <div class="col">
                <label for="name">Endereço:</label>
                <input value="{{$aluno['0']->endereco}}" type="text" name="endereco" id="endereco" class="form-control" required="required">
              </div>              
              <div class="col">
                <label for="name">Bairro:</label>
                <input value="{{$aluno['0']->bairro}}" type="text" name="bairro" id="bairro" class="form-control" required="required">
              </div>
          </div>
          </div> 
          <div class="form-group">
              @csrf
              <div class="row">
              <div class="col">
                <label for="name">Número:</label>
                <input value="{{$aluno['0']->numero}}" type="text" name="numero" id="numero" class="form-control" onkeypress="return onlynumber();" maxlength="11" required="required">
              </div>              
              <div class="col">
                <label for="name">Cidade:</label>
                <input value="{{$aluno['0']->cidade}}" type="text" name="cidade" id="cidade" class="form-control" required="required">
              </div>
              <div class="col">
                <label for="name">UF:</label>
                <input value="{{$aluno['0']->uf}}" type="text" name="uf" id="uf" class="form-control" required="required">
              </div>
              <div class="col">
                <label for="status">Status:</label>
                <select name="status" id="status" class="form-control">
                    <option value="{{$aluno['0']->status == 0 ? 1 : 0 }}">{{$aluno['0']->status == 0 ? 1 : 0 }}</option>
                    <option value="{{$aluno['0']->status}}" selected="selected">{{$aluno['0']->status}}</option>                  
                </select>
              </div>              
          </div>  
          </div>         
          <button type="submit" class="btn btn-primary">Atualizar</button>
      </form>
  </div>
</div>
<br>
@endsection