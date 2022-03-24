<?php

namespace App\Http\Controllers;
use App\Models\Usuario;

use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function retornaUsuario($id) {
        return response()->json(Usuario::find($id));
    }

    public function retornaTodasUsuario() {
        return response()->json(Usuario::all());
    }

    public function criaUsuario(Request $requisicao) {
        $this->validate($requisicao, [
            'nome' => 'required|min:3|max:255',
            'email' => 'required|email|max:255|unique:usuarios',
            'telefone' => 'unique:usuarios|size:11',
            'data_nascimento' => 'date',
            'cidade_nascimento' => 'min:3|max:255'
        ]);

        $usuario = new Usuario;

        $usuario->nome = $requisicao->nome;
        $usuario->email = $requisicao->email;
        $usuario->telefone = $requisicao->telefone ?? null;
        $usuario->data_nascimento = date_create($requisicao->data_nascimento) ?? null;
        $usuario->cidade_nascimento = $requisicao->cidade_nascimento ?? null;

        $usuario->save();
    }

    public function deletaUsuario($id) {
        Usuario::find($id)->delete();
    }

    public function atualizaUsuario($id, Request $requisicao) {
        $this->validate($requisicao, [
            'nome' => 'min:3|max:255',
            'email' => 'email|max:255|unique:usuarios,email,' . $id,
            'telefone' => 'size:11|unique:usuarios,telefone,' . $id,
            'data_nascimento' => 'date',
            'cidade_nascimento' => 'min:3|max:255'
        ]);

        $usuario = Usuario::find($id);

        $usuario->nome = $requisicao->nome ?? $usuario->nome;
        $usuario->email = $requisicao->email ?? $usuario->email;
        $usuario->telefone = $requisicao->telefone ?? $usuario->telefone;
        $usuario->data_nascimento = date_create($requisicao->data_nascimento) ?? $usuario->data_nascimento;
        $usuario->cidade_nascimento = $requisicao->cidade_nascimento ?? $usuario->cidade_nascimento;

        $usuario->save();
    }
}
