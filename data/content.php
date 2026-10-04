<?php
/**
 * Todo o conteúdo do portfólio (PT / EN).
 * Para atualizar textos, projetos, skills ou experiência, edite este arquivo.
 */

/* ---- Dados que não mudam entre idiomas ---- */
$stack = [
    'data' => [
        'icon'  => 'database',
        'items' => ['Python', 'SQL', 'Databricks', 'Medallion Architecture', 'ETL / ELT', 'Data Warehouse', 'Pandas'],
    ],
    'bi' => [
        'icon'  => 'chart-column',
        'items' => ['Power BI', 'DAX', 'Dashboards', 'Data Storytelling', 'Exploratory Analysis'],
    ],
    'web' => [
        'icon'  => 'server',
        'items' => ['PHP', 'MySQL', 'JavaScript', 'HTML & CSS', 'APIs REST', 'Flask'],
    ],
    'tools' => [
        'icon'  => 'toolbox',
        'items' => ['Git & GitHub', 'Android', 'Streamlit', 'Plotly', 'Computer Vision', 'Linux', 'XAMPP'],
    ],
    'roadmap' => [
        'icon'  => 'route',
        'items' => ['Apache Airflow', 'dbt', 'Docker', 'Cloud (AWS / GCP)'],
    ],
];

$marquee = ['Python', 'SQL', 'Databricks', 'Power BI', 'Medallion', 'PHP', 'MySQL', 'ETL', 'Data Warehouse', 'Pandas', 'DAX', 'Streamlit', 'Git', 'Airflow', 'dbt', 'Docker'];

/**
 * 'image' / 'images' => print(s) real(is) em img/ (o primeiro é a capa; vários viram galeria no modal).
 * 'art' => visual gerado quando o projeto não tem imagem ('bars' = gráfico de barras, 'icon' = ícone central).
 */
$projects = [
    [
        'id' => 'selic', 'cat' => 'data', 'status' => 'done', 'icon' => 'chart-line', 'art' => 'bars',
        'image' => 'img/selic-1.jpg',
        'images' => ['img/selic-1.jpg', 'img/selic-2.jpg'],
        'link' => 'https://github.com/Arthurmp07/Dashboard-Selic',
        'tags' => ['Python', 'Streamlit', 'Plotly', 'API BCB'],
    ],
    [
        'id' => 'futebol', 'cat' => 'data', 'status' => 'done', 'icon' => 'futbol', 'art' => 'bars',
        'image' => 'img/futebol.jpg',
        'images' => ['img/futebol.jpg'],
        'link' => 'https://github.com/Arthurmp07/analise_de_dados_python_futebol',
        'tags' => ['Python', 'Pandas', 'Matplotlib', 'Tkinter'],
    ],
    [
        'id' => 'detector', 'cat' => 'ai', 'status' => 'done', 'icon' => 'eye', 'art' => 'icon',
        'image' => null,
        'link' => 'https://github.com/Arthurmp07/detectordeobjetos',
        'tags' => ['Python', 'OpenCV', 'Computer Vision'],
    ],
    [
        'id' => 'lifemap', 'cat' => 'web', 'status' => 'done', 'icon' => 'heart-pulse', 'art' => 'icon',
        'image' => 'img/lifemap-1.jpg',
        'images' => ['img/lifemap-1.jpg', 'img/lifemap-2.jpg'],
        'link' => 'https://github.com/Arthurmp07/LifeMap',
        'tags' => ['PHP', 'MySQL', 'MediaPipe', 'JavaScript'],
    ],
    [
        'id' => 'lacanine', 'cat' => 'web', 'status' => 'done', 'icon' => 'paw', 'art' => 'icon',
        'image' => 'img/lacanine.jpg',
        'images' => ['img/lacanine.jpg'],
        'link' => 'https://lacanine.page.gd/index.php',
        'tags' => ['PHP', 'JavaScript', 'HTML & CSS'],
    ],
    [
        'id' => 'lexer', 'cat' => 'academic', 'status' => 'done', 'icon' => 'code', 'art' => 'icon',
        'image' => 'img/lexer.jpg',
        'images' => ['img/lexer.jpg'],
        'link' => 'https://github.com/Arthurmp07/lexer_liguagens_programacao',
        'tags' => ['ANTLR4', 'Java', 'Python', 'GraphQL', 'SQLite'],
    ],
];

