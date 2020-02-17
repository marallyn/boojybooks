<?php
namespace App\Traits;

/**
 * This trait is used to add interactivity with the openLibrary api to
 * controllers that need to search for books, or get their details
 */

trait OpenLibrary {
    static $SEARCH_URL = 'http://openlibrary.org/search.json';
    static $DETAIL_URL = 'https://openlibrary.org/api/books';

    /**
     * Takes an isbn and kindly asks openlibrary for some details
     *
     * @param string $isbn an isbn_13 string
     * @return void
     */
    public function bookDetail(string $isbn) : object
    {
        $client = new \GuzzleHttp\Client();

        try {
            $response = $client->request(
                'GET',
                self::$DETAIL_URL,
                [
                    'query' => [
                        'bibkeys' => 'ISBN:' . $isbn,
                        'format' => 'json',
                        'jscmd' => 'data'
                    ]
                ]
            );

            $json =  \json_decode($response->getBody());

            $result = $json->{"ISBN:$isbn"};
        } catch (\Throwable $th) {
            // something did not work on the api end, so fail gracefully
            $result =  new \StdClass();
        }

        return $result;
    }

    /**
     * Search OpenLibrary for books
     *
     * @param string $field either: author, subject or title
     * @param string $query the search term we are looking for
     * @param int $page the result page to return (for results > 100)
     * @return void
     */
    public function searchForBooks(string $field, string $query, int $page = 1) : object
    {
        // limit the search field to one of these values
        $field = \in_array(\strtolower($field), ['author', 'subject', 'title'])
            ? \strtolower($field)
            : 'title';
            
        $client = new \GuzzleHttp\Client();

        try {
            $response = $client->request(
                'GET',
                self::$SEARCH_URL,
                [
                    'query' => [
                        $field => $query,
                        'page' => $page
                    ]
                ]
            );

            $result = \json_decode($response->getBody());
        } catch (\Throwable $th) {
            // something did not work on the api end, so fail gracefully
            $result = (object) [
                'num_found' => 0,
                'docs' => []
            ];
        }

        return $result;
    }
}
