<?php
declare(strict_types=1);

/**
 * Busca estatísticas públicas do GitHub com cache em arquivo.
 * Retorna null se a API estiver indisponível (o painel simplesmente não é exibido).
 */
function github_stats(string $user, int $ttl = 3600): ?array
{
    if ($user === '') {
        return null;
    }

    $cacheFile = __DIR__ . '/../storage/cache/github_' . preg_replace('/[^a-z0-9_-]/i', '', $user) . '.json';

    if (is_file($cacheFile) && (time() - filemtime($cacheFile)) < $ttl) {
        $cached = json_decode((string) file_get_contents($cacheFile), true);
        if (is_array($cached)) {
            return $cached;
        }
    }

    $profile = github_request("https://api.github.com/users/{$user}");
    $repos   = github_request("https://api.github.com/users/{$user}/repos?per_page=100&sort=updated");

    if (!is_array($profile) || !is_array($repos) || !isset($profile['public_repos'])) {
        // Se houver cache antigo, usa-o em vez de falhar.
        if (is_file($cacheFile)) {
            $stale = json_decode((string) file_get_contents($cacheFile), true);
            return is_array($stale) ? $stale : null;
        }
        return null;
    }

    $langs = [];
    foreach ($repos as $repo) {
        if (!empty($repo['language']) && empty($repo['fork'])) {
            $langs[$repo['language']] = ($langs[$repo['language']] ?? 0) + 1;
        }
    }
    arsort($langs);
    $total = array_sum($langs) ?: 1;

    $topLangs = [];
    foreach (array_slice($langs, 0, 5, true) as $name => $count) {
        $topLangs[] = ['name' => $name, 'percent' => round($count / $total * 100)];
    }

    $stats = [
        'repos'     => (int) $profile['public_repos'],
        'followers' => (int) ($profile['followers'] ?? 0),
        'url'       => (string) ($profile['html_url'] ?? "https://github.com/{$user}"),
        'langs'     => $topLangs,
    ];

    @file_put_contents($cacheFile, json_encode($stats), LOCK_EX);
    return $stats;
}

function github_request(string $url): mixed
{
    if (!function_exists('curl_init')) {
        return null;
    }
    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT        => 4,
        CURLOPT_CONNECTTIMEOUT => 3,
        CURLOPT_HTTPHEADER     => ['User-Agent: portfolio-site', 'Accept: application/vnd.github+json'],
    ]);
    $body = curl_exec($ch);
    $code = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    return ($body !== false && $code === 200) ? json_decode($body, true) : null;
}
