import styled from "styled-components";

export const Container = styled.div`
    width: 100%;

    overflow-x: auto;
`;

export const TabelaUsuarios = styled.table`
    width: 100%;

    margin-top: 20px;
    border-spacing: 0 0.5rem;

    th {
        border-top: 1px solid #999;
        border-bottom: 1px solid #999;
        font-weight: 600;
        padding: 1rem 0.4rem;
        text-align: left;
    }

    td {
        padding: 0.4rem;
    }
`;