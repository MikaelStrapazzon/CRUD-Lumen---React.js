import { useEffect, useState } from "react";
import { api } from "../../services/api";

import { Container, TabelaUsuarios } from "./style";

interface usuario {
    id: number
    nome: string
    email: string
    telefone: string
    data_nascimento: Date
    cidade_nascimento: string
    empresas: [{
        id: number
        nome: string
    }]
}

export function TabelaListagem() {
    const [usuarios, setUsuarios] = useState<usuario[]>([]);

    useEffect(() => {
        api.get( "usuario" )
          .then( response => setUsuarios(response.data) )
      }, []);

    console.log(usuarios)

    return (
        <Container>
            <TabelaUsuarios>
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Telefone</th>
                        <th>Nascimento</th>
                        <th>Cidade</th>
                        <th>Empresas</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    {usuarios.map(usuario => (
                        <tr key={usuario.id}>
                            <td>{usuario.nome}</td>
                            <td>{usuario.email}</td>
                            <td>{usuario.telefone}</td>
                            <td>{usuario.data_nascimento}</td>
                            <td>{usuario.cidade_nascimento}</td>
                            <td>
                                <ul>
                                    {usuario.empresas.map(empresa => {
                                        return <li key={usuario.id + empresa.id}> {empresa.nome}  </li>
                                    })}
                                </ul>
                            </td>
                            <td>
                                <button></button>
                                <button></button>
                            </td>
                        </tr>
                    ))
                    }
                </tbody>
            </TabelaUsuarios>
        </Container>
    );
}