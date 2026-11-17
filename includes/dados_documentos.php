<?php
/**
 * PAD - Base editorial dos seis guias documentais.
 * Arquivo: includes/dados_documentos.php
 *
 * Mantém a estrutura utilizada por documento.php e js/script.js:
 * - grupos[tipo=perfil|complemento] e itens para a checklist;
 * - passos[titulo, texto, dica] para o procedimento;
 * - fontes[nome, url] para consulta oficial.
 *
 * A checklist é orientativa. Um item assinalado não comprova
 * elegibilidade nem substitui a avaliação da entidade pública.
 */
require_once __DIR__ . '/config.php';

$documentos = [
    // ============================================================
    // 1. NIF - NÚMERO DE IDENTIFICAÇÃO FISCAL
    // ============================================================
    'nif' => [
        'titulo' => 'NIF',
        'sigla' => 'NIF',
        'subtitulo' => 'Número de Identificação Fiscal',
        'categoria' => 'Fiscal',
        'entidade' => 'Autoridade Tributária e Aduaneira',
        'resumo' => 'Entenda para que serve o número de contribuinte, como distinguir residente e não residente fiscal, que documentos preparar e como apresentar o pedido nas Finanças.',
        'oque' => [
            'O Número de Identificação Fiscal (NIF) é um identificador de nove dígitos atribuído pela Autoridade Tributária e Aduaneira (AT). É utilizado para identificar a pessoa nas suas relações com a administração fiscal portuguesa.',
            'O NIF é utilizado em situações do dia a dia, como contratos de trabalho e arrendamento, abertura de contas bancárias, declaração de rendimentos, emissão de faturas e cumprimento de obrigações tributárias.',
            'A atribuição do NIF é diferente do reconhecimento de residência fiscal. Uma pessoa pode ter NIF português e estar registada como não residente fiscal. Se a situação mudar, os dados fiscais poderão ter de ser atualizados.',
            'O NIF não é um visto, não regulariza a permanência em Portugal e não substitui a autorização de residência. Também não deve ser confundido com o NISS, que pertence à Segurança Social.'
        ],
        'quem' => [
            'Podem pedir NIF pessoas portuguesas e estrangeiras, residentes ou não residentes, quando necessitem de se identificar perante a administração fiscal portuguesa.',
            'Quem tem Cartão de Cidadão português normalmente recebe o NIF automaticamente e não precisa de fazer um pedido independente.',
            'Para cidadãos estrangeiros, os documentos variam conforme a nacionalidade, a residência fiscal pretendida e a pessoa que apresenta o pedido.',
            'A classificação como residente fiscal deve corresponder à situação efetiva e às regras legais. Ter uma autorização de residência e ser residente fiscal não são conceitos automaticamente equivalentes.'
        ],
        'grupos' => [
            [
                'titulo' => 'País terceiro: residente fiscal', 'tipo' => 'perfil',
                'itens' => [
                    'Documento de identificação civil válido ou passaporte.',
                    'Título de residência válido OU outro comprovativo admitido pela AT para o enquadramento como residente, conforme a situação (por exemplo, determinados recibos ou comprovativos de processo pendente na AIMA).',
                    'Comprovativo da morada em Portugal, se o documento de enquadramento apresentado não indicar a morada ou se a AT o solicitar.',
                    'Dados pessoais necessários para confirmar o registo fiscal.'
                ]
            ],
            [
                'titulo' => 'País terceiro: não residente fiscal', 'tipo' => 'perfil',
                'itens' => [
                    'Documento de identificação civil válido ou passaporte; confirmar a situação do visto quando o pedido presencial for feito pelo próprio.',
                    'Comprovativo da morada no estrangeiro, quando esta não constar do documento de identificação.',
                    'Verificação das regras de indicação de representante fiscal e das eventuais dispensas legais aplicáveis à situação concreta.'
                ]
            ],
            [
                'titulo' => 'Cidadão da União Europeia: residente fiscal', 'tipo' => 'perfil',
                'itens' => [
                    'Documento nacional de identificação válido ou passaporte.',
                    'Certificado de Registo de Cidadão da União Europeia, emitido pela câmara municipal, quando exigido para o enquadramento como residente.',
                    'Elementos de morada solicitados para o registo.'
                ]
            ],
            [
                'titulo' => 'Cidadão da União Europeia: não residente fiscal', 'tipo' => 'perfil',
                'itens' => [
                    'Documento de identificação civil válido ou passaporte.',
                    'Elementos da morada no estrangeiro, quando solicitados pela AT.'
                ]
            ],
            [
                'titulo' => 'Pedido apresentado por procurador ou representante legal', 'tipo' => 'complemento',
                'itens' => [
                    'Procuração com poderes para pedir o NIF, ou outro título de representação aceite pela AT.',
                    'Documento de identificação do procurador ou representante legal.',
                    'Cópias ou originais dos documentos do requerente, conforme o canal escolhido e as instruções oficiais.'
                ]
            ],
            [
                'titulo' => 'Criança estrangeira sem passaporte', 'tipo' => 'complemento',
                'itens' => [
                    'Certidão de nascimento ou documento comprovativo do nascimento aceite pela AT.',
                    'Documentos de quem exerce a representação legal, se forem exigidos para o pedido.'
                ]
            ]
        ],
        'antes' => [
            'Confirme se já possui um NIF; cada pessoa só pode ter um número de identificação fiscal português.',
            'Identifique se o pedido deve ser feito com registo como residente ou não residente fiscal. Não escolha apenas com base em ter ou não NIF.',
            'Verifique a validade do documento de identificação e se a morada consta dos documentos apresentados.',
            'Se houver processo pendente na AIMA, consulte a FAQ da AT sobre os comprovativos admitidos para o registo fiscal como residente.',
            'Confirme as regras atuais de representação fiscal. Procurador para apresentar o pedido e representante fiscal são figuras diferentes.',
            'Consulte os canais de atendimento e faça marcação prévia quando necessária.'
        ],
        'passos' => [
            ['titulo' => 'Determine a sua situação fiscal', 'texto' => 'Identifique a nacionalidade e o enquadramento fiscal pretendido. Se ainda não reúne condições para ser registado como residente fiscal, consulte o procedimento para não residentes.', 'dica' => 'A autorização de residência e a residência fiscal têm finalidades diferentes.'],
            ['titulo' => 'Confira os documentos do seu perfil', 'texto' => 'Consulte as exigências para UE ou país terceiro e para residente ou não residente. Caso tenha processo na AIMA, verifique se a AT aceita o comprovativo do seu procedimento.', 'dica' => 'Não apresente um comprovativo como universalmente aceite; confirme a alternativa exata.'],
            ['titulo' => 'Escolha como apresentar o pedido', 'texto' => 'A própria pessoa pode recorrer ao atendimento presencial com marcação. Um procurador ou representante legal pode utilizar o e-balcão quando o canal estiver disponível para o seu caso.', 'dica' => 'O pedido eletrónico por procurador não significa que todos possam solicitar NIF online sem representação.'],
            ['titulo' => 'Efetue a marcação, se aplicável', 'texto' => 'Siga as opções de marcação da AT ou utilize o Centro de Atendimento Telefónico das Finanças, pelo número 217 206 707, confirmando o horário no site oficial.', 'dica' => 'Guarde os dados da marcação e o local do atendimento.'],
            ['titulo' => 'Apresente o pedido à AT', 'texto' => 'Forneça os dados de identificação, a morada e os documentos do perfil aplicável. Caso exista um representante, apresente também os comprovativos dos respetivos poderes.', 'dica' => 'Se houver uma exigência documental adicional, solicite indicação do fundamento e do documento esperado.'],
            ['titulo' => 'Confirme o registo efetuado', 'texto' => 'Após a atribuição, confira os nove dígitos, o nome e a morada ou enquadramento fiscal. Guarde o comprovativo obtido.', 'dica' => 'Depois de mudar efetivamente a residência fiscal, informe-se sobre a atualização da morada junto da AT.']
        ],
        'onde' => 'Presencialmente, mediante marcação, nos Serviços de Finanças ou balcões habilitados. Por procurador ou representante legal, quando aplicável, através do e-balcão do Portal das Finanças. Confirme o canal na AT.',
        'custo' => 'A atribuição do NIF pela Autoridade Tributária é gratuita. Serviços privados de intermediação podem cobrar honorários que não são uma taxa pública.',
        'alertas' => [
            'O NIF não concede visto, autorização de residência nem direito de permanência em Portugal.',
            'A página geral do gov.pt e as FAQ específicas da AT apresentam regras que exigem leitura conjunta quanto à representação fiscal. Confirme com a AT a exigência ou dispensa aplicável ao seu país de residência e às suas obrigações fiscais.',
            'A AT distingue representante fiscal, que tem funções fiscais próprias, de procurador ou representante legal habilitado a apresentar o pedido.',
            'Para determinados processos pendentes na AIMA, a AT admite documentos específicos de agendamento ou recibo para o registo fiscal como residente. A aceitação depende da situação e dos comprovativos apresentados.',
            'Existe um serviço conjunto para obter NIF, NISS e número de utente em determinados Espaços Cidadão, mas exige condições próprias e não está disponível para todas as pessoas.',
            'Se a morada fiscal mudar, confirme a obrigação e o prazo de comunicação à AT.'
        ],
        'fontes' => [
            ['nome' => 'gov.pt: Pedir NIF', 'url' => 'https://www.gov.pt/servicos/pedir-o-numero-de-identificacao-fiscal-para-pessoa-singular'],
            ['nome' => 'AT: NIF e canais de atendimento', 'url' => 'https://info.portaldasfinancas.gov.pt/pt/apoio_ao_contribuinte/Cidadaos/Dados_pessoais_familia/Dados_pessoais/NIF/Paginas/default.aspx'],
            ['nome' => 'AT: FAQ de atribuição e alteração de NIF', 'url' => 'https://info.portaldasfinancas.gov.pt/pt/apoio_contribuinte/questoes_frequentes/pages/faqs-00299.aspx'],
            ['nome' => 'AT: Representação fiscal', 'url' => 'https://info.portaldasfinancas.gov.pt/pt/apoio_ao_contribuinte/Cidadaos/Dados_pessoais_familia/Dados_pessoais/Representacao/Paginas/default.aspx'],
            ['nome' => 'gov.pt: Serviço conjunto de NIF, NISS e SNS', 'url' => 'https://www.gov.pt/servicos/pedir-os-numeros-de-identificacao-fiscal-seguranca-social-e-nacional-de-utente-saude-para-estrangeiros']
        ]
    ],

    // ============================================================
    // 2. NISS - NÚMERO DE IDENTIFICAÇÃO DA SEGURANÇA SOCIAL
    // ============================================================
    'niss' => [
        'titulo' => 'NISS',
        'sigla' => 'NISS',
        'subtitulo' => 'Número de Identificação da Segurança Social',
        'categoria' => 'Segurança Social',
        'entidade' => 'Instituto da Segurança Social',
        'resumo' => 'Veja como pedir o NISS online, que comprovativos de identificação, trabalho e residência apresentar e como obter o número após o pedido.',
        'oque' => [
            'O NISS identifica a pessoa nos sistemas da Segurança Social portuguesa. É utilizado para relacionar a pessoa com contribuições, vínculos de trabalho e direitos ou obrigações do sistema.',
            'O número pode ser necessário em relações laborais e no exercício de atividade independente. A atribuição do NISS, por si só, não prova que todas as contribuições estejam regularizadas.',
            'Ter NISS não garante automaticamente prestações sociais, subsídios ou outros apoios. Cada benefício tem requisitos próprios, como contribuições, prazos ou condições pessoais.',
            'O NISS é diferente do NIF: o primeiro pertence à Segurança Social; o segundo identifica a pessoa perante a Autoridade Tributária.'
        ],
        'quem' => [
            'Podem pedir NISS pessoas estrangeiras que ainda não tenham este número e pessoas portuguesas com bilhete de identidade vitalício.',
            'Um representante legal pode apresentar o pedido em nome de uma pessoa estrangeira, cumprindo os requisitos de representação.',
            'A entidade empregadora também pode pedir o NISS de quem está a contratar, desde que cumpra as condições oficiais de contratação e comunicação do vínculo.',
            'Pessoas portuguesas com Cartão de Cidadão normalmente recebem o NISS automaticamente, sem precisarem de fazer um pedido específico.'
        ],
        'grupos' => [
            [
                'titulo' => 'Cidadão da UE, EEE ou Suíça', 'tipo' => 'perfil',
                'itens' => [
                    'Um documento de identificação válido aceite pelo serviço: documento civil do país de origem, passaporte OU cartão de residência.',
                    'Digitalização legível, dentro da validade, do documento de identificação escolhido.'
                ]
            ],
            [
                'titulo' => 'Cidadão de país terceiro', 'tipo' => 'perfil',
                'itens' => [
                    'Passaporte válido.',
                    'Visto de trabalho, conforme a lista oficial de identificação para esta situação.',
                    'Autorização de residência temporária ou permanente OU outro documento civil de identificação aceite nas alternativas oficiais.'
                ]
            ],
            [
                'titulo' => 'Proteção internacional e situações especiais', 'tipo' => 'perfil',
                'itens' => [
                    'Um dos comprovativos admitidos para o seu enquadramento: autorização de residência provisória, recibo de pedido ou renovação, título de refugiado ou proteção subsidiária, recibo respetivo OU declaração de proteção internacional.',
                    'Documento de identificação adicional, caso seja solicitado para confirmação dos dados.'
                ]
            ],
            [
                'titulo' => 'Comprovativo da situação profissional', 'tipo' => 'complemento',
                'itens' => [
                    'Um comprovativo admitido para o motivo do pedido: contrato de trabalho; início de atividade com recibos/faturas; certidão de registo de sociedade; certidão permanente comercial; contrato com empregador estrangeiro em caso de nómada digital; OU comprovativo de Seguro Social Voluntário.',
                    'Correspondência entre o motivo indicado no formulário e o documento apresentado.'
                ]
            ],
            [
                'titulo' => 'Comprovativo de pedido ou situação de residência', 'tipo' => 'complemento',
                'itens' => [
                    'Um comprovativo admitido para a sua situação: pedido de autorização de residência, pedido de visto de residência CPLP OU pedido de certificado de concessão de autorização de residência CPLP.',
                    'Documentação de residência adicional se o serviço a solicitar para esclarecer o seu enquadramento.'
                ]
            ],
            [
                'titulo' => 'Pedido por representante legal', 'tipo' => 'complemento',
                'itens' => [
                    'Procuração ou Declaração de Autorização a Terceiros (modelo PA-12), conforme exigido.',
                    'Documento de identificação válido do representante.'
                ]
            ],
            [
                'titulo' => 'Pedido apresentado pelo empregador', 'tipo' => 'complemento',
                'itens' => [
                    'Contrato de trabalho celebrado com o trabalhador.',
                    'Comunicação do vínculo de trabalho na Segurança Social Direta.',
                    'Identificação e documentação de representação necessárias ao pedido.'
                ]
            ]
        ],
        'antes' => [
            'Confirme que ainda não tem NISS. Não apresente um novo pedido se já existir um número atribuído.',
            'Identifique o motivo do pedido: trabalho por conta de outrem, atividade independente, sociedade ou outro enquadramento previsto.',
            'Prepare ficheiros digitais nítidos e dentro da validade; confirme que o formulário aceita o formato e tamanho dos anexos.',
            'A documentação é composta por categorias diferentes: identificação, motivo do pedido e situação de residência. Uma categoria não substitui automaticamente outra.',
            'Se o empregador apresentar o pedido, confirme que houve celebração do contrato e comunicação do vínculo, conforme as orientações oficiais.'
        ],
        'passos' => [
            ['titulo' => 'Abra o serviço oficial', 'texto' => 'Entre na página de atribuição de NISS no gov.pt e aceda ao formulário da Segurança Social disponibilizado para a sua situação.', 'dica' => 'Evite intermediários que se apresentem como um portal público sem o serem.'],
            ['titulo' => 'Preencha a identificação', 'texto' => 'Indique os dados pedidos, como nome, nacionalidade, identificação e contactos, sem divergências em relação aos documentos.', 'dica' => 'Confirme a grafia de cada nome, datas e número do documento.'],
            ['titulo' => 'Indique a razão do pedido', 'texto' => 'Selecione o motivo correspondente à sua situação de trabalho ou outro fundamento aceite. Prepare o documento que comprova esse motivo.', 'dica' => 'Contrato de trabalho e atividade independente requerem comprovativos diferentes.'],
            ['titulo' => 'Anexe os comprovativos', 'texto' => 'Carregue a identificação e os documentos de situação profissional e residência aplicáveis. Se uma opção disser OU, apresente a alternativa que corresponde ao seu caso.', 'dica' => 'Abra os anexos antes de enviar e confirme que estão completos e legíveis.'],
            ['titulo' => 'Submeta o formulário', 'texto' => 'Revise as informações e conclua o envio. Conserve as mensagens e referências disponibilizadas pelo serviço.', 'dica' => 'Evite vários pedidos idênticos sem confirmar o estado do primeiro.'],
            ['titulo' => 'Acompanhe a comunicação da Segurança Social', 'texto' => 'Siga as instruções recebidas. O guia oficial para estrangeiros descreve comunicação por carta registada para levantamento do NISS, quando aplicável.', 'dica' => 'Verifique a correspondência e os canais oficiais de acompanhamento.'],
            ['titulo' => 'Obtenha e confira o NISS', 'texto' => 'Quando o serviço indicar levantamento ou validação presencial, leve a identificação exigida. A marcação poderá ser realizada pelos canais oficiais, incluindo a plataforma SIGA.', 'dica' => 'Guarde o comprovativo; o NISS não substitui o NIF nem a autorização de residência.']
        ],
        'onde' => 'O pedido é efetuado online no serviço oficial da Segurança Social. Quando houver levantamento ou validação presencial, siga a comunicação recebida e os canais de atendimento ou marcação indicados.',
        'custo' => 'O pedido de atribuição do NISS é gratuito.',
        'alertas' => [
            'Não confunda as alternativas indicadas com OU com uma exigência de possuir todos os documentos enumerados.',
            'A lista da Segurança Social distingue comprovativos de identificação, de motivo profissional e da situação de residência. Selecione os complementos aplicáveis na checklist.',
            'No pedido pelo empregador, a celebração do contrato e a comunicação do vínculo são condições relevantes; pedir o NISS não dispensa as demais obrigações laborais.',
            'O NISS não é autorização de residência nem confere automaticamente direito a subsídios ou prestações.',
            'A comunicação de atribuição e a modalidade de levantamento devem ser confirmadas no serviço oficial, pois podem depender do canal e do processo.',
            'O serviço conjunto de NIF, NISS e número de utente só está disponível para situações e locais especificados no gov.pt.'
        ],
        'fontes' => [
            ['nome' => 'gov.pt: Pedir NISS', 'url' => 'https://www.gov.pt/servicos/pedir-o-numero-de-identificacao-da-seguranca-social-niss-'],
            ['nome' => 'gov.pt: Guia NIF e NISS para estrangeiros', 'url' => 'https://www.gov.pt/guias/como-pedir-o-nif-e-o-niss-para-pessoas-estrangeiras-em-portugal'],
            ['nome' => 'Segurança Social: Portal oficial', 'url' => 'https://www.seg-social.pt/'],
            ['nome' => 'gov.pt: Serviço conjunto de NIF, NISS e SNS', 'url' => 'https://www.gov.pt/servicos/pedir-os-numeros-de-identificacao-fiscal-seguranca-social-e-nacional-de-utente-saude-para-estrangeiros']
        ]
    ],

    // ============================================================
    // 3. NÚMERO NACIONAL DE UTENTE
    // ============================================================
    'utente' => [
        'titulo' => 'Número de Utente',
        'sigla' => 'SNS',
        'subtitulo' => 'Número Nacional de Utente do Serviço Nacional de Saúde',
        'categoria' => 'Saúde',
        'entidade' => 'Serviço Nacional de Saúde',
        'resumo' => 'Entenda como é criado o número nacional de utente, em que situação deve procurar uma unidade pública e por que razão o número não garante cobertura de despesas.',
        'oque' => [
            'O Número Nacional de Utente identifica a pessoa nos registos do Serviço Nacional de Saúde (SNS) e permite associar atendimentos e informação administrativa à pessoa certa.',
            'Para uma pessoa estrangeira, o número pode ser atribuído na primeira utilização dos serviços de uma unidade pública do SNS, como um centro de saúde ou hospital.',
            'A atribuição do número não é o mesmo que a inscrição nos cuidados de saúde primários, a atribuição de médico de família ou a determinação de quem suporta as despesas dos cuidados.',
            'Ter número de utente não garante, por si só, que todas as despesas de saúde serão suportadas pelo SNS. O enquadramento e os documentos para cobertura devem ser avaliados separadamente.'
        ],
        'quem' => [
            'Pessoas estrangeiras que ainda não tenham número nacional de utente e procurem pela primeira vez serviços de uma unidade pública do SNS.',
            'Pessoas com Cartão de Cidadão português recebem normalmente o número de utente automaticamente, indicado no próprio cartão.',
            'Quem já tem número de utente não deve pedir outro número: deve apresentar ou recuperar os dados do registo existente.',
            'A necessidade de cuidados urgentes e a determinação da cobertura das despesas não devem ser confundidas com o simples registo administrativo.'
        ],
        'grupos' => [
            [
                'titulo' => 'Primeiro registo de pessoa estrangeira', 'tipo' => 'perfil',
                'itens' => [
                    'Dados pessoais de identificação, incluindo nome completo e data de nascimento.',
                    'Documento de identificação, quando disponível ou solicitado pela unidade de saúde.',
                    'Elementos de morada e contacto solicitados para criar o registo.'
                ]
            ],
            [
                'titulo' => 'Completar o registo e esclarecer cobertura de despesas', 'tipo' => 'complemento',
                'itens' => [
                    'Documento de identificação atualizado.',
                    'NIF português, quando necessário para completar o registo.',
                    'Morada completa em Portugal e respetiva prova, se solicitada.',
                    'Autorização de residência ou documento relativo ao enquadramento legal aplicável, quando exigido para apreciar a cobertura.',
                    'Outros comprovativos de situações legalmente previstas, quando aplicáveis.'
                ]
            ]
        ],
        'antes' => [
            'Confirme se já tem número de utente, por exemplo em documentação de atendimentos anteriores.',
            'Identifique uma unidade pública do SNS, como centro de saúde ou hospital.',
            'Leve os dados e documentos de identificação de que dispõe e informe eventuais dificuldades de apresentação.',
            'Se procura também inscrição num centro de saúde, consulte o guia específico, porque são procedimentos relacionados mas distintos.',
            'Se necessita de cuidados urgentes, não adie a procura de assistência para completar esta checklist.'
        ],
        'passos' => [
            ['titulo' => 'Procure uma unidade do SNS', 'texto' => 'Dirija-se a uma unidade pública quando necessitar de utilizar os seus serviços. Segundo o gov.pt, o número de utente pode ser atribuído à pessoa estrangeira na primeira utilização.', 'dica' => 'Centro de saúde e hospital são exemplos de unidades públicas.'],
            ['titulo' => 'Informe que ainda não tem número', 'texto' => 'No atendimento administrativo, explique que não tem número nacional de utente e que necessita de criar o registo.', 'dica' => 'Se já teve atendimento no SNS, peça primeiro para verificar se existe registo anterior.'],
            ['titulo' => 'Confirme os dados de identificação', 'texto' => 'Forneça os elementos solicitados, como nome, nascimento e documento disponível, e verifique se estão corretamente registados.', 'dica' => 'Uma grafia incorreta pode dificultar a identificação em atendimentos futuros.'],
            ['titulo' => 'Esclareça a cobertura de cuidados', 'texto' => 'Pergunte quais documentos serão necessários para completar o registo e avaliar a cobertura das despesas de saúde no seu caso.', 'dica' => 'Número atribuído e cobertura financeira são assuntos diferentes.'],
            ['titulo' => 'Guarde os dados do registo', 'texto' => 'Depois de confirmado o número, conserve-o para futuras marcações e contactos com os serviços públicos de saúde.', 'dica' => 'Não publique o seu número de utente nem outros identificadores em comentários públicos.'],
            ['titulo' => 'Se necessário, trate da inscrição no centro de saúde', 'texto' => 'Se pretende cuidados de saúde primários regulares, informe-se sobre a inscrição no centro de saúde da área onde reside.', 'dica' => 'A inscrição não garante a atribuição imediata de médico de família.']
        ],
        'onde' => 'Nas unidades públicas do SNS, nomeadamente centros de saúde e hospitais, no contexto de utilização e registo dos serviços.',
        'custo' => 'A atribuição do número nacional de utente é gratuita. A cobertura ou cobrança de cuidados de saúde depende das regras aplicáveis à pessoa e ao serviço.',
        'alertas' => [
            'Número de utente, inscrição num centro de saúde e médico de família não são a mesma coisa.',
            'A atribuição do número não garante automaticamente a cobertura financeira de todos os cuidados.',
            'A documentação que permite completar o registo ou apurar a cobertura pode ser diferente da necessária à atribuição inicial.',
            'Em situações de urgência médica, procure assistência adequada e utilize os canais de emergência pertinentes; não dependa deste guia para uma decisão clínica.',
            'A PAD não recolhe documentos de identificação ou dados de saúde.'
        ],
        'fontes' => [
            ['nome' => 'gov.pt: Obter número nacional de utente do SNS', 'url' => 'https://www.gov.pt/servicos/pedir-o-numero-de-utente-do-sns'],
            ['nome' => 'gov.pt: Cuidados de saúde para migrantes', 'url' => 'https://www.gov.pt/guias/migrantes-cuidados-de-saude-em-portugal'],
            ['nome' => 'gov.pt: Inscrever-se no centro de saúde', 'url' => 'https://www.gov.pt/servicos/inscrever-se-no-centro-de-saude']
        ]
    ],

    // ============================================================
    // 4. CENTRO DE SAÚDE
    // ============================================================
    'centro-saude' => [
        'titulo' => 'Centro de Saúde',
        'sigla' => 'CS',
        'subtitulo' => 'Inscrição nos cuidados de saúde primários',
        'categoria' => 'Saúde',
        'entidade' => 'Serviço Nacional de Saúde',
        'resumo' => 'Saiba como solicitar a inscrição num centro de saúde, que documentos apresentar, como tratar do número de utente e que serviços podem estar disponíveis.',
        'oque' => [
            'A inscrição num centro de saúde associa a pessoa a uma unidade de cuidados de saúde primários, utilizada para acompanhamento e acesso a serviços de proximidade.',
            'Conforme a organização da unidade, os centros de saúde podem disponibilizar consultas, enfermagem, vacinação e outros cuidados, bem como orientações sobre programas preventivos.',
            'A inscrição no centro de saúde não significa atribuição imediata de médico de família. A disponibilidade depende da organização e da capacidade da unidade.',
            'O número de utente identifica a pessoa no SNS; a inscrição num centro de saúde estabelece a ligação administrativa a uma unidade. São procedimentos relacionados mas não idênticos.'
        ],
        'quem' => [
            'O serviço geral publicado no gov.pt prevê inscrição de pessoas de nacionalidade portuguesa e de pessoas estrangeiras com autorização de residência em Portugal.',
            'Quem já tem número de utente pode apresentá-lo no centro de saúde. Quem ainda não tem pode solicitar a sua atribuição no contexto da inscrição, segundo o serviço oficial.',
            'Outras situações de acesso a cuidados de saúde devem ser esclarecidas na unidade do SNS, pois as regras de acesso e a inscrição administrativa podem diferir.',
            'A escolha da unidade deve ter em conta a morada de residência; o gov.pt recomenda dar preferência ao centro de saúde da área onde se reside.'
        ],
        'grupos' => [
            [
                'titulo' => 'Pessoa estrangeira com autorização de residência', 'tipo' => 'perfil',
                'itens' => [
                    'Autorização de residência para registo do número e validade do documento.',
                    'Dados de identificação civil.',
                    'Número de Identificação Fiscal (NIF).',
                    'Morada de residência permanente em Portugal.',
                    'Número nacional de utente, se já estiver atribuído.'
                ]
            ],
            [
                'titulo' => 'Pessoa com nacionalidade portuguesa', 'tipo' => 'perfil',
                'itens' => [
                    'Cartão de Cidadão.',
                    'Morada da residência para indicação à unidade.',
                    'Número de utente, caso seja necessário confirmar o registo.'
                ]
            ],
            [
                'titulo' => 'Benefícios e isenções de saúde', 'tipo' => 'complemento',
                'itens' => [
                    'Comprovativo de benefício ou isenção de saúde a que tenha direito, caso se aplique à sua situação.'
                ]
            ]
        ],
        'antes' => [
            'Identifique o centro de saúde da área onde reside e confirme o local de atendimento administrativo.',
            'Confirme se já dispõe de número nacional de utente; se não tiver, informe essa situação no atendimento.',
            'Organize identificação, NIF, documentos de residência e morada aplicáveis.',
            'Pergunte se existe alguma organização específica para atendimento administrativo ou horários de inscrição.',
            'Não presuma que a inscrição implica médico de família atribuído no mesmo momento.'
        ],
        'passos' => [
            ['titulo' => 'Identifique o centro de saúde', 'texto' => 'Procure uma unidade, preferencialmente na sua área de residência. Se não souber a unidade de referência, contacte os canais oficiais do SNS para obter orientação.', 'dica' => 'O serviço de inscrição é apresentado no gov.pt como presencial.'],
            ['titulo' => 'Prepare identificação e comprovativos', 'texto' => 'Reúna os documentos do seu perfil. Para estrangeiros, o serviço oficial menciona autorização de residência, NIF, identificação civil, morada e benefícios aplicáveis.', 'dica' => 'Leve os documentos disponíveis e esclareça diretamente qualquer situação especial.'],
            ['titulo' => 'Dirija-se ao atendimento administrativo', 'texto' => 'Indique que pretende inscrever-se nos cuidados de saúde primários e apresente o número nacional de utente, caso o possua.', 'dica' => 'Se não tem número, pergunte pela atribuição durante a inscrição.'],
            ['titulo' => 'Confirme os dados do registo', 'texto' => 'Verifique nome, identificação, número de utente, contactos e morada associados à inscrição.', 'dica' => 'Mantenha o contacto atualizado para receber comunicações.'],
            ['titulo' => 'Informe-se sobre os serviços disponíveis', 'texto' => 'Pergunte como marcar consultas, solicitar cuidados de enfermagem e obter orientação sobre médico de família.', 'dica' => 'A atribuição de médico de família pode não ser imediata.'],
            ['titulo' => 'Guarde a informação da unidade', 'texto' => 'Anote os canais de contacto e os procedimentos de marcação divulgados pelo centro de saúde.', 'dica' => 'Para urgências ou situações agudas, procure os canais de assistência adequados ao caso.']
        ],
        'onde' => 'Presencialmente num centro de saúde do SNS, preferencialmente na área de residência. Em caso de dúvida sobre a unidade, consulte os canais oficiais do SNS.',
        'custo' => 'A inscrição no centro de saúde é gratuita. A cobertura de determinados cuidados segue regras próprias.',
        'alertas' => [
            'Não há garantia de atribuição imediata de médico de família.',
            'O registo do número de utente pode ser feito no contexto da inscrição, quando ainda não existe um número atribuído.',
            'As regras do serviço geral para estrangeiros mencionam autorização de residência; situações diferentes devem ser esclarecidas diretamente com o SNS.',
            'Comprovativos de benefícios ou isenções apenas se aplicam a quem tem direito a essas condições.',
            'O acesso a cuidados urgentes não deve ser confundido com a inscrição administrativa no centro de saúde.'
        ],
        'fontes' => [
            ['nome' => 'gov.pt: Inscrever-se no centro de saúde', 'url' => 'https://www.gov.pt/servicos/inscrever-se-no-centro-de-saude'],
            ['nome' => 'gov.pt: Número nacional de utente', 'url' => 'https://www.gov.pt/servicos/pedir-o-numero-de-utente-do-sns'],
            ['nome' => 'SNS 24: Portal oficial', 'url' => 'https://www.sns24.gov.pt/']
        ]
    ],

    // ============================================================
    // 5. COMPROVATIVO DE MORADA
    // ============================================================
    'morada' => [
        'titulo' => 'Comprovativo de Morada',
        'sigla' => 'MOR',
        'subtitulo' => 'Certidão de Domicílio Fiscal e provas de alojamento',
        'categoria' => 'Morada',
        'entidade' => 'Autoridade Tributária e outras entidades competentes',
        'resumo' => 'Distinga a Certidão de Domicílio Fiscal das provas de alojamento exigidas pela AIMA e saiba que comprovativo preparar para a finalidade concreta.',
        'oque' => [
            'Comprovativo de morada é uma designação geral para documentos usados para demonstrar uma morada. Não existe um único comprovativo aceite obrigatoriamente por todas as entidades.',
            'A Certidão de Domicílio Fiscal é emitida pela Autoridade Tributária e comprova a morada que consta do registo fiscal da pessoa. Não demonstra, por si só, em todos os procedimentos, o direito de utilização de um imóvel.',
            'Perante a AIMA, pode ser necessário comprovar o alojamento e o fundamento jurídico pelo qual a pessoa ocupa a habitação: propriedade, arrendamento, comodato ou outra situação admitida.',
            'Antes de pedir qualquer comprovativo, identifique quem o solicita e qual a finalidade. Uma instituição bancária, a AT e a AIMA podem exigir provas diferentes.'
        ],
        'quem' => [
            'Quem tem NIF e autenticação no Portal das Finanças pode solicitar a Certidão de Domicílio Fiscal, desde que os respetivos dados estejam corretamente registados.',
            'Quem está a preparar um procedimento na AIMA pode precisar de declaração de alojamento e prova da ocupação do imóvel, de acordo com o caso concreto.',
            'Quem necessita de comprovar morada perante banco, empregador ou outro organismo deve confirmar previamente o tipo de documento e a data de emissão aceites.',
            'Se a morada que consta das Finanças estiver desatualizada, poderá ser necessário corrigi-la antes de obter uma certidão que reflita a situação atual.'
        ],
        'grupos' => [
            [
                'titulo' => 'Obter Certidão de Domicílio Fiscal', 'tipo' => 'perfil',
                'itens' => [
                    'NIF e credenciais ou outro meio de autenticação admitido pelo Portal das Finanças.',
                    'Verificação prévia da morada fiscal registada na AT.',
                    'Acesso ao serviço de certidões para guardar ou imprimir a Certidão de Domicílio Fiscal.'
                ]
            ],
            [
                'titulo' => 'Comprovar alojamento perante a AIMA', 'tipo' => 'perfil',
                'itens' => [
                    'Declaração de alojamento sob compromisso de honra, com a morada e a situação jurídica de ocupação, conforme minuta oficial.',
                    'Se proprietário ou usufrutuário: certidão de registo predial válida ou código de acesso à certidão.',
                    'Se arrendatário: contrato em nome do requerente e recibo de renda referente ao mês anterior, conforme orientações específicas da AIMA.',
                    'Se comodatário: contrato de comodato e certidão predial válida, conforme orientação específica da AIMA.'
                ]
            ],
            [
                'titulo' => 'Comprovativo para banco ou outra entidade', 'tipo' => 'perfil',
                'itens' => [
                    'Comprovativo expressamente aceite pela entidade destinatária.',
                    'Confirmação da morada, do nome e da data de emissão do documento.',
                    'Outros elementos específicos pedidos pela entidade, se aplicáveis.'
                ]
            ],
            [
                'titulo' => 'AIMA: nome não consta do contrato', 'tipo' => 'complemento',
                'itens' => [
                    'Declaração adicional sob compromisso de honra, conforme minuta da AIMA, com a identificação do imóvel, o título de ocupação e a identificação do proprietário.',
                    'Certidão da AT com o domicílio fiscal claramente identificado e emitida há menos de 30 dias, quando exigida por esta situação especial.'
                ]
            ],
            [
                'titulo' => 'AIMA: alojamento em residência estudantil', 'tipo' => 'complemento',
                'itens' => [
                    'Comprovativo da instituição de ensino ou documentação de alojamento estudantil admitida pela AIMA, de acordo com a modalidade específica.',
                    'Declarações ou contratos que identifiquem individualmente o estudante e a residência, quando necessários.'
                ]
            ]
        ],
        'antes' => [
            'Pergunte à entidade destinatária qual o documento aceite; não assuma que qualquer fatura serve.',
            'Se precisa da certidão fiscal, verifique se a sua morada no Portal das Finanças está atualizada.',
            'Se o pedido é para a AIMA, identifique primeiro se ocupa o imóvel como proprietário, arrendatário, comodatário ou em alojamento estudantil.',
            'Confira se o seu nome consta do contrato e se há uma situação especial que exige documentação adicional.',
            'Verifique a data de emissão e as regras aplicáveis ao comprovativo; uma exigência de 30 dias não é universal para todos os procedimentos.'
        ],
        'passos' => [
            ['titulo' => 'Identifique a finalidade do comprovativo', 'texto' => 'Confirme quem pede o documento e se precisa de provar domicílio fiscal, residência habitual ou situação jurídica do alojamento.', 'dica' => 'Uma certidão fiscal não substitui automaticamente a prova de alojamento perante a AIMA.'],
            ['titulo' => 'Se precisa da certidão fiscal, entre nas Finanças', 'texto' => 'Aceda ao Portal das Finanças e pesquise Certidão de Domicílio Fiscal. Entre em Pedir Certidão e autentique-se.', 'dica' => 'Na emissão, selecione Domicílio Fiscal e siga a opção para confirmar e obter.'],
            ['titulo' => 'Confirme a morada da certidão', 'texto' => 'Verifique o nome, a morada e os dados apresentados. Se estiverem incorretos, consulte primeiro o procedimento de atualização na AT.', 'dica' => 'A certidão comprova o que consta dos registos fiscais, não qualquer morada indicada informalmente.'],
            ['titulo' => 'Se o destino é a AIMA, escolha o seu tipo de alojamento', 'texto' => 'Consulte a minuta oficial de alojamento e verifique qual é a prova exigida para propriedade, arrendamento, comodato ou alojamento estudantil.', 'dica' => 'Os documentos não são iguais para todos os tipos de ocupação.'],
            ['titulo' => 'Reúna a prova do imóvel', 'texto' => 'Prepare a certidão predial, contrato, recibo de renda, declaração do senhorio ou documentos estudantis, conforme a modalidade e as instruções oficiais aplicáveis.', 'dica' => 'Se não constar do contrato, confira os comprovativos adicionais exigidos pela AIMA.'],
            ['titulo' => 'Verifique datas e identificação', 'texto' => 'Revise morada completa, nome, dados do imóvel e datas dos documentos. No caso especial indicado pela AIMA, a certidão da AT pode precisar de emissão inferior a 30 dias.', 'dica' => 'Não aplique automaticamente a regra dos 30 dias a qualquer comprovativo.'],
            ['titulo' => 'Apresente o comprovativo correto', 'texto' => 'Entregue os elementos solicitados à entidade destinatária e guarde o comprovativo de apresentação, quando existir.', 'dica' => 'Se uma entidade recusar um documento, confirme qual a prova expressamente exigida para aquele procedimento.']
        ],
        'onde' => 'Certidão de Domicílio Fiscal: Portal das Finanças. Prova de alojamento perante a AIMA: documentos obtidos junto do proprietário, senhorio, registo predial ou instituição de ensino, conforme a situação.',
        'custo' => 'As certidões emitidas eletronicamente no Portal das Finanças são gratuitas. Outros documentos ou atendimentos podem ter custos próprios, consoante a entidade e o procedimento.',
        'alertas' => [
            'A Certidão de Domicílio Fiscal comprova a morada fiscal, mas não é uma prova universal de alojamento.',
            'AIMA: confira a prova exigida conforme propriedade, arrendamento, comodato ou alojamento estudantil.',
            'Quando o requerente não consta do contrato, podem ser exigidas declaração especial e certidão da AT com menos de 30 dias, conforme orientação específica da AIMA.',
            'A AIMA indica que atestados de Junta de Freguesia não são aceites como prova de alojamento no procedimento descrito pela sua orientação. Isso não significa que sejam inválidos para todas as outras finalidades.',
            'Alterações de morada fiscal devem ser comunicadas à AT dentro dos prazos legalmente aplicáveis.',
            'Não divulgue publicamente contratos, moradas completas, números de documentos ou dados de proprietários.'
        ],
        'fontes' => [
            ['nome' => 'AT: Morada e domicílio fiscal', 'url' => 'https://info.portaldasfinancas.gov.pt/pt/apoio_ao_contribuinte/Cidadaos/Dados_pessoais_familia/Dados_pessoais/Morada/Paginas/default.aspx'],
            ['nome' => 'Portal das Finanças', 'url' => 'https://www.portaldasfinancas.gov.pt/'],
            ['nome' => 'AIMA: Comprovativo de alojamento', 'url' => 'https://aima.gov.pt/pt/noticias/hklkjl'],
            ['nome' => 'AIMA: FAQ de requisitos e alojamento', 'url' => 'https://aima.gov.pt/pt/decreto-regulamentar-da-lei-de-estrangeiros-alteracoes/perguntas-frequentes']
        ]
    ],

    // ============================================================
    // 6. AUTORIZAÇÃO DE RESIDÊNCIA
    // ============================================================
    'residencia' => [
        'titulo' => 'Autorização de Residência',
        'sigla' => 'AR',
        'subtitulo' => 'Concessão pelo regime geral, CPLP e outras modalidades',
        'categoria' => 'Imigração',
        'entidade' => 'Agência para a Integração, Migrações e Asilo (AIMA)',
        'resumo' => 'Saiba distinguir primeira concessão, renovação e diferentes fundamentos legais; consulte os comprovativos gerais, documentos específicos e canais oficiais da AIMA.',
        'oque' => [
            'A autorização de residência é um título concedido pelas autoridades competentes que permite residir em Portugal nas condições e durante o período legal aplicável.',
            'A legislação prevê diferentes fundamentos, incluindo trabalho, estudo, reagrupamento familiar e determinados procedimentos para cidadãos da Comunidade dos Países de Língua Portuguesa (CPLP).',
            'Não há uma única lista de documentos que sirva para todas as modalidades. O conjunto exigido pode incluir elementos gerais, como identificação e meios de subsistência, e elementos específicos do fundamento jurídico.',
            'Primeira concessão, renovação, substituição do título e pedidos pendentes são procedimentos diferentes. Antes de reunir documentos, é essencial descobrir qual corresponde à sua situação.',
            'Ter NIF, NISS, contrato de trabalho ou marcação não significa, isoladamente, que a residência será concedida; a entidade decide após analisar os requisitos aplicáveis.'
        ],
        'quem' => [
            'Pessoas estrangeiras que se enquadrem numa modalidade legal de autorização de residência e cumpram os respetivos pressupostos.',
            'Na primeira concessão pelo regime geral do artigo 77.º, n.º 1, a AIMA apresenta requisitos gerais, incluindo passaporte, visto de residência válido e documentação complementar, salvo regimes especiais aplicáveis.',
            'Para nova concessão CPLP, a AIMA informa que é necessário visto consular obtido especificamente para esse efeito, com agendamento e recolha de dados biométricos nas condições aplicáveis.',
            'Pedidos de residência por estudo, família, atividade profissional específica ou outra modalidade exigem consulta à página própria da AIMA.',
            'Quem já possui título e pretende renová-lo deve seguir o procedimento de renovação aplicável, não a checklist de primeira concessão.'
        ],
        'grupos' => [
            [
                'titulo' => 'Primeira concessão: regime geral, artigo 77.º, n.º 1', 'tipo' => 'perfil',
                'itens' => [
                    'Passaporte ou outro documento de viagem válido.',
                    'Visto de residência válido, salvo enquadramento legal especial confirmado pela AIMA.',
                    'Comprovativo de meios de subsistência adequado à modalidade.',
                    'Declaração de alojamento sob compromisso de honra, com indicação da situação de ocupação da habitação.',
                    'Prova do direito de utilização do imóvel, conforme as instruções atuais da AIMA.',
                    'Seguro de saúde ou comprovativo de enquadramento no SNS.',
                    'Documentos específicos do fundamento legal do pedido.'
                ]
            ],
            [
                'titulo' => 'Nova concessão: autorização de residência CPLP', 'tipo' => 'perfil',
                'itens' => [
                    'Visto consular obtido expressamente para a concessão CPLP, nos termos divulgados pela AIMA.',
                    'Passaporte ou outro documento de viagem válido.',
                    'Requerimento de concessão e autorização para consulta do registo criminal português, conforme o procedimento.',
                    'Certificado de registo criminal do país de nacionalidade ou de residência anterior relevante, conforme exigido.',
                    'Comprovativo de meios de subsistência.',
                    'Outros documentos ou formulários comunicados pela AIMA para o caso concreto.'
                ]
            ],
            [
                'titulo' => 'Estudo, família, trabalho específico ou outro fundamento', 'tipo' => 'perfil',
                'itens' => [
                    'Passaporte ou documento de viagem válido.',
                    'Visto ou fundamento legal adequado à modalidade, quando exigido.',
                    'Documentos específicos do motivo do pedido: matrícula, vínculo de trabalho, relação familiar ou outro elemento aplicável.',
                    'Meios de subsistência, alojamento, seguro ou inscrição no SNS, conforme a página específica da AIMA.',
                    'Formulários e certidões previstos para a modalidade concreta.'
                ]
            ],
            [
                'titulo' => 'Inscrições e formulários adicionais', 'tipo' => 'complemento',
                'itens' => [
                    'Comprovativo de inscrição fiscal na AT, se aplicável.',
                    'Comprovativo de inscrição na Segurança Social, se aplicável.',
                    'Modelo 1 ou outro requerimento oficial exigido.',
                    'Modelo 4, Termo de Responsabilidade, quando aplicável.'
                ]
            ],
            [
                'titulo' => 'Certidões e condições específicas', 'tipo' => 'complemento',
                'itens' => [
                    'Certidão de registo criminal estrangeiro autenticada e traduzida quando exigido para o procedimento.',
                    'Comprovativos de parentesco, estudos, trabalho, rendimentos ou outros vínculos específicos.',
                    'Outros documentos expressamente solicitados para a modalidade.'
                ]
            ],
            [
                'titulo' => 'Alojamento: requerente não consta do contrato', 'tipo' => 'complemento',
                'itens' => [
                    'Declaração de alojamento adicional conforme minuta e orientação especial da AIMA, indicando a situação do imóvel e o proprietário.',
                    'Certidão de domicílio fiscal da AT com emissão inferior a 30 dias, quando aplicável à situação descrita pela AIMA.'
                ]
            ]
        ],
        'antes' => [
            'Determine se necessita de primeira concessão, renovação, substituição ou acompanhamento de um pedido já apresentado.',
            'Identifique a base legal exata: regime geral, CPLP, estudo, trabalho, família ou outra.',
            'Confirme se a sua modalidade exige visto consular prévio e se já existe agendamento associado ao visto.',
            'Consulte a página específica da AIMA e verifique os documentos comuns e os documentos próprios da modalidade.',
            'Analise a prova de alojamento de acordo com a situação real do imóvel; a certidão fiscal não substitui sempre os documentos de ocupação.',
            'Consulte a tabela atual de taxas e os meios oficiais de pagamento; não utilize valores fixos retirados de informações antigas.'
        ],
        'passos' => [
            ['titulo' => 'Identifique o tipo de pedido', 'texto' => 'Verifique se é primeira concessão, renovação ou outro procedimento. Selecione a modalidade legal correspondente no portal da AIMA.', 'dica' => 'Uma checklist do regime geral não substitui a de CPLP ou reagrupamento familiar.'],
            ['titulo' => 'Confirme o visto e o fundamento legal', 'texto' => 'Consulte a necessidade de visto de residência e as eventuais regras especiais aplicáveis ao seu enquadramento.', 'dica' => 'NIF e NISS não são títulos de residência.'],
            ['titulo' => 'Prepare a identificação e os meios de subsistência', 'texto' => 'Reúna passaporte, documentos de rendimentos e comprovativos do motivo de residência, conforme a modalidade pretendida.', 'dica' => 'A forma de demonstrar meios de subsistência depende do tipo de pedido.'],
            ['titulo' => 'Prepare cuidadosamente a prova de alojamento', 'texto' => 'Consulte as instruções da AIMA para declaração de morada e prova da situação jurídica do imóvel. Separe os documentos de propriedade, arrendamento, comodato ou alojamento aplicáveis.', 'dica' => 'Se o seu nome não estiver no contrato, podem existir exigências complementares.'],
            ['titulo' => 'Organize documentos complementares', 'texto' => 'Verifique seguro ou SNS, registo criminal, inscrição fiscal, Segurança Social, documentos de parentesco e formulários exigidos para a modalidade.', 'dica' => 'Alguns documentos estrangeiros podem necessitar de autenticação ou tradução.'],
            ['titulo' => 'Utilize somente o canal oficial de submissão ou agendamento', 'texto' => 'Siga o canal indicado pela AIMA para a modalidade. O atendimento pode ser presencial ou digital quando esse serviço específico estiver disponibilizado.', 'dica' => 'Os agendamentos oficiais são gratuitos. Guarde referências e comprovativos.'],
            ['titulo' => 'Compareça ou conclua a submissão', 'texto' => 'No atendimento ou portal habilitado, apresente os documentos exigidos e cumpra a recolha biométrica quando necessária.', 'dica' => 'Confira os dados e guarde o comprovativo do pedido.'],
            ['titulo' => 'Acompanhe a decisão e os encargos', 'texto' => 'Utilize os canais oficiais de acompanhamento, pague taxas apenas pelos meios indicados e conserve as comunicações recebidas.', 'dica' => 'A AIMA atualizou a tabela de taxas com efeitos a partir de 1 de março de 2026; consulte o valor atual antes do pagamento.']
        ],
        'onde' => 'Na AIMA, por Loja AIMA, agendamento ou portal eletrónico habilitado para a modalidade concreta. Os canais de concessão, renovação e CPLP podem ser diferentes. Consulte o portal oficial antes de iniciar.',
        'custo' => 'A autorização de residência está sujeita a taxas variáveis conforme a modalidade e o procedimento. Consulte a tabela atualizada publicada pela AIMA; não existe um valor único aplicável a todos os pedidos.',
        'alertas' => [
            'Primeira concessão, renovação e substituição são procedimentos distintos. Não escolha a checklist apenas pela nacionalidade.',
            'O enquadramento CPLP tem procedimentos próprios. A AIMA indica visto consular específico para novas concessões nos termos divulgados oficialmente.',
            'Alojamento, meios de subsistência, antecedentes criminais e documentos específicos podem ser analisados de maneira diferente em cada modalidade.',
            'A documentação incompleta ou inadequada pode comprometer a instrução do pedido. A checklist da PAD é uma ferramenta de organização, não uma certificação de elegibilidade.',
            'As taxas dependem da modalidade e podem ser atualizadas. A tabela divulgada pela AIMA entrou em vigor em 1 de março de 2026.',
            'O agendamento oficial não deve ser confundido com a contratação de serviços de intermediários; desconfie de promessas de aprovação garantida.',
            'Este guia não substitui informação jurídica individualizada nem as instruções específicas emitidas pela AIMA.'
        ],
        'fontes' => [
            ['nome' => 'AIMA: Regime geral, artigo 77.º', 'url' => 'https://aima.gov.pt/pt/viver/autorizacao-de-residencia-regime-e-requisitos-gerais-art-o-77-o-n-o-1'],
            ['nome' => 'AIMA: Perguntas frequentes e requisitos', 'url' => 'https://aima.gov.pt/pt/decreto-regulamentar-da-lei-de-estrangeiros-alteracoes/perguntas-frequentes'],
            ['nome' => 'AIMA: Concessão de residência CPLP', 'url' => 'https://aima.gov.pt/pt/noticias/kgljg'],
            ['nome' => 'AIMA: Agendamento para concessão CPLP', 'url' => 'https://aima.gov.pt/pt/noticias/aceda-ao-novo-formulario-de-contacto-da-aima'],
            ['nome' => 'AIMA: Prova de alojamento', 'url' => 'https://aima.gov.pt/pt/noticias/hklkjl'],
            ['nome' => 'AIMA: Tabela de taxas atualizada em 2026', 'url' => 'https://aima.gov.pt/pt/noticias/atualizacao-da-tabela-de-taxas']
        ]
    ]
];

// Conserva a data editorial definida no projeto.
// Só altere PAD_REVISAO, em config.php, após revisão integral.
foreach ($documentos as &$documento) {
    $documento['revisao'] = PAD_REVISAO;
}
unset($documento);
