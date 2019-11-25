@extends('layouts\app')
@section('title', 'Listando todos os registros')
 
@section('content')
<br>
<h4>Gestão/Ativos</h4><font color="blue">(Cursos e alunos vinculados a instituição)</font>
<hr>
<div class="container">
    <table class="table table-bordered table-striped table-sm">
        <thead>
          <tr>         
              <th>Instituição</th>
              <th>Curso</th>
              <th>Aluno</th>
              <th style="width: 10%">
              Ações
              </th>
          </tr>
        </thead>
        <tbody>
      @forelse($gestao as $gestao)
      <tr>
          <td>{{ $gestao->instituicao }}</td>
          <td>{{ $gestao->curso }}</td>
          <td>{{ $gestao->aluno }}</td>                
          <td>
            <a href="{{ route('gestao.edit', ['id' => $gestao->id_aluno]) }}" class="btn btn-warning btn-sm">Editar/Excluir</a>
            <form method="GET" action="" style="display: inline" onsubmit="return confirm('Deseja excluir/inativar este registro?');" >
                @csrf
                <input type="hidden" name="_method" value="delete" >           
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