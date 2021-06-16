<?php


namespace FourelloDevs\Paymaya\Models;

/**
 * Class FundSource
 * @package FourelloDevs\Paymaya\Models
 *
 * @author James Carlo Luchavez <carlo.luchavez@fourello.com>
 * @since 2021-06-16
 */
class FundSource extends BaseModel
{
    /**
     * @example card
     *
     * @var
     */
    public $type;

    /**
     * @example RtFLi5o2YaAWMpCQ7nK4hO4VZYMZitobaM4bwwN5ckhYzTHDJMau6I6MaUcbAAChX4mdyABpclOpHOCiYSA9W41MBuNziuEhumGznL3mb6au76uf45xfBUDXIzg9LlFyf9SDILzxuhZBEZ8irKYeP9Spq4IA1uhEk2lknk1E
     *
     * @var
     */
    public $id;

    /**
     * @example **** **** **** 4443
     *
     * @var
     */
    public $description;

    /**
     * @var array
     */
    public $details;
}
