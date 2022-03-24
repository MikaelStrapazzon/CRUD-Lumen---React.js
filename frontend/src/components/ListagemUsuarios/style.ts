import styled from "styled-components";

export const Container = styled.main`
    min-height: 560px;
    width: min(80%, 1120px);

    display: flex;
    justify-content: center;

    padding: 25px;
    margin: auto;

    background-color: var(--cinza);
    border-radius: 0.25rem;

    img {
        height: 113px;
        width: 296px;
    }
`;