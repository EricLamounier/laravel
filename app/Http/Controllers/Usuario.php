<?php

namespace App\Http\Controllers;

use App\Services\UsuarioService;
use Illuminate\Http\Request;

class Usuario extends Controller
{
    private UsuarioService $usuarioService;

    public function __construct(UsuarioService $usuario)
    {
        $this->usuarioService = $usuario;
    }

    public function testeapi(Request $req)
    {
        return $this->usuarioService->teste($req);
    }
}
