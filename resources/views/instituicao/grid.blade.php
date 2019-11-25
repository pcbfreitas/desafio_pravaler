@extends('layouts\app')
@section('title', 'Listando todos os registros')
 
@section('content')
<br>
<h4>Instituicões</h4>
<hr>
<div class="container">
    <table class="table table-bordered table-striped table-sm">
        <thead>
      <tr>
          <th style="width: 5%">#</th>
          <th>Nome</th>
          <th>CNPJ</th>
          <th>Status</th>          
          <th style="width: 20%">
        <a href="{{ route('instituicao.create')}}" class="btn btn-info btn-sm" >Novo</a>
          </th>
      </tr>
        </thead>
        <tbody>
      @forelse($instituicao as $instituicao)
      <tr>
          <td>{{ $instituicao->id_instituicao }}</td>
          <td>{{ $instituicao->nome }}</td>
          <td>{{ $instituicao->cnpj }}</td>
          <td>{{ $instituicao->status }}</td>          
          <td>
        <a href="{{ route('instituicao.edit', ['id' => $instituicao->id_instituicao]) }}" class="btn btn-warning btn-sm">Editar</a>
        <form method="GET" action="{{ route('instituicao.destroy', ['id' => $instituicao->id_instituicao]) }}" style="display: inline" onsubmit="return confirm('Deseja excluir este registro?');" >
            @csrf
            <input type="hidden" name="_method" value="delete" >
            <button class="btn btn-danger btn-sm">Excluir/Inativar</button>
        </form>
          </td>
      </tr>
      @empty
      <tr>
          <td colspan="6">Nenhum registro encontrado para listar</td>
      </tr>
      @endforelse
        </tbody>
    </table>
</div>
@endsection