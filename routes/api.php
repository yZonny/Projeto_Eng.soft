<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Funcionario;
use App\Models\Departamento;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/funcionarios', function (Request $request) {
    $funcionario = new Funcionario();
    $funcionario->nome = $request->input('nome');
    $funcionario->idade = $request->input('idade');
    $funcionario->cpf = $request->input('cpf');
    $funcionario->endereco = $request->input('endereco');
    $funcionario->telefone = $request->input('telefone');
    $funcionario->departamento_id = $request->input('departamento_id');    
    $funcionario->save();
    return response()->json($funcionario);
});

Route::put('/funcionarios/{id}', function (Request $request, $id) {
    $funcionario = Funcionario::find($id);

    $funcionario->nome = $request->input('nome', $funcionario->nome);
    $funcionario->idade = $request->input('idade', $funcionario->idade);
    $funcionario->cpf = $request->input('cpf', $funcionario->cpf);
    $funcionario->endereco = $request->input('endereco', $funcionario->endereco);
    $funcionario->telefone = $request->input('telefone', $funcionario->telefone);
    $funcionario->departamento_id = $request->input('departamento_id', $funcionario->departamento_id);

    $funcionario->save();

    return response()->json($funcionario);
});

Route::get('/funcionarios', function(){
    $funcionario = Funcionario::all();
    return response()->json($funcionario);
});

Route::get('/funcionarios/departamentos', function(){
    $funcionarios = Funcionario::with('departamento')->get();
    return response()->json($funcionarios);
});

Route::get('/funcionarios/departamento/{id}', function(int $id){
    $funcionario = Funcionario::with('departamento')->get()->find($id)["departamento"];
    return response()->json($funcionario);
});

Route::get('/funcionarios/{id}', function($id){
    $funcionario = Funcionario::find($id);
    return response()->json($funcionario);
});

Route::delete('funcionarios/{id}', function($id){
    $funcionario = Funcionario::find($id);
    $funcionario->delete();
    return response()->json($funcionario);
});

Route::patch('/funcionarios/{id}', function(Request $request, $id){
    $funcionario = Funcionario::find($id);

    if($request->input('nome')!== null){
        $funcionario->nome = $request->input('nome');
    }
    if($request->input('idade')!== null){
        $funcionario->idade = $request->input('idade');
    }
    if($request->input('cpf')!== null){
        $funcionario->cpf = $request->input('cpf');
    }
    if($request->input('endereco')!== null){
        $funcionario->endereco = $request->input('endereco');
    }
    if($request->input('telefone')!== null){
        $funcionario->telefone = $request->input('telefone');
    }
    if($request->input('departamento_id')!== null){
        $funcionario->departamento_id = $request->input('departamento_id');
    }
    
    $funcionario->save();
    return response()->json($funcionario);
});

Route::post('/departamentos', function (Request $request) {
    $departamento = new Departamento();
    $departamento->nome = $request->input('nome');
    $departamento->save();
    return response()->json($departamento);
});

Route::put('/departamentos/{id}', function (Request $request, $id) {
    $departamento = Departamento::find($id);

    $departamento->nome = $request->input('nome', $departamento->nome);
    $departamento->save();

    return response()->json($departamento);
});

Route::get('/departamentos', function(){
    $departamento = Departamento::all();
    return response()->json($departamento);
});

Route::get('/departamentos/funcionarios', function(){
    $departamento = Departamento::with('funcionarios')->get();
    return response()->json($departamento);
});

Route::get('/departamentos/funcionarios/{id}', function(int $id){
    $departamento = Departamento::with('funcionarios')->get()->find($id)["funcionarios"];
    return response()->json($departamento);
});

Route::get('/departamentos/{id}', function($id){
    $departamento = Departamento::find($id);
    return response()->json($departamento);
});

Route::delete('/departamentos/{id}', function($id){
    $departamento = Departamento::find($id);
    $departamento->delete();
    return response()->json($departamento);
});

Route::patch('/departamentos/{id}', function(Request $request, $id){
    $departamento = Departamento::find($id);
    if($request->input('nome')!== null){
        $departamento->nome = $request->input('nome');
    }
    $departamento->save();
    return response()->json($departamento);
});

Route::get('/funcionarios/departamentos/{id}', function($id){
    $funcionario = Funcionario::find($id);

    if (!$funcionario) {
        return response()->json(['erro' => 'Funcionário não encontrado'], 404);
    }

    $departamento = $funcionario->departamento;

    return response()->json($departamento);
});


Route::get('/departamentos/funcionarios/{id}', function($id){
    $departamento = Departamento::find($id);
    $funcionario = $departamento->funcionarios;

    return response()->json($funcionario);
});

