<?php

namespace App\Virtual;

/**
 * @OA\Schema(
 *      title="Store Brand request",
 *      description="Store Brand request body data",
 *      type="object",
 *      required={"name"}
 * )
 */

class StoreBrandRequest
{

    /**
     * @OA\Property(
     *      title="name",
     *      description="Name of the new brand",
     *      example="A car brand"
     * )
     *
     * @var string
     */
    public $name;
}
