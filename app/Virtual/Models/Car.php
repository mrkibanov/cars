<?php

namespace App\Virtual\Models;

/**
 * @OA\Schema(
 *     title="Car",
 *     description="Car model",
 *     @OA\Xml(
 *         name="Car"
 *     )
 * )
 */
class Car
{

    /**
     * @OA\Property(
     *     title="ID",
     *     description="ID",
     *     format="int64",
     *     example=1
     * )
     *
     * @var integer
     */
    private $id;

    /**
     * @OA\Property(
     *      title="Name",
     *      description="Name of the new car",
     *      example="A nice car"
     * )
     *
     * @var string
     */
    public $name;

    /**
     * @OA\Property(
     *     title="Created at",
     *     description="Created at",
     *     example="2020-01-27 17:50:45",
     *     format="datetime",
     *     type="string"
     * )
     *
     * @var \DateTime
     */
    private $created_at;

    /**
     * @OA\Property(
     *     title="Updated at",
     *     description="Updated at",
     *     example="2020-01-27 17:50:45",
     *     format="datetime",
     *     type="string"
     * )
     *
     * @var \DateTime
     */
    private $updated_at;

    /**
     * @OA\Property(
     *      title="Brand ID",
     *      description="Car's brand id",
     *      format="int64",
     *      example=1
     * )
     *
     * @var integer
     */
    public $brand_id;
}
