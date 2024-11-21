<?php

namespace App\Http\Controllers;

use App\Models\Cor;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CorController extends Controller
{

    public function index():JsonResponse
    {
        $cors = Cor::orderBy('id')->get();

        return response()->json( data:[ 'Nome da cor:', $cors]);
    }


    public function create(Request $request):JsonResponse
    {
        $cors = Cor::Create([
            'name'=>$request->name,
        ]);
        return response()->json(['Cor Criada', $cors]);
    }

    public function show( $id):JsonResponse
    {
        $cors = Cor::find($id);
        return response()->json(['Cor Encontrada', $cors]);
    }

    public function update(Request $request, $id):JsonResponse
    {
        $cors = Cor::find($id);
        $cors->update([
            'name'=>$request->name,
        ]);
        return response()->json(['Cor Atualizada', $cors]);
    }
    public function destroy($id):JsonResponse
    {
        $cors=Cor::find($id);
        $cors->delete();
        return response()->json(['Cor Apagada', $cors]);
    }
}
