<?php

namespace Thinkific\Api;

class Courses extends AbstractApi {

    /**
     * @param $id
     *
     * @return object
     */
    public function getById( $id ) {
        $class_name = preg_split( '/\\\/', get_class( $this ) );
        return json_decode( $this->client->request( [
            "endpoint" => strtolower( array_pop( $class_name ) ),
            "id"       => $id,
        ] ) );
    }

}
