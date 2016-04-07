<?php

namespace Thinkific\Api;

class Users extends AbstractApi {

    public function query( $data ) {
            return json_decode( $this->client->request( [
                "endpoint"   => strtolower( array_pop( preg_split( '/\\\/', get_class( $this ) ) ) ),
                "httpmethod" => "GET",
                "query" =>  $data
            ]), true );
    }

}