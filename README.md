# Plataforma de Auxílio Documental (PAD)

**Projeto de Extensão Universitária | Engenharia de Software | UNIGRAN Europa**

A Plataforma de Auxílio Documental (PAD) é uma aplicação web desenvolvida no âmbito das atividades extensionistas do curso de Engenharia de Software da UNIGRAN Europa.

O projeto tem como finalidade facilitar o acesso a informações sobre documentação e serviços públicos em Portugal, especialmente para imigrantes e outras pessoas que necessitam de orientação documental.

**Site publicado:** https://auxiliodocumental.biz

**Autor:** Patrick Oliveira da Silva

---

## 1. Sobre o projeto

A PAD surgiu da identificação de dificuldades enfrentadas por pessoas que procuram informações sobre documentos e procedimentos administrativos em Portugal.

Embora essas informações estejam disponíveis em organismos oficiais, nem sempre são apresentadas de maneira simples para quem desconhece os procedimentos.

A plataforma procura contribuir para a redução dessas dificuldades, disponibilizando guias organizados, requisitos documentais, listas de verificação e encaminhamento para fontes oficiais.

Trata-se de um projeto académico independente, gratuito e informativo. A PAD não emite documentos, não realiza agendamentos e não substitui os organismos oficiais competentes.

## 2. Objetivos

**Objetivo geral**

Desenvolver uma plataforma web informativa que facilite o acesso e a compreensão de informações documentais necessárias à vida em Portugal.

**Objetivos específicos**

- Organizar informações públicas sobre documentação.
- Disponibilizar orientações claras e acessíveis.
- Facilitar a preparação de documentos para procedimentos administrativos.
- Apresentar checklists para apoiar os utilizadores.
- Encaminhar os visitantes para fontes oficiais.
- Aplicar conhecimentos de Engenharia de Software na resolução de uma necessidade social.

## 3. Funcionalidades

A plataforma disponibiliza:

- Página inicial com apresentação interativa.
- Catálogo com seis temas documentais.
- Guias informativos organizados por assunto.
- Checklists para preparação da documentação.
- Referências e encaminhamentos para fontes oficiais.
- Perguntas frequentes.
- Informações institucionais sobre o projeto.
- Política de privacidade.
- Participação voluntária por país de nacionalidade.
- Ranking de participações agregadas por país.
- Painel administrativo protegido por autenticação.

### Documentos abordados

| Documento ou serviço | Finalidade |
|---|---|
| NIF | Identificação fiscal |
| NISS | Identificação na Segurança Social |
| Número de Utente | Identificação no sistema público de saúde |
| Centro de Saúde | Informações sobre inscrição e acesso aos serviços |
| Comprovativo de Morada | Orientações sobre comprovativos de endereço |
| Autorização de Residência | Informações gerais sobre documentação de residência |

Os requisitos e procedimentos devem ser sempre confirmados junto dos organismos oficiais.

## 4. Tecnologias utilizadas

| Tecnologia | Utilização |
|---|---|
| PHP | Desenvolvimento das funcionalidades no servidor |
| MySQL/MariaDB | Banco de dados relacional |
| MySQLi | Ligação e operações com o banco de dados |
| HTML5 | Estrutura das interfaces |
| CSS3 | Estilização e apresentação visual |
| JavaScript | Interatividade e comportamento da interface |
| XAMPP | Ambiente de desenvolvimento local |
| phpMyAdmin | Administração do banco de dados |
| Git | Controlo de versões |
| GitHub | Repositório do código-fonte |
| ValueHost | Hospedagem da aplicação online |

## 5. Estrutura do projeto

O código-fonte encontra-se organizado em diretórios e arquivos com responsabilidades específicas.

| Arquivo ou pasta | Responsabilidade |
|---|---|
| `index.php` | Página de apresentação da plataforma |
| `inicio.php` | Página interna inicial |
| `documentacao.php` | Catálogo documental |
| `documento.php` | Apresentação dos guias |
| `avaliar.php` | Participação voluntária por nacionalidade |
| `admin.php` | Painel administrativo |
| `sobre.php` | Informações sobre o projeto |
| `faq.php` | Perguntas frequentes |
| `privacidade.php` | Política de privacidade |
| `css/` | Estilos da plataforma |
| `js/` | Scripts JavaScript |
| `img/` | Recursos visuais |
| `includes/` | Componentes reutilizáveis, configurações e dados documentais |
| `docs/` | Documentação técnica e académica |
| `database/` | Estrutura demonstrativa do banco de dados, a disponibilizar |