/* ---- Textos por idioma ---- */
$pt = [
    'locale' => 'pt_BR',
    'meta' => [
        'title'       => 'Arthur Mello Pimentel — Engenharia de Dados',
        'description' => 'Portfólio de Arthur Mello Pimentel: Engenharia e Análise de Dados com Python, SQL e Power BI, além de desenvolvimento web freelance. Porto Alegre, RS.',
    ],
    'ui' => [
        'skip' => 'Ir para o conteúdo', 'theme' => 'Alternar tema', 'menu' => 'Abrir menu', 'lang_label' => 'Idioma',
        'back_top' => 'Voltar ao topo', 'close' => 'Fechar', 'view_code' => 'Ver código', 'visit_site' => 'Visitar site',
        'in_progress' => 'Em construção', 'current' => 'Atual', 'done' => 'Concluído', 'details' => 'Detalhes', 'no_link' => 'Link em breve',
    ],
    'nav' => [
        'home' => 'Início', 'about' => 'Sobre', 'stack' => 'Stack', 'pipeline' => 'Pipeline',
        'projects' => 'Projetos', 'experience' => 'Trajetória', 'contact' => 'Contato',
    ],
    'hero' => [
        'eyebrow'  => 'Porto Alegre, RS · Sicredi Origens',
        'hello'    => 'Olá, eu sou',
        'headline_pre' => 'Construo ',
        'headline_hl'  => 'pipelines de dados',
        'headline_post' => ' que viram decisões.',
        'roles'    => ['Engenheiro de Dados', 'Assistente de BI', 'Desenvolvedor Freelancer'],
        'text'     => 'Coleto dados de APIs e bancos, trato e padronizo no Databricks com arquitetura medalhão e entrego tudo pronto no Power BI, para apoiar decisões reais de negócio.',
        'cta_primary'   => 'Ver projetos',
        'cta_secondary' => 'Falar comigo',
        'cta_resume'    => 'Currículo',
        'scroll'   => 'Role para explorar',
    ],
    'stats' => [
        ['value' => null, 'suffix' => '+', 'label' => 'anos de experiência em dados'],
        ['value' => 'projects', 'suffix' => '',  'label' => 'projetos publicados'],
        ['value' => 'tech', 'suffix' => '+', 'label' => 'tecnologias na stack'],
        ['value' => 2029, 'suffix' => '',  'label' => 'formação em Eng. de Software'],
    ],
    'about' => [
        'eyebrow' => 'Sobre mim',
        'title'   => 'Dados são o meu trabalho. Sites e sistemas, quando me indicam.',
        'paragraphs' => [
            'Sou Técnico em Informática apaixonado por tecnologia e por criar soluções que realmente funcionam. Desde o fim de 2023 atuo com dados no Sicredi Origens RS, onde transformo grandes volumes de informação em análises claras para o negócio.',
            'Meu foco é a Engenharia de Dados: construir fluxos confiáveis de coleta, transformação e padronização no Databricks (arquitetura medalhão), modelar dados para análise e disponibilizá-los no Power BI.',
            'Em paralelo, atuo como freelancer: quando sou indicado, desenvolvo sites, sistemas e aplicativos em PHP e JavaScript, como o site da La Canine, que está em uso por uma empresa real. Estou sempre aprendendo e motivado a contribuir com projetos que impulsionam a transformação digital.',
        ],
        'cards' => [
            ['icon' => 'bullseye',        'title' => 'Foco',          'text' => 'Engenharia e análise de dados'],
            ['icon' => 'graduation-cap',  'title' => 'Formação',      'text' => 'Eng. de Software — PUCRS (2025–2029)'],
            ['icon' => 'building',        'title' => 'Atuação',       'text' => 'BI e dados no Sicredi Origens RS'],
            ['icon' => 'language',        'title' => 'Idiomas',       'text' => 'Português nativo · Inglês técnico'],
        ],
        'photo_alt' => 'Foto de Arthur Mello Pimentel',
    ],
    'stack' => [
        'eyebrow' => 'Stack', 'title' => 'Ferramentas que uso para tirar valor dos dados',
        'text' => 'Do pipeline à visualização, o meu foco é dados. Em projetos freelance, complemento com desenvolvimento web.',
        'groups' => [
            'data'    => ['title' => 'Engenharia de Dados', 'badge' => 'Foco principal'],
            'bi'      => ['title' => 'Análise & BI',        'badge' => null],
            'web'     => ['title' => 'Desenvolvimento (freelance)', 'badge' => null],
            'tools'   => ['title' => 'Ferramentas & Visualização', 'badge' => null],
            'roadmap' => ['title' => 'Roadmap de estudos',  'badge' => 'Em evolução'],
        ],
    ],
    'pipeline' => [
        'eyebrow' => 'Como eu trabalho',
        'title'   => 'Do dado bruto ao Power BI',
        'text'    => 'Clique em cada etapa para ver como o dado viaja da fonte até a decisão: das APIs e bancos de dados, passando pelo Databricks, até o Power BI.',
        'steps' => [
            [
                'key' => 'extract', 'icon' => 'cloud-arrow-down', 'lang' => 'python', 'label' => 'Coleta',
                'title' => 'Coletar dados de APIs e bancos de dados',
                'text'  => 'Começo pela fonte: consumo APIs e consulto bancos de dados, trazendo os dados brutos para o Databricks com conexões seguras e registro de cada carga.',
                'tools' => ['Python', 'SQL', 'APIs REST', 'Databricks'],
                'code'  => "# Camada Bronze: dado bruto, exatamente como veio da fonte\nresposta = requests.get(API_URL, headers=headers).json()\ndf_api = spark.createDataFrame(resposta[\"dados\"])\ndf_db = spark.read.jdbc(JDBC_URL, \"vendas\", properties=props)\n\ndf_api.write.mode(\"append\").saveAsTable(\"bronze.api_vendas\")\ndf_db.write.mode(\"append\").saveAsTable(\"bronze.db_vendas\")",
            ],
            [
                'key' => 'medallion', 'icon' => 'layer-group', 'lang' => 'python', 'label' => 'Medalhão',
                'title' => 'Transformar e padronizar na arquitetura medalhão',
                'text'  => 'No Databricks, os dados evoluem em camadas: Bronze (bruto), Silver (limpo e padronizado) e Gold (pronto para o negócio). Cada etapa é reproduzível e rastreável.',
                'tools' => ['Databricks', 'Medallion Architecture', 'Python', 'SQL'],
                'code'  => "# Silver: limpar, padronizar tipos e aplicar regras\nsilver = (spark.table(\"bronze.db_vendas\")\n    .dropDuplicates([\"id\"])\n    .withColumn(\"valor\", col(\"valor\").cast(\"decimal(12,2)\"))\n    .withColumn(\"data\", to_date(\"data\")))\nsilver.write.mode(\"overwrite\").saveAsTable(\"silver.vendas\")",
            ],
            [
                'key' => 'quality', 'icon' => 'shield-halved', 'lang' => 'python', 'label' => 'Validação',
                'title' => 'Validar antes de publicar',
                'text'  => 'Checagens de integridade, contagem de registros, nulos e duplicidades entre as camadas, para que ninguém tome decisão com dado errado.',
                'tools' => ['Testes de dados', 'Reconciliação', 'Logs'],
                'code'  => "total_bronze = spark.table(\"bronze.db_vendas\").count()\ntotal_silver = spark.table(\"silver.vendas\").count()\n\nassert total_silver <= total_bronze, \"Silver maior que Bronze\"\nassert silver.filter(col(\"id\").isNull()).count() == 0\nprint(f\"{total_silver} linhas validadas\")",
            ],
            [
                'key' => 'prepare', 'icon' => 'table-cells', 'lang' => 'sql', 'label' => 'Preparação',
                'title' => 'Preparar os dados para o Power BI',
                'text'  => 'Na camada Gold, modelo os dados em fatos e dimensões, com as métricas já calculadas e nomes claros, para que o Power BI consuma tudo de forma leve e rápida.',
                'tools' => ['Camada Gold', 'Modelagem Dimensional', 'SQL'],
                'code'  => "CREATE OR REPLACE TABLE gold.fato_vendas AS\nSELECT v.id, v.data, c.cliente_sk, p.produto_sk,\n       v.valor, v.valor - v.custo AS lucro\nFROM silver.vendas v\nJOIN gold.dim_cliente c USING (cliente_id)\nJOIN gold.dim_produto p USING (produto_id);",
            ],
            [
                'key' => 'serve', 'icon' => 'chart-line', 'lang' => 'dax', 'label' => 'Power BI',
                'title' => 'Entregar no Power BI de forma estratégica',
                'text'  => 'Dashboards pensados a partir da decisão: poucas métricas bem definidas, hierarquia visual clara e narrativa de dados, para o usuário chegar ao insight sem esforço.',
                'tools' => ['Power BI', 'DAX', 'Data Storytelling'],
                'code'  => "Margem % =\nDIVIDE(\n    SUM(fato_vendas[lucro]),\n    SUM(fato_vendas[valor])\n)",
            ],
        ],
    ],
    'projects' => [
        'eyebrow' => 'Projetos', 'title' => 'Trabalhos selecionados',
        'text' => 'Projetos de dados, IA, web e acadêmicos. Do dashboard ao sistema completo em uso por uma empresa real.',
        'filters' => ['all' => 'Todos', 'data' => 'Dados', 'ai' => 'IA', 'web' => 'Web', 'academic' => 'Acadêmico'],
        'github_title' => 'GitHub ao vivo',
        'github_repos' => 'repositórios', 'github_followers' => 'seguidores', 'github_langs' => 'Linguagens mais usadas',
        'github_cta' => 'Ver perfil no GitHub',
        'items' => [
            'selic'      => ['title' => 'Dashboard Selic', 'desc' => 'Dashboard interativo em Python (Streamlit + Plotly) que cruza Selic, IPCA e Salário Mínimo com dados oficiais da API do Banco Central (SGS), do dado bruto ao gráfico interativo.'],
            'futebol'    => ['title' => 'Análise de Dados do Futebol', 'desc' => 'Análise em Python de gols e assistências de grandes jogadores (2019–2024), com tabelas analíticas em Pandas e gráficos animados em Matplotlib numa interface Tkinter.'],
            'detector'   => ['title' => 'Detector de Objetos', 'desc' => 'Detector de objetos em Python (OpenCV + SSD MobileNet/COCO) que captura a imagem da câmera, identifica os objetos presentes e os anuncia. Inclui guia de setup para Raspberry Pi.'],
            'lifemap'    => ['title' => 'LifeMap', 'desc' => 'Plataforma de bem-estar em PHP + MySQL com pilares Físico, Mental e Ingesta: IMC com histórico, treino e dieta, rotina, avaliador de físico pela câmera (MediaPipe) e atendimento por profissionais com chat e chamadas de voz e vídeo.'],
            'lacanine'   => ['title' => 'Site La Canine — Creche e Pet Shop', 'desc' => 'Site da La Canine, creche e pet shop em Penha de França (São Paulo), desenvolvido por mim e em uso pela empresa. Apresenta os serviços (creche, banho, tosa e hotel) e área de clientes com cadastro e login.'],
            'lexer'      => ['title' => 'Analisadores Léxicos com ANTLR4', 'desc' => 'Trabalho de Linguagens de Programação (PUCRS, em grupo): lexers de GraphQL e SQLite em ANTLR4, com 24 casos de teste, diagramas de ferrovia e análise comparativa.'],
        ],
    ],
    'experience' => [
        'eyebrow' => 'Trajetória', 'title' => 'Experiência e formação',
        'items' => [
            ['date' => 'dez 2025 — Atual', 'type' => 'work', 'icon' => 'chart-column', 'role' => 'Assistente de BI', 'org' => 'Sicredi Origens RS', 'text' => 'Atuo com Business Intelligence: coleto, trato e modelo dados e construo dashboards em Power BI para apoiar as decisões do negócio.', 'current' => true],
            ['date' => '2025 — 2029', 'type' => 'edu', 'icon' => 'graduation-cap', 'role' => 'Bacharelado em Engenharia de Software', 'org' => 'PUCRS', 'text' => 'Graduação em andamento, aprofundando fundamentos de engenharia de software, arquitetura e boas práticas.', 'current' => true],
            ['date' => 'dez 2023 — dez 2025', 'type' => 'work', 'icon' => 'briefcase', 'role' => 'Jovem Aprendiz', 'org' => 'Sicredi Origens RS', 'text' => 'Minha primeira experiência na área de TI, atuando com análise de dados e dando os primeiros passos em BI.', 'current' => false],
            ['date' => '2022 — 2024', 'type' => 'edu', 'icon' => 'laptop-code', 'role' => 'Técnico em Informática', 'org' => 'Senac Creative District', 'text' => 'Formação técnica em desenvolvimento front-end (HTML, CSS e JavaScript) e back-end e dados (Python, PHP e SQL).', 'current' => false],
        ],
    ],
    'contact' => [
        'eyebrow' => 'Contato', 'title' => 'Vamos conversar sobre dados?',
        'text' => 'Quer falar sobre dados, ou precisa de um site ou sistema? Envie uma mensagem e eu respondo o mais rápido possível.',
        'name' => 'Seu nome', 'email' => 'Seu e-mail', 'message' => 'Sua mensagem', 'send' => 'Enviar mensagem', 'sending' => 'Enviando…',
        'success' => 'Mensagem enviada! Obrigado pelo contato — respondo em breve.',
        'error' => 'Não foi possível enviar agora. Tente novamente ou fale comigo pelo WhatsApp.',
        'invalid' => 'Confira os campos e tente de novo.',
        'rate' => 'Muitas mensagens em pouco tempo. Aguarde alguns minutos.',
        'channels' => ['email' => 'E-mail', 'whatsapp' => 'WhatsApp', 'linkedin' => 'LinkedIn', 'location' => 'Localização'],
        'chars' => 'caracteres',
    ],
    'footer' => ['rights' => 'Todos os direitos reservados.', 'built' => 'Feito com PHP, CSS e muito café.'],
    'notfound' => ['title' => 'Página não encontrada', 'text' => 'Parece que esse registro não existe na tabela. Vamos voltar ao início?', 'cta' => 'Voltar ao início'],
    'resume' => [
        'title' => 'Currículo', 'profile' => 'Perfil', 'experience' => 'Experiência e Formação', 'skills' => 'Competências',
        'projects' => 'Projetos', 'contact' => 'Contato', 'print' => 'Salvar / imprimir PDF', 'back' => 'Voltar ao portfólio',
    ],
];

