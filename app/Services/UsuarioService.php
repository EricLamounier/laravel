<?php

namespace App\Services;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsuarioService
{
    public function cadastraUsuario(Request $request)
    {
        DB::beginTransaction();

        try {
            Usuario::create([
                'uid' => $request->uid,
                'nome' => $request->nome,
                'email' => $request->email
            ]);

            DB::commit();

            return response()->json(['mensagem' => 'Dados inseridos com sucesso!'], 200);
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json(['mensagem' => 'Erro ao inserir os dados!', 'erro' => $e->getMessage()], 500);
        }
    }

    public function teste(Request $req){
        return '$req->x';
    }

    public function pegaContas(Request $req, $usuario_id)
    {
        $results = DB::table('conta')
            ->select(
                'conta.usuario_id_fk', 
                'conta.id AS id_conta', 
                'conta.nome AS nome_conta', 
                'conta.total AS saldo_conta',
                'conta.tipo_conta AS tipo_conta',
                'transacao.id AS id_transacao', 
                'transacao.nome AS nome_transacao', 
                'transacao.valor AS valor_transacao'
            )
            ->leftJoin('transacao', 'conta.id', '=', 'transacao.conta_id_fk')
            ->where('conta.tipo_conta', $req->tipoConta)
            ->where('conta.usuario_id_fk', $usuario_id)
            ->get();

        $formattedResults = [];

        foreach ($results as $result) {
            $accountId = $result->id_conta;

            if (!isset($formattedResults[$accountId])) {
                $formattedResults[$accountId] = [
                    'usuario_id' => (int)$result->usuario_id_fk,
                    'id' => (int)$accountId,
                    'name' => $result->nome_conta,
                    'value' => (float)$result->saldo_conta,
                    'tipo_conta' => $result->tipo_conta,
                    'transacoes' => []
                ];
            }

            if (!is_null($result->id_transacao)) {
                $formattedResults[$accountId]['transacoes'][] = [
                    'usuario_id' => $usuario_id,
                    'id' => (int)$result->id_transacao,
                    'name' => $result->nome_transacao,
                    'valor' => (float)$result->valor_transacao
                ];
            }
        }

        return array_values($formattedResults);
    }

    public function pegaTotalReceitaDespesa($id)
    {
        $results = DB::table('receitas')
            ->join('despesas', 'receitas.usuario_id_fk', '=', 'despesas.usuario_id_fk')
            ->select('receitas.valor as total_receita', 'despesas.valor as total_despesa', 'receitas.usuario_id_fk as id')
            ->where('receitas.usuario_id_fk', $id)
            ->get();

        return $results;
    }

    public function pegaUsuario($uid)
    {
        return Usuario::where('uid', $uid)->get();
    }

    public function atualizaTransacao(Request $req, $usuario_id)
    {
        DB::beginTransaction();

        try {

            DB::table('transacao')
            ->where([
                ['id', $req->id],
                ['usuario_id_fk', $usuario_id]
            ])
            ->update([
                'nome' => $req->nome,
                'valor' => $req->valor
            ]);        

            DB::commit();
            return 'transaction updated';
        } catch (\Exception $e) {
            DB::rollBack();

            return 'error updating data:' . $usuario_id;
        }
    }
    public function adicionaTransacao(Request $req, $usuario_id){

        DB::beginTransaction();

        try{
            $id = DB::table('transacao')->insertGetId([
                'nome' => $req->name,
                'valor' => $req->valor,
                'tipo_transacao' => $req->tipo_transacao,
                'conta_id_fk' => $req->conta_id,
                'usuario_id_fk' => $usuario_id
            ]);

            DB::commit();
            return response()->json(['message' => 'Transacao added successfully', 'id' => $id], 200);

        }catch(\Exception $e){

            DB::rollback();
            return 'e - ' . $e;
        }
    }

    public function deletaTransacao(Request $req, $usuario_id){
        
        DB::beginTransaction();
    
        try{
            DB::table('transacao')->where([
                ['id', $req->id],
                ['usuario_id_fk', $usuario_id]
            ])->delete();
    
            DB::commit();
            return response()->json(['message' => 'Transacao deleted successfully'], 200);
    
        }catch(\Exception $e){
            DB::rollBack();
            return response()->json(['error' => 'Error deleting transacao', 'details' => $e->getMessage()], 500);
        }
    }

    public function deletaConta(Request $req, $usuario_id){

        DB::beginTransaction();

        try {
            DB::table('conta')->where([
                ['id', $req->id],
                ['usuario_id_fk', $usuario_id]
            ])
            ->delete();

            DB::commit();
            return response()->json(['message' => 'Conta deleted successfully'], 200);

        }catch(\Exception $e){
            DB::rollBack();
            return response()->json(['error' => 'Error deleting conta', 'details' => $e->getMessage()], 500); 
        }
    }

    public function adicionaConta(Request $req, $usuario_id){

        DB::beginTransaction();

        try {
            $id = DB::table('conta')->insertGetId([
                'nome' => $req->name,
                'tipo_conta' => $req->tipo_conta,
                'usuario_id_fk' => $usuario_id
            ]);

            DB::commit();
            return response()->json(['message' => 'Conta inserted successfully', 'id' => $id], 200);

        }catch(\Exception $e){
            DB::rollBack();
            return response()->json(['error' => 'Error inserting conta', 'details' => $e->getMessage()], 500); 
        }


    }
}