## 6. Pré-requisitos

Para executar a plataforma localmente, são necessários:

- XAMPP com Apache e MySQL/MariaDB.
- PHP 8.x com extensão MySQLi.
- Navegador web atualizado.
- Código-fonte deste repositório.

O ambiente de desenvolvimento utilizado foi o Windows com XAMPP.

## 7. Obter o código-fonte

O repositório pode ser clonado através do Git:

```bash
git clone https://github.com/patrick-silv/plataforma-auxilio-documental.git
```

Também é possível descarregar os arquivos através da opção **Code > Download ZIP**, desde que o utilizador tenha acesso ao repositório.

## 8. Instalação e execução local

**1. Preparar os arquivos**

Copie o conteúdo do projeto para:

```text
C:\xampp\htdocs\plataforma_auxilio_documental
```

**2. Iniciar os serviços**

Abra o painel do XAMPP e inicie:

- Apache
- MySQL

**3. Preparar o banco de dados**

Aceda a:

```text
http://localhost/phpmyadmin
```

O banco utilizado pela PAD chama-se `pad_plataforma`.

A instalação completa requer a importação da estrutura SQL das tabelas utilizadas pelo sistema. O script demonstrativo, sem dados reais, será acrescentado à documentação do repositório.

**4. Configurar a conexão**

Na pasta `includes`, copie:

```text
conexao.exemplo.php
```

Crie uma cópia com o nome:

```text
conexao.php
```

O arquivo de exemplo contém configurações para desenvolvimento local. Caso necessário, ajuste os dados de acesso ao MySQL no arquivo copiado.

O arquivo `includes/conexao.php` não é versionado, para impedir a publicação de credenciais privadas.

**5. Abrir a plataforma**

No navegador, aceda a:

```text
http://localhost/plataforma_auxilio_documental/
```

Depois de configurar o banco de dados, as funcionalidades poderão ser verificadas localmente.

## 9. Banco de dados

As funcionalidades atuais de participação e administração utilizam principalmente duas tabelas.

**`pad_admins`**

Armazena informações necessárias à autenticação administrativa, incluindo identificador, e-mail e hash da senha.

**`pad_participacoes_paises`**

Armazena contagens agregadas das seleções voluntárias de nacionalidade.

A versão académica não deve incluir senhas reais, contas administrativas de produção nem dados pessoais provenientes da hospedagem.

O projeto também conserva alguns arquivos relacionados com um módulo histórico de avaliações, entretanto descontinuado.

## 10. Segurança e privacidade

Durante o desenvolvimento foram implementados mecanismos como:

- Autenticação administrativa.
- Armazenamento de senhas através de hash.
- Utilização de sessões PHP.
- Proteção CSRF em operações relevantes.
- Consultas preparadas ao banco de dados.
- Restrições de acesso HTTP a arquivos sensíveis.
- Separação entre configurações locais e credenciais de produção.
- Utilização de HTTPS na versão publicada.

A participação por nacionalidade é voluntária e apresenta resultados agregados. As contagens não representam necessariamente visitantes únicos nem comprovam a realização de procedimentos documentais.

A utilização de cookies de sessão e os registos técnicos do servidor também devem ser considerados no tratamento de dados.

## 11. Demonstração online

A versão publicada pode ser consultada através do endereço:

**https://auxiliodocumental.biz**

O website permite observar a apresentação visual, os guias documentais, os checklists e os recursos informativos.

O acesso à área administrativa é reservado a utilizadores autorizados.

## 12. Documentação complementar

O repositório contém documentação adicional para apoiar a avaliação académica.

- `docs/GUIA_PROFESSOR.md`: orientações para consulta do projeto.
- `docs/NOTAS_TECNICAS.md`: decisões técnicas, segurança e limitações da versão disponibilizada.

## 13. Contribuição académica e social

O desenvolvimento da PAD permitiu aplicar conhecimentos de Engenharia de Software em atividades como levantamento de necessidades, organização de requisitos, desenvolvimento de interfaces, programação PHP, integração com MySQL, testes e publicação web.

A proposta também apresenta uma dimensão social, ao procurar tornar informações documentais mais acessíveis para pessoas que vivem em Portugal.

## 14. Autoria

**Patrick Oliveira da Silva**

Curso de Engenharia de Software  
UNIGRAN Europa

Projeto desenvolvido no contexto das atividades extensionistas, com finalidade académica, tecnológica e social.

---

**Plataforma de Auxílio Documental (PAD)**

*Informação clara, organizada e gratuita para quem vive em Portugal.*