$en = [
    'locale' => 'en_US',
    'meta' => [
        'title'       => 'Arthur Mello Pimentel — Data Engineering',
        'description' => 'Portfolio of Arthur Mello Pimentel: Data Engineering and Analytics with Python, SQL and Power BI, plus freelance web development. Porto Alegre, Brazil.',
    ],
    'ui' => [
        'skip' => 'Skip to content', 'theme' => 'Toggle theme', 'menu' => 'Open menu', 'lang_label' => 'Language',
        'back_top' => 'Back to top', 'close' => 'Close', 'view_code' => 'View code', 'visit_site' => 'Visit site',
        'in_progress' => 'Work in progress', 'current' => 'Current', 'done' => 'Completed', 'details' => 'Details', 'no_link' => 'Link coming soon',
    ],
    'nav' => [
        'home' => 'Home', 'about' => 'About', 'stack' => 'Stack', 'pipeline' => 'Pipeline',
        'projects' => 'Projects', 'experience' => 'Journey', 'contact' => 'Contact',
    ],
    'hero' => [
        'eyebrow'  => 'Porto Alegre, Brazil · Sicredi Origens',
        'hello'    => "Hi, I'm",
        'headline_pre' => 'I build ',
        'headline_hl'  => 'data pipelines',
        'headline_post' => ' that become decisions.',
        'roles'    => ['Data Engineer', 'BI Assistant', 'Freelance Developer'],
        'text'     => 'I collect data from APIs and databases, process and standardize it in Databricks with a medallion architecture and deliver it ready in Power BI to support real business decisions.',
        'cta_primary'   => 'View projects',
        'cta_secondary' => 'Get in touch',
        'cta_resume'    => 'Resume',
        'scroll'   => 'Scroll to explore',
    ],
    'stats' => [
        ['value' => null, 'suffix' => '+', 'label' => 'years of experience in data'],
        ['value' => 'projects', 'suffix' => '',  'label' => 'published projects'],
        ['value' => 'tech', 'suffix' => '+', 'label' => 'technologies in the stack'],
        ['value' => 2029, 'suffix' => '',  'label' => 'Software Engineering degree'],
    ],
    'about' => [
        'eyebrow' => 'About me',
        'title'   => "Data is my job. Websites and systems, when I'm referred.",
        'paragraphs' => [
            "I'm a computer technician passionate about technology and building solutions that actually work. Since late 2023 I've been working with data at Sicredi Origens RS, turning large volumes of information into clear analysis for the business.",
            'My focus is Data Engineering: building reliable collection, transformation and standardization flows in Databricks (medallion architecture), modeling data for analysis and serving it in Power BI.',
            "On the side, I work as a freelancer: when I'm referred, I build websites, systems and apps with PHP and JavaScript, like the La Canine website, which is in use by a real company. I'm always learning and motivated to contribute to projects that drive digital transformation.",
        ],
        'cards' => [
            ['icon' => 'bullseye',        'title' => 'Focus',      'text' => 'Data engineering and analytics'],
            ['icon' => 'graduation-cap',  'title' => 'Education',  'text' => 'Software Engineering — PUCRS (2025–2029)'],
            ['icon' => 'building',        'title' => 'Work',       'text' => 'BI and data at Sicredi Origens RS'],
            ['icon' => 'language',        'title' => 'Languages',  'text' => 'Native Portuguese · Technical English'],
        ],
        'photo_alt' => 'Photo of Arthur Mello Pimentel',
    ],
    'stack' => [
        'eyebrow' => 'Stack', 'title' => 'The tools I use to get value out of data',
        'text' => 'From pipeline to visualization, data is my focus. On freelance projects, I complement it with web development.',
        'groups' => [
            'data'    => ['title' => 'Data Engineering', 'badge' => 'Main focus'],
            'bi'      => ['title' => 'Analytics & BI',   'badge' => null],
            'web'     => ['title' => 'Development (freelance)', 'badge' => null],
            'tools'   => ['title' => 'Tooling & Visualization', 'badge' => null],
            'roadmap' => ['title' => 'Learning roadmap', 'badge' => 'Evolving'],
        ],
    ],
    'pipeline' => [
        'eyebrow' => 'How I work',
        'title'   => 'From raw data to Power BI',
        'text'    => 'Click each stage to see how data travels from source to decision: from APIs and databases, through Databricks, to Power BI.',
        'steps' => [
            [
                'key' => 'extract', 'icon' => 'cloud-arrow-down', 'lang' => 'python', 'label' => 'Collect',
                'title' => 'Collect data from APIs and databases',
                'text'  => 'It starts at the source: I consume APIs and query databases, bringing raw data into Databricks through secure connections and logging every load.',
                'tools' => ['Python', 'SQL', 'REST APIs', 'Databricks'],
                'code'  => "# Bronze layer: raw data, exactly as it came from the source\nresponse = requests.get(API_URL, headers=headers).json()\ndf_api = spark.createDataFrame(response[\"data\"])\ndf_db = spark.read.jdbc(JDBC_URL, \"sales\", properties=props)\n\ndf_api.write.mode(\"append\").saveAsTable(\"bronze.api_sales\")\ndf_db.write.mode(\"append\").saveAsTable(\"bronze.db_sales\")",
            ],
            [
                'key' => 'medallion', 'icon' => 'layer-group', 'lang' => 'python', 'label' => 'Medallion',
                'title' => 'Transform and standardize in a medallion architecture',
                'text'  => 'In Databricks, data evolves through layers: Bronze (raw), Silver (clean and standardized) and Gold (business-ready). Every step is reproducible and traceable.',
                'tools' => ['Databricks', 'Medallion Architecture', 'Python', 'SQL'],
                'code'  => "# Silver: clean, standardize types and apply rules\nsilver = (spark.table(\"bronze.db_sales\")\n    .dropDuplicates([\"id\"])\n    .withColumn(\"amount\", col(\"amount\").cast(\"decimal(12,2)\"))\n    .withColumn(\"date\", to_date(\"date\")))\nsilver.write.mode(\"overwrite\").saveAsTable(\"silver.sales\")",
            ],
            [
                'key' => 'quality', 'icon' => 'shield-halved', 'lang' => 'python', 'label' => 'Validation',
                'title' => 'Validate before publishing',
                'text'  => 'Integrity checks, record counts, nulls and duplicates across layers, so nobody makes decisions with bad data.',
                'tools' => ['Data tests', 'Reconciliation', 'Logging'],
                'code'  => "total_bronze = spark.table(\"bronze.db_sales\").count()\ntotal_silver = spark.table(\"silver.sales\").count()\n\nassert total_silver <= total_bronze, \"Silver larger than Bronze\"\nassert silver.filter(col(\"id\").isNull()).count() == 0\nprint(f\"{total_silver} rows validated\")",
            ],
            [
                'key' => 'prepare', 'icon' => 'table-cells', 'lang' => 'sql', 'label' => 'Preparation',
                'title' => 'Prepare the data for Power BI',
                'text'  => 'In the Gold layer I model data into facts and dimensions, with metrics already calculated and clear names, so Power BI consumes everything light and fast.',
                'tools' => ['Gold layer', 'Dimensional Modeling', 'SQL'],
                'code'  => "CREATE OR REPLACE TABLE gold.fact_sales AS\nSELECT s.id, s.date, c.customer_sk, p.product_sk,\n       s.amount, s.amount - s.cost AS profit\nFROM silver.sales s\nJOIN gold.dim_customer c USING (customer_id)\nJOIN gold.dim_product p USING (product_id);",
            ],
            [
                'key' => 'serve', 'icon' => 'chart-line', 'lang' => 'dax', 'label' => 'Power BI',
                'title' => 'Deliver in Power BI, strategically',
                'text'  => 'Dashboards designed around the decision: a few well-defined metrics, clear visual hierarchy and data storytelling, so users reach the insight effortlessly.',
                'tools' => ['Power BI', 'DAX', 'Data Storytelling'],
                'code'  => "Margin % =\nDIVIDE(\n    SUM(fact_sales[profit]),\n    SUM(fact_sales[amount])\n)",
            ],
        ],
    ],
    'projects' => [
        'eyebrow' => 'Projects', 'title' => 'Selected work',
        'text' => "Data, AI, web and academic projects. From dashboards to a full system in use by a real company.",
        'filters' => ['all' => 'All', 'data' => 'Data', 'ai' => 'AI', 'web' => 'Web', 'academic' => 'Academic'],
        'github_title' => 'Live GitHub',
        'github_repos' => 'repositories', 'github_followers' => 'followers', 'github_langs' => 'Most used languages',
        'github_cta' => 'View GitHub profile',
        'items' => [
            'selic'      => ['title' => 'Selic Dashboard', 'desc' => 'Interactive Python dashboard (Streamlit + Plotly) that crosses the Selic rate, IPCA inflation and the minimum wage using official Central Bank of Brazil (SGS) API data, from raw data to interactive chart.'],
            'futebol'    => ['title' => 'Football Data Analysis', 'desc' => 'Python analysis of goals and assists by top players (2019–2024), with analytical tables in Pandas and animated Matplotlib charts inside a Tkinter interface.'],
            'detector'   => ['title' => 'Object Detector', 'desc' => 'Python object detector (OpenCV + SSD MobileNet/COCO) that captures the camera image, identifies the objects in it and announces them. Includes a Raspberry Pi setup guide.'],
            'lifemap'    => ['title' => 'LifeMap', 'desc' => 'Wellness platform built with PHP + MySQL around Physical, Mental and Nutrition pillars: BMI history, workout and diet plans, routine planner, camera-based body assessment (MediaPipe) and professional consultations with chat and voice/video calls.'],
            'lacanine'   => ['title' => 'La Canine Website — Daycare and Pet Shop', 'desc' => 'Website for La Canine, a dog daycare and pet shop in Penha de França (São Paulo), built by me and in use by the company. Presents the services (daycare, bath, grooming and hotel) and a customer area with sign-up and login.'],
            'lexer'      => ['title' => 'Lexical Analyzers with ANTLR4', 'desc' => 'Programming Languages coursework (PUCRS, group project): GraphQL and SQLite lexers in ANTLR4, with 24 test cases, railroad diagrams and a comparative analysis.'],
        ],
    ],
    'experience' => [
        'eyebrow' => 'Journey', 'title' => 'Experience and education',
        'items' => [
            ['date' => 'Dec 2025 — Present', 'type' => 'work', 'icon' => 'chart-column', 'role' => 'BI Assistant', 'org' => 'Sicredi Origens RS', 'text' => 'I work in Business Intelligence: I collect, process and model data and build Power BI dashboards that support business decisions.', 'current' => true],
            ['date' => '2025 — 2029', 'type' => 'edu', 'icon' => 'graduation-cap', 'role' => 'Bachelor\'s in Software Engineering', 'org' => 'PUCRS', 'text' => 'Ongoing degree, deepening software engineering fundamentals, architecture and best practices.', 'current' => true],
            ['date' => 'Dec 2023 — Dec 2025', 'type' => 'work', 'icon' => 'briefcase', 'role' => 'Young Apprentice', 'org' => 'Sicredi Origens RS', 'text' => 'My first experience in IT, working with data analysis and taking the first steps in BI.', 'current' => false],
            ['date' => '2022 — 2024', 'type' => 'edu', 'icon' => 'laptop-code', 'role' => 'IT Technician', 'org' => 'Senac Creative District', 'text' => 'Technical training in front-end (HTML, CSS and JavaScript) and back-end and data (Python, PHP and SQL) development.', 'current' => false],
        ],
    ],
    'contact' => [
        'eyebrow' => 'Contact', 'title' => "Let's talk about data?",
        'text' => "Want to talk about data, or need a website or system? Send a message and I'll get back to you as soon as possible.",
        'name' => 'Your name', 'email' => 'Your email', 'message' => 'Your message', 'send' => 'Send message', 'sending' => 'Sending…',
        'success' => "Message sent! Thanks for reaching out — I'll reply soon.",
        'error' => "Couldn't send right now. Please try again or reach me on WhatsApp.",
        'invalid' => 'Please check the fields and try again.',
        'rate' => 'Too many messages in a short time. Please wait a few minutes.',
        'channels' => ['email' => 'Email', 'whatsapp' => 'WhatsApp', 'linkedin' => 'LinkedIn', 'location' => 'Location'],
        'chars' => 'characters',
    ],
    'footer' => ['rights' => 'All rights reserved.', 'built' => 'Made with PHP, CSS and lots of coffee.'],
    'notfound' => ['title' => 'Page not found', 'text' => "Looks like this record doesn't exist in the table. Shall we go back home?", 'cta' => 'Back to home'],
    'resume' => [
        'title' => 'Resume', 'profile' => 'Profile', 'experience' => 'Experience and Education', 'skills' => 'Skills',
        'projects' => 'Projects', 'contact' => 'Contact', 'print' => 'Save / print PDF', 'back' => 'Back to portfolio',
    ],
];

foreach (['pt', 'en'] as $l) {
    ${$l}['shared'] = compact('stack', 'marquee', 'projects');
}

return ['pt' => $pt, 'en' => $en];
