<?php

namespace Thinkific\Api;

/**
 * Class Users
 *
 * @package Thinkific\Api
 */
class Users extends AbstractApi {

    public function query( $data ) {
        $class_name = preg_split( '/\\\/', get_class( $this ) );
        return json_decode( $this->client->request( [
            "endpoint"   => strtolower( array_pop( $class_name ) ),
            "httpmethod" => "GET",
            "query" =>  $data
        ]), true );
    }

}
