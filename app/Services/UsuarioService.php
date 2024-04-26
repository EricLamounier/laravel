<?php

namespace App\Services;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsuarioService {

    public function cadastraUsuario(Request $req){
        DB::beginTransaction();

        try{
            Usuario::create([
                'uid' => $req->uid,
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

    public function contas(Request $req){
        $results = DB::select('
        SELECT
    c.id AS conta_id,
    c.nome AS conta_nome,
    CONCAT(\'[\',
    STRING_AGG(CONCAT(\'{\', \'"transacao_id":\', t.id, \',\', \'"transacao_nome": "\', t.nome, \'"\', \',\', \'"transacao_valor": \', t.valor, \'}\'), \',\'), \']\') AS transacoes
from conta c
join transacao t ON c.id = t.conta_id_fk
GROUP BY c.id, c.nome;
        ');
        return $results;
    }
}

