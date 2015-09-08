<?php

namespace Thinktastic;

require "vendor/autoload.php";

class Thinkific {

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

        echo "made me for " . $this->subdomain . "thinkific.com!";
    }


    public function users() {
        return $this->getApi( 'Users' );

    }


    /**
     * Returns the requested class name, optionally using a cached array so no
     * object is instantiated more than once during a request.
     *
     * @param string $class
     *
     * @return mixed
     */
    public function getApi( $class ) {
        $class = '\Thinktastic\Api\\' . $class;

        if ( ! array_key_exists( $class, $this->apis ) ) {
            $this->apis[ $class ] = new $class( $this );
        }

        return $this->apis[ $class ];
    }

}


