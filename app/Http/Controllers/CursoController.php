<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\curso;
use App\instituicao;
use App\inst_curso;

class CursoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $curso = DB::table('curso')
            ->join('inst_curso','inst_curso.id_curso','=', 'curso.id_curso')
            ->join('instituicao','instituicao.id_instituicao','=', 'inst_curso.id_instituicao')
            ->select(
                'curso.id_curso as id_curso',
                'instituicao.nome as instituicao',
                'curso.nome as curso',
                'duracao',
                'curso.status as status'
            )
            ->orderBy('instituicao.nome', 'asc')
            ->get();

        return view('curso.grid', compact('curso'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $instituicao = instituicao::select('nome','id_instituicao')
        ->where('status','=',1)
        ->orderBy('nome', 'asc')
        ->pluck('nome','id_instituicao')
        ->toArray();

        $instituicao = array_unique($instituicao);

        return view('curso.create', compact('instituicao'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $curso = new curso;
      $curso->nome = $request['nome'];
      $curso->duracao = $request['duracao'];
      $curso->status = $request['status'];
      $curso->save();
      
      $id_instituicao = $request['instituicao'];
      $last_id_curso = $curso->id_curso;
      
      $inst_curso = new inst_curso;
      $inst_curso->id_instituicao = $id_instituicao;
      $inst_curso->id_curso = $last_id_curso;
      $inst_curso->status = $request['status'];      
      $inst_curso->save();

      if ($curso) { 
          Session::flash('success', "Registro salvo com êxito"); 
          return redirect()->route('curso.index');
      }
      return redirect()->back()->withErrors(['error', "Registo não foi salvo."]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $curso = DB::table('curso')
            ->join('inst_curso','inst_curso.id_curso','=', 'curso.id_curso')
            ->join('instituicao','instituicao.id_instituicao','=', 'inst_curso.id_instituicao')
            ->where('curso.id_curso','=',$id)
            ->select(
                'curso.id_curso as id_curso',
                'instituicao.nome as instituicao',
                'instituicao.id_instituicao as id_instituicao',
                'curso.nome as curso',
                'duracao',
                'curso.status as status'
            )
            ->get()->toArray();  
   
        $instituicao = instituicao::
            select('nome','id_instituicao')
            ->where('id_instituicao','<>',$curso['0']->id_instituicao)
            ->orderBy('nome', 'asc')
            ->pluck('nome','id_instituicao')
            ->toArray();

        return view('curso.edit', compact('curso','instituicao'));
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
        $curso= curso::find($request->get('id_curso'));
        $curso->nome=$request->get('nome');
        $curso->duracao=$request->get('duracao');
        $curso->status=$request->get('status');
        $curso->save();

        $inst_curso=Inst_curso::where('id_curso','=',$request->get('id_curso'))
        ->update([
            'id_instituicao' => $request->get('instituicao'),
            'status' => $request->get('status'),
        ]);
          
        if ($curso) { 
            Session::flash('success', "Registro atualizado com êxito"); 
            return redirect()->route('curso.index');
        }
        return redirect()->back()->withErrors(['error', "Registo não foi atualizado."]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $curso=Curso::where('id_curso','=',$id)
        ->update(['status' => 0]);

        $inst_curso=Inst_curso::where('id_curso','=',$id)
        ->update(['status' => 0]);
        
        if ($curso) { 
            Session::flash('success', "Registro deletado com êxito"); 
            return redirect()->route('curso.index');
        }
        return redirect()->back()->withErrors(['error', "Registo não foi deletado."]);
    }
}
