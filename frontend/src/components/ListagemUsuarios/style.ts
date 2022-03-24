import styled from "styled-components";

export const Container = styled.main`
    height: fit-content;
    min-height: 560px;
    width: min(80%, 1120px);

    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: flex-start;

    padding: 25px;
    margin: 50px auto;

    background-color: var(--cinza);
    border-radius: 0.25rem;

    img {
        height: 113px;
        width: 296px;
    }
`;