import { Container } from "./style";

import { HeaderListagem } from "../HeaderListagem";
import { TabelaListagem } from "../TabelaListagem";

import logo from "../../assets/logo.png";

export function LisagemUsuarios() {
    return (
        <Container>
            <img src={logo} alt="Logo Contato Seguro" />
            <HeaderListagem />
            <TabelaListagem />
        </Container>
    );
}