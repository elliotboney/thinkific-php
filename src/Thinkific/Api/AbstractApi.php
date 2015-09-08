<?php
namespace Thinkific\Api;

use Thinkific\Thinkific;

abstract class AbstractApi {

    public function __construct( Thinkific $client ) {
        $this->client = $client;
    }

    /**
     * @return mixed
     */
    public function getAll() {
        return json_decode( $this->client->request( [
            "endpoint" => strtolower( array_pop( preg_split( '/\\\/', get_class( $this ) ) ) ),
        ] ), true )['items'];
    }

    /**
     * Get an object by Id
     * @param $id
     *
     * @return object
     */
    public function getById( $id ) {

        return json_decode( $this->client->request( [
            "endpoint" => strtolower( array_pop( preg_split( '/\\\/', get_class( $this ) ) ) ),
            "id"       => $id,
        ] ) );
    }

    /**
     * Add something via the Api
     * @param $data
     *
     * @return mixed
     * @throws ApiException
     */
    public function add( $data ) {
        $result = json_decode( $this->client->request( [
            "endpoint"   => strtolower( array_pop( preg_split( '/\\\/', get_class( $this ) ) ) ),
            "httpmethod" => "POST",
            "body"       => $data
        ] ), true );

        if ( isset( $result["errors"] ) ) {
            throw new ApiException( $result["errors"] );
        } else {
            return $result;
        }
    }

    /**
     * Updates a User
     *
     * @param $id   - Id of what to update
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
     * Delete by Id
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