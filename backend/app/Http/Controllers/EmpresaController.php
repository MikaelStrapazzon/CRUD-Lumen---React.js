<?php

namespace App\Http\Controllers;
use App\Models\Empresa;

use Illuminate\Http\Request;

class EmpresaController extends Controller
{
    public function retornaEmpresa($id) {
        return response()->json(Empresa::find($id));
    }

    public function retornaTodasEmpresa() {
        return response()->json(Empresa::all());
    }

    public function criaEmpresa(Request $requisicao) {
        $this->validate($requisicao, [
            'nome' => 'required|min:3|max:255',
            'cnpj' => 'required|cnpj|unique:empresas|size:14',
            'endereco' => 'required|min:3|max:255'
        ]);

        $empresa = new Empresa;

        $empresa->nome = $requisicao->nome;
        $empresa->cnpj = $requisicao->cnpj;
        $empresa->endereco = $requisicao->endereco;

        $empresa->save();
    }

    public function deletaEmpresa($id) {
        Empresa::find($id)->delete();
    }

    public function atualizaEmpresa($id, Request $requisicao) {
        $this->validate($requisicao, [
            'nome' => 'min:3|max:255',
            'cnpj' => 'cnpj|size:14|unique:empresas,' . $id,
            'endereco' => 'min:3|max:255'
        ]);

        $empresa = Empresa::find($id);

        $empresa->nome = $requisicao->nome ?? $empresa->nome;
        $empresa->cnpj = $requisicao->cnpj ?? $empresa->cnpj;
        $empresa->endereco = $requisicao->endereco ?? $empresa->endereco;

        $empresa->save();
    }
}
