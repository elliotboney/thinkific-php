<?php

namespace Thinkific\Api;

class Enrollments extends AbstractApi {

    public function add( $data ) {
        $class_name = preg_split( '/\\\/', get_class( $this ) );
        return json_decode( $this->client->request( [
            "endpoint"   => strtolower( array_pop( $class_name ) ),
            "httpmethod" => "POST",
            "query"      => $data
        ] ), true );
    }

    public function query( $data ) {
        $class_name = preg_split( '/\\\/', get_class( $this ) );
        return json_decode( $request = $this->client->request( [
            "endpoint"   => strtolower( array_pop( $class_name ) ),
            "httpmethod" => "GET",
            "query"      => $data
        ] ), true );
    }

}
