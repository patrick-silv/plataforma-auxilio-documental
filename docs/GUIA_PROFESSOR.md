# Guia de consulta académica — PAD

## 1. Identificação

Projeto: Plataforma de Auxílio Documental (PAD). Contexto: atividade extensionista independente do curso de Engenharia de Software da UNIGRAN Europa. Objetivo: organizar informações públicas sobre documentação para pessoas que vivem em Portugal.

## 2. Como avaliar o projeto

- **Demonstração online:** https://auxiliodocumental.biz
- **Frontend:** consulte `index.php`, `inicio.php`, `css/` e `js/`.
- **Conteúdos documentais:** consulte `includes/dados_documentos.php`, `documentacao.php` e `documento.php`.
- **Participação agregada por nacionalidade:** consulte `avaliar.php` e a tabela `pad_participacoes_paises` no esquema SQL.
- **Administração:** consulte `admin.php`, com sessões, verificação de senha e controlo de acesso.
- **Proteção de dados:** consulte `privacidade.php` e o arquivo `.gitignore`.

## 3. Instalação local

Os passos completos estão no `README.md` da raiz. O código de conexão efetivo não é versionado; copie `includes/conexao.exemplo.php` para `includes/conexao.php` e configure o ambiente local. Importe `database/estrutura_pad.sql` para criar as duas tabelas utilizadas pelo sistema atual.

## 4. Limites da versão de referência

O ZIP fornecido para esta publicação não continha um dump SQL completo. O arquivo `database/estrutura_pad.sql` foi elaborado a partir dos campos efetivamente consultados no código atual e é **um esquema de instalação**, não um backup fiel de todas as tabelas históricas.

A funcionalidade antiga de avaliações foi descontinuada. O código de retirada legada está preservado para consulta técnica, mas não deve ser interpretado como prova de funcionamento da retirada sem a tabela histórica correspondente.

As estatísticas de países refletem seleções voluntárias, não visitas únicas nem benefícios comprovados.
