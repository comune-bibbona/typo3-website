<?php

namespace Aip\Bit3\Domain\Model;

/**
 * Created by PhpStorm.
 * User: abramotesoro
 * Date: 08/11/2024
 * Time: 11.14
 */

/**
 * News
 */
class News extends \GeorgRinger\News\Domain\Model\News
{
    /**
     * @var string
     */
    protected $price;

	/**
	 * @return string
	 */
	public function getPrice()
	{
		return $this->price;
	}

	/**
	 * @param string $price
	 */
	public function setPrice($price)
	{
		$this->price = $price;
	}
}
