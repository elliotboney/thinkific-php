<?php

namespace Thinkific\Api;

class Users extends AbstractApi {




    /**
     *
     * first_name*
     * last_name*
     * password*
     * email*
     * roles - array of String
     * avatar_url
     * bio
     * headline
     * affiliate_code
     * affiliate_commission
     * affiliate_payout_email
     *
     * @param $data
     *
     * @return mixed
     * @throws ApiException
     */
    public function add( $data ) {
        $result = json_decode( $this->client->request( [
            "endpoint" => strtolower( array_pop( preg_split( '/\\\/', get_class( $this ) ) ) ),
            "httpmethod" => "POST",
            "body"     => $data
        ] ), true );

        if (isset($result["errors"])) {
            throw new ApiException($result["errors"]);
        } else {
            return $result;
        }
    }

    /**
     * Updates a User
     *
     * @param $id - Id of the user
     * @param $data - Array of information to update
     *
     *
     * @return mixed
     * @throws ApiException
     */
    public function update( $id, $data ) {
        $result = json_decode( $this->client->request( [
            "endpoint"   => strtolower( array_pop( preg_split( '/\\\/', get_class( $this ) ) ) ),
            "httpmethod" => "PUT",
            "id"         => $id,
            "body"       => $data
        ] ) );

        if ( isset( $result["errors"] ) ) {
            throw new ApiException( $result["errors"] );
        } else {
            return $result;
        }

    }

    /**
     * Delete user by Id
     *
     * @param $id
     *
     * @return mixed
     */
    public function delete( $id ) {
        return json_decode( $this->client->request( [
            "endpoint"   => strtolower( array_pop( preg_split( '/\\\/', get_class( $this ) ) ) ),
            "httpmethod" => "DELETE",
            "id"         => $id
        ] ) );
    }
}