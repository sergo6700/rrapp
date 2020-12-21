<?php


namespace App\Support\Filter;

use App\Support\Filter\Contract\Filter as BaseFilter;

/**
 * Class Filter
 * @package App\Support\Filter
 */
class Filter implements BaseFilter
{
	/**
	 * @var string|null
	 */
    private $year;

	/**
	 * @var string|null
	 */
    private $month;

	/**
	 * @var string|null
	 */
    private $show_video;

	/**
	 * Filter constructor.
	 * @param string|null $month
	 * @param string|null $year
	 * @param bool|null $show_video
	 */
    public function __construct(string $month = null, string $year = null, bool $show_video = null)
    {
        $this->month = $month;
        $this->year = $year;
        $this->show_video = $show_video;
    }

	/**
	 * Get all non-empty values
	 * @return array
	 */
    public function getValues(): array
    {
        $values = [];
        foreach (get_class_vars(__CLASS__) as $property => $value) {
            if ($this->{$property}) {
                $values[ $property ] = $this->{$property};
            }
        }

        return $values;
    }

	/**
	 * @return string|null
	 */
    public function getMonth(): ?string
    {
        return $this->month;
    }

	/**
	 * @return string|null
	 */
    public function getYear(): ?string
    {
        return $this->year;
    }

	/**
	 * @return bool|null
	 */
    public function getShowVideo(): ?bool
    {
        return $this->show_video;
    }
}

