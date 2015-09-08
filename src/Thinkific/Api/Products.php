<?php

namespace Thinkific\Api;

class Products extends AbstractApi {

    /**
     * @throws ApiException
     */
    public function add() {
        throw new ApiException( [ "Not Supported" => [ "The API Call 'getAll()' is not supported by the Thinkific Api" ] ] );
    }

    /**
     * @throws ApiException
     */
    public function delete() {
        throw new ApiException( [ "Not Supported" => [ "The API Call 'getAll()' is not supported by the Thinkific Api" ] ] );
    }



    /**
     * @throws ApiException
     */
    public function update() {
        throw new ApiException( [ "Not Supported" => [ "The API Call 'getAll()' is not supported by the Thinkific Api" ] ] );
    }
}