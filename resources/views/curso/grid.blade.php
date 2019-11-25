@extends('layouts\app')
@section('title', 'Listando todos os registros')
 
@section('content')
<br>
<h4>Cursos</h4>
<hr>
<div class="container">
    <table class="table table-bordered table-striped table-sm">
        <thead>
          <tr>
              <th style="width: 5%">#</th>
              <th>Instituição</th>
              <th>Nome</th>
              <th>Duração</th>
              <th>Status</th>          
              <th style="width: 20%"><a href="{{ route('curso.create')}}" class="btn btn-info btn-sm" >Novo</a></th>
          </tr>
        </thead>
        <tbody>
      @forelse($curso as $curso)
      <tr>
          <td>{{ $curso->id_curso }}</td>
          <td>{{ $curso->instituicao }}</td>
          <td>{{ $curso->curso }}</td>
          <td>{{ $curso->duracao }}</td>
          <td>{{ $curso->status }}</td>          
          <td>
        <a href="{{ route('curso.edit', ['id' => $curso->id_curso]) }}" class="btn btn-warning btn-sm">Editar</a>
        <form method="GET" action="{{ route('curso.destroy', ['id' => $curso->id_curso]) }}" style="display: inline" onsubmit="return confirm('Deseja excluir este registro?');" >
            @csrf
            <input type="hidden" name="_method" value="delete" >
            <button class="btn btn-danger btn-sm">Excluir/Inativar</button>
        </form>
          </td>
      </tr>
      @empty
      <tr>
          <td colspan="7">Nenhum registro encontrado para listar</td>
      </tr>
      @endforelse
        </tbody>
    </table>
</div>
@endsection