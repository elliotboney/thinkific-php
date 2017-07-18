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
        $class_name = preg_split( '/\\\/', get_class( $this ) );
        return json_decode( $this->client->request( [
            "endpoint" => strtolower( array_pop( $class_name ) ),
        ] ), true )['items'];
    }

    /**
     * Get an object by Id
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

    /**
     * Add something via the Api
     * @param $data
     *
     * @return mixed
     * @throws ApiException
     */
    public function add( $data ) {
        $class_name = preg_split( '/\\\/', get_class( $this ) );
        $result = json_decode( $this->client->request( [
            "endpoint"   => strtolower( array_pop( $class_name ) ),
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
        $class_name = preg_split( '/\\\/', get_class( $this ) );
        $result = json_decode( $this->client->request( [
            "endpoint"   => strtolower( array_pop( $class_name ) ),
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
        $class_name = preg_split( '/\\\/', get_class( $this ) );
        return json_decode( $this->client->request( [
            "endpoint"   => strtolower( array_pop( $class_name ) ),
            "httpmethod" => "DELETE",
            "id"         => $id
        ] ) );
    }
}
