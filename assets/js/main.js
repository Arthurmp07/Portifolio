/* ==========================================================================
   Portfólio — Arthur Mello Pimentel
   JavaScript puro (sem jQuery/Bootstrap). Cada módulo é independente e
   só roda se os elementos correspondentes existirem na página.
   ========================================================================== */
(() => {
    'use strict';

    const $ = (sel, root = document) => root.querySelector(sel);
    const $$ = (sel, root = document) => [...root.querySelectorAll(sel)];
    const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    const finePointer = window.matchMedia('(hover: hover) and (pointer: fine)').matches;
    const root = document.documentElement;

    /* ---------- Tema ---------- */
    const themeBtn = $('#theme-toggle');
    if (themeBtn) {
        themeBtn.addEventListener('click', () => {
            const next = root.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
            root.setAttribute('data-theme', next);
            try { localStorage.setItem('theme', next); } catch (e) { /* ignore */ }
            const meta = $('meta[name="theme-color"]');
            if (meta) meta.setAttribute('content', next === 'dark' ? '#070b14' : '#f5f7fb');
        });
    }

    /* ---------- Navegação, progresso e "voltar ao topo" ---------- */
    const nav = $('#nav');
    const toTop = $('#to-top');
    const burger = $('#nav-burger');
    const navLinks = $('#nav-links');

    const onScroll = () => {
        const y = window.scrollY;
        const max = document.documentElement.scrollHeight - window.innerHeight;
        root.style.setProperty('--progress', max > 0 ? (y / max).toFixed(4) : 0);
        if (nav) nav.classList.toggle('is-scrolled', y > 24);
        if (toTop) toTop.classList.toggle('is-visible', y > 600);
    };
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();

    if (burger && navLinks) {
        const setOpen = (open) => {
            navLinks.classList.toggle('is-open', open);
            burger.setAttribute('aria-expanded', String(open));
        };
        burger.addEventListener('click', () => setOpen(!navLinks.classList.contains('is-open')));
        navLinks.addEventListener('click', (e) => { if (e.target.closest('a')) setOpen(false); });
        document.addEventListener('keydown', (e) => { if (e.key === 'Escape') setOpen(false); });
        document.addEventListener('click', (e) => { if (!e.target.closest('.nav')) setOpen(false); });
    }

    // Link ativo conforme a seção visível
    const sectionIds = $$('[data-nav]').map((a) => a.dataset.nav);
    if (sectionIds.length && 'IntersectionObserver' in window) {
        const links = new Map($$('[data-nav]').map((a) => [a.dataset.nav, a]));
        const spy = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting) return;
                links.forEach((a) => a.classList.remove('is-active'));
                const link = links.get(entry.target.id);
                if (link) link.classList.add('is-active');
            });
        }, { rootMargin: '-45% 0px -50% 0px' });
        sectionIds.forEach((id) => { const el = document.getElementById(id); if (el) spy.observe(el); });
    }

    // Troca de idioma: mantém o usuário na mesma seção (o idioma é resolvido no servidor)
    $$('[data-lang-link]').forEach((a) => {
        a.addEventListener('click', () => {
            const current = $('.nav__links a.is-active');
            const base = a.getAttribute('href').split('#')[0];
            a.setAttribute('href', base + (current ? '#' + current.dataset.nav : ''));
        });
    });

    /* ---------- Reveal on scroll + contadores ---------- */
    const formatNumber = (n, plain) => (plain ? String(n) : n.toLocaleString(document.documentElement.lang || 'pt-BR'));

    const animateCount = (el) => {
        const target = parseInt(el.dataset.count, 10) || 0;
        const plain = el.dataset.plain === '1';
        if (reduceMotion || target === 0) { el.textContent = formatNumber(target, plain); return; }
        const duration = 1400;
        const start = performance.now();
        const tick = (now) => {
            const p = Math.max(0, Math.min((now - start) / duration, 1));
            const eased = 1 - Math.pow(1 - p, 4);
            el.textContent = formatNumber(Math.round(target * eased), plain);
            if (p < 1) requestAnimationFrame(tick);
        };
        requestAnimationFrame(tick);
    };

    if ('IntersectionObserver' in window) {
        const io = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting) return;
                entry.target.classList.add('is-in');
                $$('[data-count]', entry.target).forEach(animateCount);
                if (entry.target.matches('[data-count]')) animateCount(entry.target);
                io.unobserve(entry.target);
            });
        }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });
        $$('.reveal').forEach((el) => io.observe(el));
    } else {
        $$('.reveal').forEach((el) => el.classList.add('is-in'));
        $$('[data-count]').forEach(animateCount);
    }

    /* ---------- Efeito de digitação (cargos) ---------- */
    const typed = $('#typed');
    if (typed) {
        let words = [];
        try { words = JSON.parse(typed.dataset.words || '[]'); } catch (e) { /* ignore */ }
        if (words.length > 1 && !reduceMotion) {
            let w = 0, i = words[0].length, deleting = true;
            const step = () => {
                const word = words[w];
                typed.textContent = word.slice(0, i);
                let delay = deleting ? 38 : 85;
                if (!deleting && i === word.length) { deleting = true; delay = 1800; }
                else if (deleting && i === 0) { deleting = false; w = (w + 1) % words.length; delay = 350; }
                i += deleting ? -1 : 1;
                setTimeout(step, delay);
            };
            setTimeout(step, 2200);
        }
    }

    /* ---------- Terminal do hero (código digitado com syntax highlight) ---------- */
    const terminal = $('#terminal code');
    if (terminal) {
        const source = [
            '# Pipeline medalhão no Databricks',
            'def run_pipeline():',
            '    bronze = ingest("api", "database")',
            '    silver = standardize(bronze)',
            '    validate(silver)',
            '    gold = model(silver)',
            '    publish(gold, "power_bi")',
            '',
            'run_pipeline()',
            '# ✔ 12480 rows → gold.fact_sales',
        ].join('\n');

        const esc = (s) => s.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
        const re = /(#[^\n]*)|("[^"\n]*")|\b(import|from|def|return|as)\b|\b([A-Za-z_]\w*)(?=\()|\b(\d+)\b/g;
        const highlighted = esc(source).replace(re, (m, cm, str, kw, fn, num) => {
            if (cm) return `<span class="${m.includes('✔') ? 't-ok' : 't-cm'}">${m}</span>`;
            if (str) return `<span class="t-str">${m}</span>`;
            if (kw) return `<span class="t-kw">${m}</span>`;
            if (fn) return `<span class="t-fn">${m}</span>`;
            if (num) return `<span class="t-num">${m}</span>`;
            return m;
        });
        terminal.innerHTML = highlighted;

        const counter = $('#rows-counter');
        if (counter) counter.dataset.count = counter.dataset.target;
        const finish = () => { if (counter) animateCount(counter); };

        if (reduceMotion) {
            finish();
        } else {
            const walker = document.createTreeWalker(terminal, NodeFilter.SHOW_TEXT);
            const nodes = [];
            while (walker.nextNode()) nodes.push({ node: walker.currentNode, text: walker.currentNode.nodeValue });
            nodes.forEach((n) => { n.node.nodeValue = ''; });
            // Reserva a altura final para o layout não "pular" enquanto digita
            const body = terminal.parentElement;
            body.style.minHeight = body.offsetHeight + 'px';

            let ni = 0, ci = 0;
            const type = () => {
                if (ni >= nodes.length) { finish(); return; }
                const cur = nodes[ni];
                ci += 1;
                cur.node.nodeValue = cur.text.slice(0, ci);
                if (ci >= cur.text.length) { ni += 1; ci = 0; }
                const ch = cur.text[ci - 1];
                setTimeout(type, ch === '\n' ? 110 : 16 + Math.random() * 22);
            };
            setTimeout(type, 700);
        }
    }

    /* ---------- Canvas: dados fluindo pela grade (hero) ---------- */
    const canvas = $('#flow-canvas');
    if (canvas && !reduceMotion) {
        const ctx = canvas.getContext('2d');
        const GRID = 56;
        const TRAIL = 16;
        let w = 0, h = 0, dpr = 1, running = true, packets = [], palette = [];

        const readPalette = () => {
            const cs = getComputedStyle(root);
            palette = ['--accent', '--accent-2', '--accent-3'].map((v) => cs.getPropertyValue(v).trim() || '#22d3ee');
        };
        const hexToRgb = (hex) => {
            let c = hex.replace('#', '');
            if (c.length === 3) c = c.split('').map((x) => x + x).join('');
            const n = parseInt(c, 16);
            return [(n >> 16) & 255, (n >> 8) & 255, n & 255];
        };

        const spawn = () => {
            const horizontal = Math.random() < 0.5;
            const color = hexToRgb(palette[Math.floor(Math.random() * palette.length)]);
            const cols = Math.floor(w / GRID), rows = Math.floor(h / GRID);
            const p = {
                x: Math.floor(Math.random() * cols) * GRID,
                y: Math.floor(Math.random() * rows) * GRID,
                dx: horizontal ? (Math.random() < 0.5 ? 1 : -1) : 0,
                dy: horizontal ? 0 : (Math.random() < 0.5 ? 1 : -1),
                speed: 0.5 + Math.random() * 1.1,
                color, trail: [], life: 0, maxLife: 260 + Math.random() * 380,
            };
            return p;
        };

        const resize = () => {
            const rect = canvas.getBoundingClientRect();
            dpr = Math.min(window.devicePixelRatio || 1, 2);
            w = rect.width; h = rect.height;
            canvas.width = w * dpr; canvas.height = h * dpr;
            ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
            const count = Math.max(10, Math.min(32, Math.round(w / 48)));
            packets = Array.from({ length: count }, spawn);
        };

        const frame = () => {
            if (!running) return;
            ctx.clearRect(0, 0, w, h);
            packets.forEach((p, idx) => {
                p.x += p.dx * p.speed;
                p.y += p.dy * p.speed;
                p.life += 1;

                // Ao cruzar uma interseção da grade, pode virar 90°
                const onX = Math.abs(p.x / GRID - Math.round(p.x / GRID)) * GRID < p.speed;
                const onY = Math.abs(p.y / GRID - Math.round(p.y / GRID)) * GRID < p.speed;
                if (onX && onY && Math.random() < 0.18) {
                    p.x = Math.round(p.x / GRID) * GRID; p.y = Math.round(p.y / GRID) * GRID;
                    if (p.dx !== 0) { p.dy = Math.random() < 0.5 ? 1 : -1; p.dx = 0; }
                    else { p.dx = Math.random() < 0.5 ? 1 : -1; p.dy = 0; }
                }

                p.trail.push({ x: p.x, y: p.y });
                if (p.trail.length > TRAIL * 2) p.trail.shift();

                if (p.life > p.maxLife || p.x < -GRID || p.y < -GRID || p.x > w + GRID || p.y > h + GRID) {
                    packets[idx] = spawn();
                    return;
                }

                const [r, g, b] = p.color;
                const fadeIn = Math.min(p.life / 40, 1), fadeOut = Math.min((p.maxLife - p.life) / 40, 1);
                const a = Math.max(0, Math.min(fadeIn, fadeOut));
                ctx.lineCap = 'round'; ctx.lineWidth = 2;
                for (let i = 1; i < p.trail.length; i++) {
                    const t = i / p.trail.length;
                    ctx.strokeStyle = `rgba(${r},${g},${b},${(t * 0.65 * a).toFixed(3)})`;
                    ctx.beginPath();
                    ctx.moveTo(p.trail[i - 1].x, p.trail[i - 1].y);
                    ctx.lineTo(p.trail[i].x, p.trail[i].y);
                    ctx.stroke();
                }
                ctx.fillStyle = `rgba(${r},${g},${b},${(0.95 * a).toFixed(3)})`;
                ctx.shadowColor = `rgb(${r},${g},${b})`; ctx.shadowBlur = 12;
                ctx.beginPath(); ctx.arc(p.x, p.y, 2.4, 0, Math.PI * 2); ctx.fill();
                ctx.shadowBlur = 0;
            });
            requestAnimationFrame(frame);
        };

        const setRunning = (state) => { if (state && !running) { running = true; requestAnimationFrame(frame); } else if (!state) { running = false; } };

        readPalette();
        resize();
        let resizeTimer;
        window.addEventListener('resize', () => { clearTimeout(resizeTimer); resizeTimer = setTimeout(resize, 150); });
        new MutationObserver(readPalette).observe(root, { attributes: true, attributeFilter: ['data-theme'] });
        if ('IntersectionObserver' in window) {
            new IntersectionObserver(([entry]) => setRunning(entry.isIntersecting), { threshold: 0 }).observe(canvas);
        }
        document.addEventListener('visibilitychange', () => setRunning(!document.hidden));
        requestAnimationFrame(frame);
    }

    /* ---------- Tilt 3D (apenas com mouse) ---------- */
    if (finePointer && !reduceMotion) {
        $$('[data-tilt]').forEach((el) => {
            el.addEventListener('pointermove', (e) => {
                const r = el.getBoundingClientRect();
                const x = (e.clientX - r.left) / r.width - 0.5;
                const y = (e.clientY - r.top) / r.height - 0.5;
                el.style.transform = `perspective(900px) rotateY(${(x * 8).toFixed(2)}deg) rotateX(${(-y * 8).toFixed(2)}deg)`;
            });
            el.addEventListener('pointerleave', () => { el.style.transform = ''; });
        });
    }

    /* ---------- Spotlight nos cartões ---------- */
    if (finePointer) {
        document.addEventListener('pointermove', (e) => {
            const card = e.target.closest && e.target.closest('.spot');
            if (!card) return;
            const r = card.getBoundingClientRect();
            card.style.setProperty('--mx', `${e.clientX - r.left}px`);
            card.style.setProperty('--my', `${e.clientY - r.top}px`);
        }, { passive: true });
    }

    /* ---------- Pipeline interativo ---------- */
    const pipeline = $('#pipeline-widget');
    if (pipeline) {
        const nodes = $$('.pipeline__node', pipeline);
        const panels = $$('.pipeline__panel', pipeline);
        const total = nodes.length;
        let current = 0, timer = null, userControlled = false, visible = false;

        const select = (index, focus = false) => {
            current = (index + total) % total;
            nodes.forEach((n, i) => {
                n.classList.toggle('is-active', i === current);
                n.classList.toggle('is-done', i < current);
                n.setAttribute('aria-selected', String(i === current));
                n.tabIndex = i === current ? 0 : -1;
            });
            panels.forEach((p, i) => {
                p.hidden = i !== current;
                p.classList.toggle('is-active', i === current);
            });
            pipeline.style.setProperty('--fill', `${(current / (total - 1)) * 100}%`);
            if (focus) nodes[current].focus();
        };

        const stop = () => { clearInterval(timer); timer = null; };
        const play = () => {
            if (userControlled || reduceMotion || timer || !visible) return;
            timer = setInterval(() => select(current + 1), 5500);
        };

        nodes.forEach((n, i) => {
            n.addEventListener('click', () => { userControlled = true; stop(); select(i); });
            n.addEventListener('keydown', (e) => {
                const keys = { ArrowRight: 1, ArrowDown: 1, ArrowLeft: -1, ArrowUp: -1 };
                if (e.key in keys) { e.preventDefault(); userControlled = true; stop(); select(current + keys[e.key], true); }
                if (e.key === 'Home') { e.preventDefault(); select(0, true); }
                if (e.key === 'End') { e.preventDefault(); select(total - 1, true); }
            });
        });

        select(0);
        if ('IntersectionObserver' in window) {
            new IntersectionObserver(([entry]) => { visible = entry.isIntersecting; visible ? play() : stop(); }, { threshold: 0.35 }).observe(pipeline);
        }
    }

    /* ---------- Projetos: filtro + modal ---------- */
    const grid = $('#projects-grid');
    if (grid) {
        const cards = $$('.project', grid);

        $$('.filter').forEach((btn) => {
            btn.addEventListener('click', () => {
                $$('.filter').forEach((b) => { b.classList.remove('is-active'); b.setAttribute('aria-pressed', 'false'); });
                btn.classList.add('is-active');
                btn.setAttribute('aria-pressed', 'true');
                const f = btn.dataset.filter;
                cards.forEach((c) => c.classList.add('is-filtering'));
                setTimeout(() => {
                    cards.forEach((c) => {
                        c.classList.toggle('is-hidden', f !== 'all' && c.dataset.cat !== f);
                        c.classList.add('is-in');
                    });
                    requestAnimationFrame(() => cards.forEach((c) => c.classList.remove('is-filtering')));
                }, reduceMotion ? 0 : 260);
            });
        });

        const modal = $('#project-modal');
        if (modal && typeof modal.showModal === 'function') {
            const open = (card) => {
                const d = card.dataset;
                $('#modal-title').textContent = d.title;
                $('#modal-desc').textContent = d.desc;
                const status = $('#modal-status');
                const src = $('.status', card);
                status.textContent = src ? src.textContent : '';
                status.className = 'status status--' + d.status;
                $('#modal-tags').innerHTML = d.tags.split('|').map((t) => `<li>${t.replace(/[<>&]/g, '')}</li>`).join('');

                const media = $('#modal-media');
                media.innerHTML = '';
                const images = (d.images || '').split('|').filter(Boolean);
                if (images.length) {
                    const main = document.createElement('img');
                    main.src = images[0];
                    main.alt = d.title;
                    media.appendChild(main);
                    if (images.length > 1) {
                        const thumbs = document.createElement('div');
                        thumbs.className = 'modal__thumbs';
                        images.forEach((src, i) => {
                            const b = document.createElement('button');
                            b.type = 'button';
                            b.setAttribute('aria-label', `${d.title} ${i + 1}/${images.length}`);
                            b.className = i === 0 ? 'is-active' : '';
                            b.innerHTML = `<img src="${src}" alt="">`;
                            b.addEventListener('click', () => {
                                main.src = src;
                                $$('button', thumbs).forEach((x) => x.classList.toggle('is-active', x === b));
                            });
                            thumbs.appendChild(b);
                        });
                        media.appendChild(thumbs);
                    }
                } else {
                    const art = $('.project__art', card);
                    if (art) media.appendChild(art.cloneNode(true));
                }

                const actions = $('#modal-actions');
                actions.innerHTML = '';
                const link = $('.project__actions a', card);
                if (link) {
                    const a = link.cloneNode(true);
                    a.className = 'btn btn--primary';
                    actions.appendChild(a);
                }
                modal.showModal();
            };
            cards.forEach((card) => {
                $('[data-open-project]', card).addEventListener('click', () => open(card));
            });
            // Fecha no botão "X" ou ao clicar no backdrop (fora do .modal__inner)
            modal.addEventListener('click', (e) => { if (e.target === modal || e.target.closest('[data-close]')) modal.close(); });
        }
    }

    /* ---------- Formulário de contato ---------- */
    const form = $('#contact-form');
    if (form) {
        const status = $('#form-status');
        const submit = $('#form-submit');
        const submitLabel = $('span', submit);
        const message = $('#f-message');
        const count = $('#char-count');

        message.addEventListener('input', () => { count.textContent = message.value.length; });

        const setStatus = (text, kind) => { status.textContent = text; status.className = 'form__status' + (kind ? ' is-' + kind : ''); };

        const validate = () => {
            let ok = true;
            $$('.field', form).forEach((field) => {
                const input = $('input, textarea', field);
                const valid = input.checkValidity() && input.value.trim() !== '';
                field.classList.toggle('is-invalid', !valid);
                input.setAttribute('aria-invalid', String(!valid));
                if (!valid) ok = false;
            });
            return ok;
        };
        $$('input, textarea', form).forEach((el) => el.addEventListener('input', () => el.closest('.field')?.classList.remove('is-invalid')));

        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            setStatus('', '');
            if (!validate()) { setStatus(form.dataset.msgInvalid, 'err'); return; }

            submit.disabled = true;
            submitLabel.textContent = form.dataset.labelSending;
            try {
                const res = await fetch(form.action, {
                    method: 'POST',
                    body: new FormData(form),
                    headers: { Accept: 'application/json' },
                    credentials: 'same-origin',
                });
                const data = await res.json().catch(() => ({}));
                if (res.ok && data.ok) {
                    setStatus(form.dataset.msgSuccess, 'ok');
                    form.reset();
                    count.textContent = '0';
                } else if (res.status === 429) {
                    setStatus(form.dataset.msgRate, 'err');
                } else if (res.status === 422) {
                    setStatus(form.dataset.msgInvalid, 'err');
                } else {
                    setStatus(form.dataset.msgError, 'err');
                }
            } catch (err) {
                setStatus(form.dataset.msgError, 'err');
            } finally {
                submit.disabled = false;
                submitLabel.textContent = form.dataset.labelSend;
            }
        });
    }
})();
