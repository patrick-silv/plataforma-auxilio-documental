# Notas técnicas e decisões de segurança

## Separação entre desenvolvimento e produção

O projeto foi desenvolvido localmente com PHP, XAMPP e MySQL; o website publicado utiliza infraestrutura e credenciais próprias da ValueHost. A cópia destinada ao GitHub não deve ser usada para substituir diretamente a instalação de produção.

## Arquivos excluídos

- `includes/conexao.php`: arquivo configurável de ligação que poderá conter credenciais locais ou de produção. Publica-se apenas `includes/conexao.exemplo.php`.
- `teste_conexao.php`: arquivo destinado a diagnóstico, desnecessário à revisão académica.
- Dumps, backups e dados reais do banco, que não fazem parte do código-fonte de referência.

## SQL incluído

`database/estrutura_pad.sql` disponibiliza uma estrutura inicial das tabelas `pad_admins` e `pad_participacoes_paises`, com base nas consultas presentes nos arquivos `admin.php` e `avaliar.php`. Não contém registos reais ou senhas.

## Compatibilidade do módulo legado

`avaliacoes.php` redireciona para `avaliar.php`. O arquivo `retirar_avaliacao.php` permanece como rotina de retirada de registos históricos e depende da tabela antiga `avaliacoes`. A definição integral dessa tabela não estava disponível no ZIP e não foi inventada.

## Alterações mínimas na cópia académica

Foram removidos apenas espaços em branco anteriores à abertura `<?php` de determinados arquivos PHP para evitar saída antes de cabeçalhos HTTP, quando aplicável. O conteúdo funcional das páginas foi mantido.

## Verificações

Uma verificação de sintaxe `php -l` é útil para identificar erros estruturais no código, mas não substitui testes de integração do MySQL, de interface, de segurança e de funcionalidades no servidor.
