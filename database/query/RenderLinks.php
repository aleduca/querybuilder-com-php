<?php

namespace Database\Query;

class RenderLinks
{
    protected static $linksPerPage = 5;

    private static function queryString()
    {
        if (isset($_SERVER['QUERY_STRING'])) {
            $str = preg_replace("/(\?|&)?page=[0-9]+/i", '', $_SERVER['QUERY_STRING']);
            $str = str_replace(['?', '&'], ['', ''], $str);
            return (strlen($str) === 0) ? '' : $str . '&';
        }
    }

    public static function render($totalRegisters, $limit)
    {
        $totalPages = ceil($totalRegisters / $limit);

        $currentPage = $_GET['page'] ?? 1;

        $startLinks = 1;
        if ($currentPage > static::$linksPerPage) {
            $startLinks = $currentPage - static::$linksPerPage;
        }

        $endLinks = $totalPages;
        if (($currentPage + static::$linksPerPage) < $totalPages) {
            $endLinks = $currentPage + static::$linksPerPage;
        }

        $query = static::queryString();

        $links = '<ul class="pagination">';

        if ($currentPage > 1) {
            $previousPage = $currentPage - 1;
            $links .= "<li class='page-item'> <a class='page-link' href='?{$query}page=1'>First</a></li>";
            $links .= "<li class='page-item'> <a class='page-link' href='?{$query}page={$previousPage}'>Previous</a></li>";
        }

        for ($i = $startLinks; $i <= $endLinks ; $i++) {
            $active = $currentPage == $i ? 'active' : '';
            $links .= "<li class='page-item {$active}'> <a class='page-link' href='?{$query}page={$i}'> {$i} </a></li>";
        }

        if ($currentPage < $totalPages) {
            $nextPage = $currentPage + 1;
            $links .= "<li class='page-item'> <a class='page-link' href='?{$query}page={$nextPage}'>Next</a></li>";
            $links .= "<li class='page-item'> <a class='page-link' href='?{$query}page={$totalPages}'>Last</a></li>";
        }

        $links .= '</ul>';

        return $links;
    }
}
