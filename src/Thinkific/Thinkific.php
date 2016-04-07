<?php

namespace Thinkific;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class Thinkific {

    protected $url = "https://api.thinkific.com/api/public/";
    protected $apiversion = 1;

    protected $httpClient;

    private $apikey;
    private $subdomain;

    protected $apis = [ ];
    protected $debug = false;

    function __construct( $config = [ ] ) {

        if ( isset( $config['apikey'] ) ) {
            $this->apikey = $config['apikey'];
        }
        if ( isset( $config['subdomain'] ) ) {
            $this->subdomain = $config['subdomain'];
        }
        if ( isset( $config['debug'] ) ) {
            $this->debug = $config['debug'];
        }

    }

    public function __call( $method, $args ) {
        return $this->getApi( ucwords( $method ) );
    }

    /**
     * Returns the requested class name, optionally using a cached array so no
     * object is instantiated more than once during a request.
     *
     * @param string $class
     *
     * @return mixed
     */
    private function getApi( $class ) {
        $class = '\Thinkific\Api\\' . $class;

        if ( ! array_key_exists( $class, $this->apis ) ) {
            $this->apis[ $class ] = new $class( $this );
        }

        return $this->apis[ $class ];
    }

    /**
     * Create a Guzzle HTTP request
     *
     * @param $options
     *
     * @return mixed
     */
    public function request( $options ) {
        $reqoptions = [ ];

        $endpoint = $options['endpoint'];
        $method   = isset( $options['httpmethod'] ) ? $options['httpmethod'] : 'GET';
        $body     = isset( $options['body'] ) ? $options['body'] : [ ];

        $url = $this->url . "v" . $this->apiversion . "/" . $endpoint;

        if ( isset( $options['id'] ) ) {
            $url .= "/" . $options['id'];
        }

        if ( isset( $options['query'] ) ) {
            $url .= "?" . http_build_query( $options['query'] );
        }

        $reqoptions['headers'] = [
//            'User-Agent'       => 'thinkific-php/1.0',
            'Accept'           => 'application/json',
            'X-Auth-API-Key'   => $this->apikey,
            'X-Auth-Subdomain' => $this->subdomain
        ];

        if ( count( $body ) > 0 ) {
            $reqoptions['body'] = json_encode( $body );
        }

        try {
            $client = new Client();

            $response = $client->request( $method, $url, $reqoptions );

            //            echo "<pre>$url</pre>";

            return $response->getBody();
        } catch ( ClientException $ex ) {
//            print_r( $options );
//            echo "<pre>";
            return "\nError while trying to " . $method . ' ' . $url . " --> " . $ex->getCode() . " --> " . $ex->getMessage() . "\n" . $ex->getResponse()->getBody();
//            echo "\n---------\n";
//            echo $ex->getRequest()->getBody();
//            echo "</pre>";

        } catch ( \Exception $e ) {
            return "\nError while trying to " . $method . ' ' . $url . " --> " . $e->getCode() . " --> " . $e->getMessage();
        }
    }

}


