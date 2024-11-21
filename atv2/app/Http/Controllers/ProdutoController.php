<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function index():JsonResponse
    {
        $produtos = Produto::orderBy('id')->get();
        
        return response()->json(['mensagem'=>'Listar', $produtos]);
    }
    public function show($id):JsonResponse
    {
        $produtos = Produto::find($id);
        return response()->json(['mensagem'=>'Mostrar', $produtos]);
    }
   
    public function create(Request $request):JsonResponse
    {
        $produtos = Produto::create([
            'name'=>$request->name,
            'value'=>$request->value,
        ]);
        return response()->json(['mensagem'=>'Criar',$produtos]);
    }
   
    public function update(Request $request, $id):JsonResponse
    {
        $produtos = Produto::find($id);
        $produtos->update([
            'name'=>$request->name,
            'value'=>$request->value,
        ]);

        return response()->json(['mensagem'=>'Atualizar',$produtos]);
    }
   
    public function destroy( $id):JsonResponse
    {
        $produtos = Produto::find($id);
        $produtos->delete();
        return response()->json(['mensagem'=>'Deletar', $produtos]);
    }
}
