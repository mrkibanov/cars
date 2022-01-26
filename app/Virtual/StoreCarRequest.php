<?php

namespace App\Virtual;

/**
 * @OA\Schema(
 *      title="Store Car request",
 *      description="Store Car request body data",
 *      type="object",
 *      required={"name", "brand_id"}
 * )
 */

class StoreCarRequest
{

    /**
     * @OA\Property(
     *      title="name",
     *      description="Name of the new car",
     *      example="A car's name"
     * )
     *
     * @var string
     */
    public $name;

    /**
     * @OA\Property(
     *      title="brand_id",
     *      description="Car's brand id",
     *      format="int64",
     *      example=1
     * )
     *
     * @var integer
     */
    public $brand_id;
}
