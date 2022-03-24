import { Container, ButtonNovo, InputPesquisa, InputCampoPesquisa } from "./style";

export function HeaderListagem() {
    return (
        <Container>
            <ButtonNovo />
            <InputPesquisa />
            <InputCampoPesquisa />
        </Container>
    );
}