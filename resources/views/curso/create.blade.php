@extends('layouts\app')

@section('content')

<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="card uper" style="width: 60%">
  <div class="card-header">
    Cadastrar Curso
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
      <form method="post" action="{{ route('curso.store') }}" enctype="multipart/form-data">
          <div class="form-group">
              <label for="status">Instituição:</label>
              <select name="instituicao" id="instituicao" class="form-control" style="width: 100%" required="required">
                   <?php foreach ($instituicao as $key => $value): ?>
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
              <label for="name">Duração:</label>
              <input type="text" class="form-control" name="duracao" id="duracao" style="width: 40%" required="required"/>
          </div>          
          <div class="form-group">
              <label for="status">Status:</label>
              <select name="status" id="status" class="form-control" style="width: 10%">
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