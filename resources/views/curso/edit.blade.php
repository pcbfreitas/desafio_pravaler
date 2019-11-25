@extends('layouts\app')

@section('content')

<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="card uper" style="width: 60%">
  <div class="card-header">
    Atualizar Curso
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
      <form method="post" action="{{ route('curso.update', $curso['0']->id_curso) }}" enctype="multipart/form-data">
          <input value = "{{$curso['0']->id_curso}}" type="hidden" class="form-control" name="id_curso" id="id_curso" style="width: 100%"/>
          <div class="form-group">
              <label for="status">Instituição:</label>
              <select name="instituicao" id="instituicao" class="form-control" style="width: 100%">
                   <option value="{{$curso['0']->id_instituicao}}">{{$curso['0']->instituicao}}</option>
                   <?php foreach ($instituicao as $key => $value): ?>
                        <?php echo "<option value=\"$key\" >$value</option>"; ?>
                    <?php endforeach; ?>                 
              </select>
          </div>
          <div class="form-group">
              @csrf
              <label for="name">Nome:</label>
              <input type="text" class="form-control" name="nome" id="nome" style="width: 100%" value="{{$curso['0']->curso}}"/>
          </div>
          <div class="form-group">
              @csrf
              <label for="name">Duração:</label>
              <input type="text" class="form-control" name="duracao" id="duracao" style="width: 40%" value="{{$curso['0']->duracao}}"/>
          </div>          
          <div class="form-group">
              <label for="status">Status:</label>
              <select name="status" id="status" class="form-control" style="width: 10%">
                  <option value="{{$curso['0']->status == 0 ? 1 : 0 }}">{{$curso['0']->status == 0 ? 1 : 0 }}</option>
                  <option value="{{$curso['0']->status}}" selected="selected">{{$curso['0']->status}}</option>                  
              </select>
          </div>
          <button type="submit" class="btn btn-primary">Atualizar</button>
      </form>
  </div>
</div>
<br>
@endsection