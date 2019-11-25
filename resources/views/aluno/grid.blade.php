@extends('layouts\app')
@section('title', 'Listando todos os registros')
 
@section('content')
<br>
<h4>Alunos</h4>
<hr>
<div class="container">
    <table class="table table-bordered table-striped table-sm">
        <thead>
          <tr>
              <th style="width: 5%">#</th>
              <th>Instituição</th>
              <th>Curso</th>
              <th>Aluno</th>          
              <th>CPF</th>       
              <th>Celular</th>
              <th>Status</th>          
              <th style="width: 20%"><a href="{{ route('aluno.create')}}" class="btn btn-info btn-sm" >Novo</a></th>
          </tr>
        </thead>
        <tbody>
      @forelse($aluno as $aluno)
      <tr>
          <td>{{ $aluno->id_aluno }}</td>
          <td>{{ $aluno->instituicao }}</td>
          <td>{{ $aluno->curso }}</td>
          <td>{{ $aluno->aluno }}</td>
          <td>{{ $aluno->cpf }}</td>          
          <td>{{ $aluno->celular }}</td>         
          <td>{{ $aluno->status }}</td>          
          <td>
        <a href="{{ route('aluno.edit', ['id' => $aluno->id_aluno]) }}" class="btn btn-warning btn-sm">Editar</a>
        <form method="GET" action="{{ route('aluno.destroy', ['id' => $aluno->id_aluno]) }}" style="display: inline" onsubmit="return confirm('Deseja excluir/inativar este registro?');" >
            @csrf
            <input type="hidden" name="_method" value="delete" >
            <button class="btn btn-danger btn-sm">Excluir/Inativar</button>
        </form>
          </td>
      </tr>
      @empty
      <tr>
          <td colspan="9">Nenhum registro encontrado para listar</td>
      </tr>
      @endforelse
        </tbody>
    </table>
</div>
@endsection