<?php
namespace App\Contracts;

interface LibraryApi
{
    /**
     * Takes an isbn and returns some details
     *
     * @param string $isbn an isbn_13 string
     * @return void
     */
    public function bookDetail(string $isbn) : object;

    /**
     * Searches for books
     *
     * @param string $field either: author, subject or title
     * @param string $query the search term we are looking for
     * @param int $page the result page to return (for results > 100)
     * @return void
     */
    public function searchForBooks(string $field, string $query, int $page = 1) : object;
}
