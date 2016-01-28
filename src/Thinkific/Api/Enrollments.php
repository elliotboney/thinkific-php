<?php

namespace Thinkific\Api;

class Enrollments extends AbstractApi {

    public function add( $data ) {
        return json_decode( $this->client->request( [
            "endpoint"   => strtolower( array_pop( preg_split( '/\\\/', get_class( $this ) ) ) ),
            "httpmethod" => "POST",
            "query"      => $data
        ] ), true );
    }

    public function query( $data ) {
        return json_decode( $this->client->request( [
            "endpoint"   => strtolower( array_pop( preg_split( '/\\\/', get_class( $this ) ) ) ),
            "httpmethod" => "GET",
            "query"      => $data
        ] ), true );
    }

}