# Portfólio — Arthur Mello Pimentel

Portfólio em **PHP** com foco em **Engenharia de Dados**: bilíngue (PT/EN), tema claro/escuro, animações modernas em JavaScript/CSS puros (sem jQuery/Bootstrap) e formulário de contato com back-end próprio.

## Rodando localmente

**XAMPP:** coloque a pasta em `htdocs` e acesse `http://localhost/Portifolio/`.
**Sem XAMPP:** `php -S localhost:8000` na raiz do projeto.

> Requer PHP 8.1+ (usa `match`, `never`, `str_ends_with`). A extensão `curl` é usada pelo painel do GitHub (opcional).

## Estrutura

```
index.php            página principal (monta as seções)
resume.php           currículo otimizado para impressão/PDF
404.php              página de erro personalizada
config/config.php    dados pessoais, redes sociais, opções do formulário
data/content.php     TODO o conteúdo (PT/EN): textos, skills, projetos, experiência
partials/            seções da página (hero, about, stack, pipeline, projects...)
includes/            bootstrap (idioma, helpers) e integração com a API do GitHub
api/contact.php      endpoint do formulário de contato
assets/css, assets/js  estilos e scripts
storage/             mensagens recebidas, cache e rate limit (bloqueado via .htaccess)
```

## Como editar

- **Textos, projetos, skills, experiência:** `data/content.php` (cada idioma tem seu bloco; os dados em `$stack` e `$projects` no topo são compartilhados).
- **Contato, redes sociais, e-mail, início de carreira:** `config/config.php`. Os "anos de experiência" são calculados automaticamente a partir de `career_start`.
- **Novo projeto:** adicione um item em `$projects` (use `image` para um print em `img/`, ou `art` = `bars`/`icon` para um visual gerado) e o texto em `projects.items` nos dois idiomas.
- **Idioma:** o padrão é sempre Português; o visitante troca para EN pelo seletor PT | EN no menu (a escolha fica salva em cookie).
- **Cores/tema:** variáveis no início de `assets/css/style.css`.

## Recursos

- Hero com canvas de dados fluindo, terminal com código digitado e contadores animados
- Seção interativa "Pipeline de dados" (Extração → Transformação → Qualidade → Carga → Visualização)
- Filtro de projetos, modal de detalhes (`<dialog>` nativo) e painel **GitHub ao vivo** (cache de 1h)
- Troca de idioma (PT/EN, lembrada por cookie) e de tema (claro/escuro, lembrado por `localStorage`)
- SEO: meta tags, Open Graph, JSON-LD (Person), `robots.txt`
- Acessibilidade: skip link, navegação por teclado no pipeline, `prefers-reduced-motion`

## Formulário de contato → seu e-mail

`api/contact.php` valida CSRF, honeypot, tempo mínimo de preenchimento e rate limit por IP (3 mensagens / 10 min). Cada mensagem válida é **enviada por SMTP (Gmail) para `Arthurmellopimentel76@gmail.com`** — o visitante fica como *Reply-To*, então basta responder o e-mail — e também gravada em `storage/messages/AAAA-MM.jsonl` como cópia de segurança.

**Ativar o envio (uma vez):**

1. Na conta Google, ative a verificação em duas etapas e crie uma **senha de app** em <https://myaccount.google.com/apppasswords>.
2. Copie `config/mail.local.example.php` para `config/mail.local.php` e cole a senha (16 letras, sem espaços).
   Em hospedagens que permitem, a alternativa é definir a variável de ambiente `SMTP_PASSWORD`.

O `mail.local.php` não vai para o git e a pasta `config/` é bloqueada pelo servidor. Sem a senha configurada, o site tenta o `mail()` nativo (que só funciona em servidores com e-mail configurado). Se o envio falhar, o visitante ainda vê "enviado" (a mensagem fica salva em arquivo) e o motivo é registrado em `storage/mail-errors.log`.

## Hospedagem

PHP precisa de um servidor com PHP (Hostinger, Locaweb, InfinityFree, VPS etc.). **O Netlify não executa PHP**, então o domínio configurado no arquivo `CNAME` (Netlify) não servirá este site como está.
