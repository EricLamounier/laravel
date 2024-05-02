<?php

namespace App\Http\Controllers;

use App\Services\UsuarioService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class Usuario extends Controller
{
    private UsuarioService $usuarioService;

    public function __construct(UsuarioService $usuario)
    {
        $this->usuarioService = $usuario;
    }

    public function index(Request $req)
    {
        return $this->usuarioService->cadastraUsuario($req);
    }

    public function pegaContas(Request $req, $usuario_id)
    {
        Log::info('pegaContas');
        return $this->usuarioService->pegaContas($req, $usuario_id);
    }

    public function pegaTotalReceitaDespesa($id){
        Log::info('pegaTotalReceitaDespesa');
        return $this->usuarioService->pegaTotalReceitaDespesa($id);
    }

    public function pegaUsuario($uid)
    {
        Log::info('pegaUsuario');
        return $this->usuarioService->pegaUsuario($uid);
    }

    public function atualizaTransacao(Request $req, $usuario_id)
    {
        Log::info('atualizaTransacao');
        return $this->usuarioService->atualizaTransacao($req, $usuario_id);
    }

    public function adicionaTransacao(Request $req, $usuario_id)
    {
        Log::info('adicionaTransacao');
        return $this->usuarioService->adicionaTransacao($req, $usuario_id);
    }

    public function deletaTransacao(Request $req, $usuario_id)
    {
        Log::info('deletaTransacao');
        return $this->usuarioService->deletaTransacao($req, $usuario_id);
    }

    public function deletaConta(Request $req, $usuario_id)
    {
        Log::info('deletaTransacao');
        return $this->usuarioService->deletaConta($req, $usuario_id);
    }

    public function adicionaConta(Request $req, $usuario_id)
    {
        Log::info('adicionaConta');
        return $this->usuarioService->adicionaConta($req, $usuario_id);
    }

    public function teste(Request $req)
    {
        Log::info('teste');
        Log::info($req);
        return $this->usuarioService->teste($req);
    }
}
