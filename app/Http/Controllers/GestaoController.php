<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\alunos;
use App\curso;
use App\curso_aluno;

class GestaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    
      $gestao = DB::table('alunos')
            ->join('curso_aluno','curso_aluno.id_aluno','=', 'alunos.id_aluno')
            ->join('curso','curso.id_curso','=', 'curso_aluno.id_curso')
            ->join('inst_curso','inst_curso.id_curso','=', 'curso.id_curso')
            ->join('instituicao','instituicao.id_instituicao','=', 'inst_curso.id_instituicao')
            ->select(
                'instituicao.nome as instituicao',
                'alunos.nome as aluno',
                'alunos.id_aluno',
                'curso.nome as curso'
            )
            ->where('alunos.status','=',1)
            ->where('curso_aluno.status','=',1)
            ->where('curso.status','=',1)
            ->where('inst_curso.status','=',1)
            ->where('instituicao.status','=',1)
            ->orderBy('instituicao.nome', 'asc')
            ->get();

        return view('gestao.grid', compact('gestao'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $aluno = DB::table('alunos')
            ->join('curso_aluno','curso_aluno.id_aluno','=', 'alunos.id_aluno')
            ->join('curso','curso.id_curso','=', 'curso_aluno.id_curso')
            ->join('inst_curso','inst_curso.id_curso','=', 'curso.id_curso')
            ->join('instituicao','instituicao.id_instituicao','=', 'inst_curso.id_instituicao')
            ->where('alunos.id_aluno','=',$id)
            ->select(
                'alunos.id_aluno',
                'alunos.nome as aluno',
                'cpf',
                'data_nascimento',
                'celular',
                'email',
                'endereco',
                'bairro',
                'numero',
                'cidade',
                'uf',
                'alunos.status',
                'curso.id_curso as id_curso'
            )            
            ->get()->toArray(); 

        $curso_aluno = DB::table('curso')
            ->join('inst_curso','inst_curso.id_curso','=', 'curso.id_curso')
            ->join('instituicao','instituicao.id_instituicao','=', 'inst_curso.id_instituicao')
            ->where('curso.id_curso','=',$aluno['0']->id_curso)  
            ->select('curso.id_curso',DB::raw("CONCAT(instituicao.nome,' - ',curso.nome) AS curso_inst"))
            ->get()->toArray();

        $cursos = DB::table('curso')
            ->join('inst_curso','inst_curso.id_curso','=', 'curso.id_curso')
            ->join('instituicao','instituicao.id_instituicao','=', 'inst_curso.id_instituicao')   
            ->where('curso.id_curso','<>',$aluno['0']->id_curso)
            ->where('curso.status','=',1)
            ->select('curso.id_curso',DB::raw("CONCAT(instituicao.nome,' - ',curso.nome) AS curso_inst"))
            ->pluck('curso_inst','id_curso')->toArray();

        $cursos = array_unique($cursos);

        return view('gestao.edit', compact('aluno','curso_aluno','cursos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $aluno= alunos::find($request->get('id_aluno'));
        $aluno->nome=$request->get('nome');
        $aluno->cpf=$request->get('cpf');
        $aluno->data_nascimento=$request->get('data_nascimento');
        $aluno->email=$request->get('email');
        $aluno->celular=$request->get('celular');
        $aluno->endereco=$request->get('endereco');
        $aluno->numero=$request->get('numero');
        $aluno->bairro=$request->get('bairro');
        $aluno->cidade=$request->get('cidade');
        $aluno->uf=$request->get('uf');
        $aluno->status=$request->get('status');
        $aluno->save();

        $curso_aluno=Curso_aluno::where('id_aluno','=',$request->get('id_aluno'))
        ->update([
          'id_curso' => $request->get('cursos'),
          'status' => $request->get('status')
        ]);
          
        if ($aluno) { 
            Session::flash('success', "Registro atualizado com êxito"); 
            return redirect()->route('gestao.index');
        }
        return redirect()->back()->withErrors(['error', "Registo não foi atualizado."]);
    }

}
