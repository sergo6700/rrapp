<?php

namespace App\Support\Filter\Contract;

/**
 * Interface Filter
 * @package App\Support\Filter\Contract
 */
interface Filter
{
	/**
	 * Get month
	 * @return mixed
	 */
	public function getMonth();

	/**
	 * Get year
	 * @return mixed
	 */
	public function getYear();

	/**
	 * Get all non-empty values
	 * @return mixed
	 */
	public function getValues();
}
