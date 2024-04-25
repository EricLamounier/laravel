<?php

namespace App\Services;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsuarioService {

    public function teste(Request $req){
        return $req;
    }

    public function index(Request $req){
        DB::beginTransaction();

        try{
            Usuario::create([
                'uid' => rand(0, 9999),
                'nome' => $req->nome,
                'email' => $req->email
            ]);
            DB::commit();
            return response()->json([
                'mensagem' => 'Dados inseridos com sucesso!',
            ], 200);

        }catch(\Exception $e){
            DB::rollback();
            return response()->json([
                'mensagem' => 'Erro ao inserir os dados!',
                'erro' => $e
            ], 500);
        }
    }
}

