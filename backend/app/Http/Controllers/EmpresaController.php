<?php

namespace App\Http\Controllers;
use App\Models\Empresa;

use Illuminate\Http\Request;

class EmpresaController extends Controller
{
    public function retornaEmpresa($id) {
        $empresa = Empresa::find($id);
        $empresa->usuarios = $empresa->usuarios()->get();
        return response()->json($empresa);
    }

    public function retornaTodasEmpresa() {
        $empresas = Empresa::all();
        foreach( $empresas as $empresa ) {
            $empresa->usuarios = $empresa->usuarios()->get();
        }

        return response()->json($empresas);
    }

    public function criaEmpresa(Request $requisicao) {
        $this->validate($requisicao, [
            'nome' => 'required|min:3|max:255',
            'cnpj' => 'required|cnpj|size:14|unique:empresas',
            'endereco' => 'required|min:3|max:255'
        ]);

        $empresa = new Empresa;

        $empresa->nome = $requisicao->nome;
        $empresa->cnpj = $requisicao->cnpj;
        $empresa->endereco = $requisicao->endereco;

        $empresa->save();
    }

    public function deletaEmpresa($id) {
        $empresa = Empresa::find($id);
        $empresa->usuarios()->detach();
        $empresa->delete();
    }

    public function atualizaEmpresa($id, Request $requisicao) {
        $this->validate($requisicao, [
            'nome' => 'min:3|max:255',
            'cnpj' => 'cnpj|size:14|unique:empresas,cnpj,' . $id,
            'endereco' => 'min:3|max:255'
        ]);

        $empresa = Empresa::find($id);

        $empresa->nome = $requisicao->nome ?? $empresa->nome;
        $empresa->cnpj = $requisicao->cnpj ?? $empresa->cnpj;
        $empresa->endereco = $requisicao->endereco ?? $empresa->endereco;

        $empresa->save();
    }
}
