<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\instituicao;
use App\inst_curso;


class InstituicaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $instituicao = instituicao::distinct()->orderBy('nome', 'asc')->get();

        return view('instituicao.grid', compact('instituicao'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('instituicao.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {     
      
      $instituicao = instituicao::updateOrCreate(
        [
            'nome' => $request->nome,
            'cnpj' => $request->cnpj,
            'status' => $request->status
        ],
        [
            'nome' => $request->nome,
            'cnpj' => $request->cnpj,
            'status' => $request->status
        ]
      );

      if ($instituicao) { 
          Session::flash('success', "Registro salvo com êxito"); 
          return redirect()->route('instituicao.index');
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
        $instituicao = instituicao::
            where('id_instituicao','=',$id)
            ->get()->toArray();   

        return view('instituicao.edit', compact('instituicao'));
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
        $instituicao= Instituicao::find($request->get('id_instituicao'));
        $instituicao->nome=$request->get('nome');
        $instituicao->cnpj=$request->get('cnpj');
        $instituicao->status=$request->get('status');
        $instituicao->save();

        if($request->get('status') == 1){
            $inst_curso=Inst_curso::where('id_instituicao','=',$request->get('id_instituicao'))
            ->update([
                'status' => $request->get('status'),
            ]);
        }
                
        if ($instituicao) { 
            Session::flash('success', "Registro atualizado com êxito"); 
            return redirect()->route('instituicao.index');
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
        $inst_curso_exist = Inst_curso::
            where('id_instituicao','=',$id)
            ->get()->toArray(); 

        if($inst_curso_exist){
            $inst_curso=Inst_curso::where('id_instituicao','=',$id)
                ->update(['status' => 0]);
            $instituicao=Instituicao::where('id_instituicao','=',$id)
                ->update(['status' => 0]);
        }else{
            $instituicao = Instituicao::where('id_instituicao','=',$id)->delete();
        }
                
        return redirect()->route('instituicao.index');      
    }
}
