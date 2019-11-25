<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get("/", "GestaoController@index")->name("gestao.index");

Route::get("gestao", "GestaoController@index")->name("gestao.index");
Route::get("gestao/edit/{id}", "GestaoController@edit")->name("gestao.edit");
Route::post("gestao/update/{id}", "GestaoController@update")->name("gestao.update");

//Rotas para gestão das Instituições

Route::get("instituicao", "InstituicaoController@index")->name("instituicao.index");
Route::get("instituicao/create", "InstituicaoController@create")->name("instituicao.create");
Route::post("instituicao/store", "InstituicaoController@store")->name("instituicao.store");
Route::get("instituicao/edit/{id}", "InstituicaoController@edit")->name("instituicao.edit");
Route::post("instituicao/update/{id}", "InstituicaoController@update")->name("instituicao.update");
Route::get("instituicao/destroy/{id}", "InstituicaoController@destroy")->name("instituicao.destroy");


//Rotas para gestão dos Cursos

Route::get("curso", "CursoController@index")->name("curso.index");
Route::get("curso/create", "CursoController@create")->name("curso.create");
Route::post("curso/store", "CursoController@store")->name("curso.store");
Route::get("curso/edit/{id}", "CursoController@edit")->name("curso.edit");
Route::post("curso/update/{id}", "CursoController@update")->name("curso.update");
Route::get("curso/destroy/{id}", "CursoController@destroy")->name("curso.destroy");


//Rotas para gestão dos Alunos

Route::get("aluno", "AlunoController@index")->name("aluno.index");
Route::get("aluno/create", "AlunoController@create")->name("aluno.create");
Route::post("aluno/store", "AlunoController@store")->name("aluno.store");
Route::get("aluno/edit/{id}", "AlunoController@edit")->name("aluno.edit");
Route::post("aluno/update/{id}", "AlunoController@update")->name("aluno.update");
Route::get("aluno/destroy/{id}", "AlunoController@destroy")->name("aluno.destroy");




