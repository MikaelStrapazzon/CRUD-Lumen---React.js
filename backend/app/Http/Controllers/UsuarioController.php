<?php

namespace App\Http\Controllers;
use App\Models\Usuario;
use App\Models\Empresa;

use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function retornaUsuario($id) {
        $usuario = Usuario::find($id);
        $usuario->empresas = $usuario->empresas()->get();
        return response()->json($usuario);
    }

    public function retornaTodasUsuario() {
        $usuarios = Usuario::all();
        foreach( $usuarios as $usuario ) {
            $usuario->empresas = $usuario->empresas()->get();
        }

        return response()->json($usuarios);
    }

    public function criaUsuario(Request $requisicao) {
        //Criar validação se empresas existem
        $this->validate($requisicao, [
            'nome' => 'required|min:3|max:255',
            'email' => 'required|email|max:255|unique:usuarios',
            'telefone' => 'unique:usuarios|size:11',
            'data_nascimento' => 'date',
            'cidade_nascimento' => 'min:3|max:255',
            'empresas' => 'required|array|min:1'
        ]);

        $usuario = new Usuario;

        $usuario->nome = $requisicao->nome;
        $usuario->email = $requisicao->email;
        $usuario->telefone = $requisicao->telefone ?? null;
        $usuario->data_nascimento = date_create($requisicao->data_nascimento) ?? null;
        $usuario->cidade_nascimento = $requisicao->cidade_nascimento ?? null;

        $usuario->save();

        $empresas = Empresa::find($requisicao->empresas);
        $usuario->empresas()->attach($empresas);
    }

    public function deletaUsuario($id) {
        $usuario = Usuario::find($id);
        $usuario->empresas()->detach();
        $usuario->delete();
    }

    public function atualizaUsuario($id, Request $requisicao) {
        //Criar validação se empresas existem
        $this->validate($requisicao, [
            'nome' => 'min:3|max:255',
            'email' => 'email|max:255|unique:usuarios,email,' . $id,
            'telefone' => 'size:11|unique:usuarios,telefone,' . $id,
            'data_nascimento' => 'date',
            'cidade_nascimento' => 'min:3|max:255',
            'empresas' => 'array|min:1'
        ]);

        $usuario = Usuario::find($id);

        $usuario->nome = $requisicao->nome ?? $usuario->nome;
        $usuario->email = $requisicao->email ?? $usuario->email;
        $usuario->telefone = $requisicao->telefone ?? $usuario->telefone;
        $usuario->data_nascimento = date_create($requisicao->data_nascimento) ?? $usuario->data_nascimento;
        $usuario->cidade_nascimento = $requisicao->cidade_nascimento ?? $usuario->cidade_nascimento;

        $usuario->save();

        $usuario->empresas()->detach();

        $empresas = Empresa::find($requisicao->empresas);
        $usuario->empresas()->attach($empresas);
    }
}
