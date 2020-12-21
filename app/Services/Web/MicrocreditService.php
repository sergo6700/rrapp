<?php


namespace App\Services\Web;

use App\Enums\MicrocreditProductsEnum;
use App\Enums\OkvedEnum;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

/**
 * Class MicrocreditService
 *
 * @package App\Services\Web
 */
class MicrocreditService
{
    /**
     * Нет залога/поручительства
     *
     * @var string
     */
    protected const NO_PLEDGE = 'no_pledge';

    /**
     * Частитчный залог и поручительство в размере 70%
     *
     * @var string
     */
    protected const PARTIAL_PLEDGE = 'partial_pledge';

    /**
     * Есть залог или поручительство
     *
     * @var string
     */
    protected const PLEDGE_EXISTS = 'pledge_exists';

    /**
     * @var Collection
     */
    protected $all_products;

    /**
     * @var Collection
     */
    protected $filtered_products;

    /**
     * @var Collection
     */
    protected $suited_products;

    /**
     * MicrocreditService constructor.
     */
    public function __construct()
    {
        $this->all_products = new Collection();
        $this->filtered_products = new Collection();
        $this->suited_products = new Collection();
    }

    /**
     * Get calculator
     *
     * @param array $data
     * @return Collection
     */
    public function calculate(array $data)
    {
        $this->all_products = new Collection($this->get_all_products());
        $this->suited_products = new Collection();

        if (in_array($data['reg-date'] ?? 1, [2, 3], false)) {
            $this->filtered_products = $this->all_products->filter(function($item) {
                return $item['is_more_12'];
            });
        } else {
            $this->filtered_products = $this->all_products->filter(function($item) {
                return !$item['is_more_12'];
            });
        }

        $is_noobie = true;
        if (($data['monogorod'] ?? null) == 1) {
            $this->add_product_if_found([MicrocreditProductsEnum::MONO_CITY_BIG, MicrocreditProductsEnum::MONO_CITY_SMALL]);
            $is_noobie = false;
        }

        if ($this->is_easy_start($data)) {
            $this->add_product_if_found([MicrocreditProductsEnum::EASY_START_SMALL]);
            $is_noobie = false;
        }

        if ($is_noobie) {
            $this->add_product_if_found([MicrocreditProductsEnum::ASPIRING_ENTREPRENEUR_SMALL]);
        }

        if ($this->is_priority_small($data)) {
            $this->add_product_if_found([MicrocreditProductsEnum::PRIORITY_SMALL]);
        }

        if ($this->is_priority_big($data)) {
            $this->add_product_if_found([MicrocreditProductsEnum::PRIORITY_BIG]);
        }

        if ($this->is_universal($data)) {
            $this->add_product_if_found([MicrocreditProductsEnum::UNIVERSAL_BIG]);
        }

        if ($this->is_restart($data)) {
            $this->add_product_if_found([MicrocreditProductsEnum::RESTART_BIG]);
        }

        $this->add_product_if_found([MicrocreditProductsEnum::TENDER_BIG]);

        return new Collection($this->change_percent($data));
    }

    /**
     * @param array $ids
     */
    protected function add_product_if_found(array $ids)
    {
        foreach ($ids as $id) {
            $product = $this->filtered_products->where('id', '=', $id)->first();
            if ($product) {
                $this->suited_products->add($product);
                return;
            }
        }
    }

    /**
     * Приоритетный для < 12 мес
     *
     * @param array $data
     * @return bool
     */
    protected function is_priority_small(array $data)
    {
        if ($data['birth-date'] ?? null) {
            return (bool)($data['social'] ?? false);
        }
        $birth_date = Carbon::createFromFormat('Y-m-d', $data['birth-date']);

        return (Carbon::now()->diffInYears($birth_date) > 45) || ($data['social'] ?? null);
    }

    /**
     * Приоритетный для > 12 мес
     *
     * @param array $data
     * @return bool
     */
    protected function is_priority_big(array $data)
    {
        return ($data['gov-program'] ?? false) || ($data['sex'] == 2) || ($data['social'] ?? null);
    }

    /**
     * Универсальный
     *
     * @param array $data
     * @return bool
     */
    protected function is_universal(array $data)
    {
        return ($this->suited_products->count() === 0) && $this->is_in_okveds_haystack($data, OkvedEnum::UNIVERSAL_OKVEDS, false);
    }

    /**
     * Рестарт
     *
     * @param array $data
     * @return bool
     */
    protected function is_restart(array $data)
    {
        return (($data['loan'] ?? '1') === '0');
    }

    /**
     * Компенсирующий продукт
     *
     * @param array $data
     * @return bool
     */
    protected function is_compensating(array $data) : bool
    {
        return false;
    }

    /**
     * Льготный
     *
     * @param array $data
     * @return bool
     */
    protected function is_preferential(array $data) : bool
    {
        return false;
    }

    /**
     * Легкий старт
     *
     * @param array $data
     * @return bool
     */
    protected function is_easy_start(array $data) : bool
    {
        return $this->is_in_okveds_haystack($data, OkvedEnum::EASY_START_OKVEDS, false);
    }

    /**
     * @param array $data
     * @param array $target_okveds
     * @param bool $strict
     * @return bool
     */
    protected function is_in_okveds_haystack(array $data, array $target_okveds, bool $strict) : bool
    {
        if ($data['okveds'] ?? null) {
            if (!is_array($data['okveds'])) {
                $data['okveds'] = [$data['okveds']];
            }
            if ($strict) {
                return count(array_intersect($data['okveds'], $target_okveds)) > 0;
            }

            foreach ($target_okveds as $t_okved) {
                foreach ($data['okveds'] as $h_okved) {
                    if (Str::startsWith($h_okved, $t_okved)) {
                        return true;
                    }
                }
            }
        }
        return false;
    }

    /**
     * Calculate percent for products array
     *
     * @param array $data
     * @return Collection
     */
    protected function change_percent(array $data)
    {
        return $this->suited_products->map(function($product) use ($data) {
            $product['loan_terms'] = array_map(function($term) use ($data) {
                if (($data['surety'] ?? null) || ($data['pledge'] ?? null)) {
                    $term['percent'] = $term['percents'][self::PLEDGE_EXISTS];
                    unset($term['percents']);
                } elseif ($data['part-pledge'] ?? null) {
                    $term['percent'] = $term['percents'][self::PARTIAL_PLEDGE];
                    unset($term['percents']);
                } else {
                    $term['percent'] = $term['percents'][self::NO_PLEDGE];
                    unset($term['percents']);
                }
                return $term;
            }, $product['loan_terms']);
            return $product;
        });
    }

    /**
     * Get all products
     *
     * @return array
     */
    protected function get_all_products()
    {
        return [
            MicrocreditProductsEnum::MONO_CITY_BIG => [
                'id'            => MicrocreditProductsEnum::MONO_CITY_BIG,
                'name'          => 'Моногород',
                'description'   => '',
                'min_loan'      => 100,
                'max_loan'      => 5000,
                'loan_terms'    => [
                    [
                        'month_min' => 1,
                        'month_max' => 24,
                        'percents'  => [
                            self::PLEDGE_EXISTS     => 2.12,
                            self::PARTIAL_PLEDGE    => 4.25,
                            self::NO_PLEDGE         => 4.25,
                        ],
                    ],
                ],
                'is_more_12'    => true,
            ],

            MicrocreditProductsEnum::PRIORITY_BIG => [
                'id'            => MicrocreditProductsEnum::PRIORITY_BIG,
                'name'          => 'Приоритетный',
                'description'   => '',
                'min_loan'      => 100,
                'max_loan'      => 1500,
                'loan_terms'    => [
                    [
                        'month_min' => 1,
                        'month_max' => 24,
                        'percents'  => [
                            self::PLEDGE_EXISTS     => 4,
                            self::PARTIAL_PLEDGE    => 4.25,
                            self::NO_PLEDGE         => 6.25,
                        ],
                    ],
                ],
                'is_more_12'    => true,
            ],

            MicrocreditProductsEnum::UNIVERSAL_BIG => [
                'id'            => MicrocreditProductsEnum::UNIVERSAL_BIG,
                'name'          => 'Универсальный',
                'description'   => '',
                'min_loan'      => 100,
                'max_loan'      => 3000,
                'loan_terms'    => [
                    [
                        'month_min' => 1,
                        'month_max' => 24,
                        'percents'  => [
                            self::PLEDGE_EXISTS     => 4.25,
                            self::PARTIAL_PLEDGE    => 4.25,
                            self::NO_PLEDGE         => 6.37,
                        ],
                    ],
                ],
                'is_more_12'    => true,
            ],

            MicrocreditProductsEnum::RESTART_BIG => [
                'id'            => MicrocreditProductsEnum::RESTART_BIG,
                'name'          => 'Рестарт',
                'description'   => '',
                'min_loan'      => 100,
                'max_loan'      => 2500,
                'loan_terms'    => [
                    [
                        'month_min' => 1,
                        'month_max' => 6,
                        'percents'  => [
                            self::PLEDGE_EXISTS     => 1,
                            self::PARTIAL_PLEDGE    => 3.5,
                            self::NO_PLEDGE         => 3.5,
                        ],
                    ],
                    [
                        'month_min' => 7,
                        'month_max' => 12,
                        'percents'  => [
                            self::PLEDGE_EXISTS     => 2,
                            self::PARTIAL_PLEDGE    => 3.75,
                            self::NO_PLEDGE         => 3.75,
                        ],
                    ],
                    [
                        'month_min' => 13,
                        'month_max' => 18,
                        'percents'  => [
                            self::PLEDGE_EXISTS     => 3,
                            self::PARTIAL_PLEDGE    => 4,
                            self::NO_PLEDGE         => 4,
                        ],
                    ],
                    [
                        'month_min' => 19,
                        'month_max' => 24,
                        'percents'  => [
                            self::PLEDGE_EXISTS     => 4,
                            self::PARTIAL_PLEDGE    => 4.25,
                            self::NO_PLEDGE         => 4.25,
                        ],
                    ],
                ],
                'is_more_12'    => true,
            ],

            MicrocreditProductsEnum::TENDER_BIG => [
                'id'            => MicrocreditProductsEnum::TENDER_BIG,
                'name'          => 'Тендерный',
                'description'   => '',
                'min_loan'      => 100,
                'max_loan'      => 5000,
                'loan_terms'    => [
                    [
                        'month_min' => 1,
                        'month_max' => 14,
                        'percents'  => [
                            self::PLEDGE_EXISTS     => 3,
                            self::PARTIAL_PLEDGE    => 4.25,
                            self::NO_PLEDGE         => 4.25,
                        ],
                    ],
                ],
                'is_more_12'    => true,
            ],

            MicrocreditProductsEnum::EASY_START_SMALL => [
                'id'            => MicrocreditProductsEnum::EASY_START_SMALL,
                'name'          => 'Легкий старт',
                'description'   => '',
                'min_loan'      => 100,
                'max_loan'      => 1000,
                'loan_terms'    => [
                    [
                        'month_min' => 1,
                        'month_max' => 24,
                        'percents'  => [
                            self::PLEDGE_EXISTS     => 1,
                            self::PARTIAL_PLEDGE    => 1,
                            self::NO_PLEDGE         => 1,
                        ],
                    ],
                ],
                'is_more_12'    => false,
            ],

            MicrocreditProductsEnum::MONO_CITY_SMALL => [
                'id'            => MicrocreditProductsEnum::MONO_CITY_SMALL,
                'name'          => 'Моногород',
                'description'   => '',
                'min_loan'      => 100,
                'max_loan'      => 1000,
                'loan_terms'    => [
                    [
                        'month_min' => 1,
                        'month_max' => 24,
                        'percents'  => [
                            self::PLEDGE_EXISTS     => 2.12,
                            self::PARTIAL_PLEDGE    => 4.25,
                            self::NO_PLEDGE         => 4.25,
                        ],
                    ],
                ],
                'is_more_12'    => false,
            ],

            MicrocreditProductsEnum::ASPIRING_ENTREPRENEUR_SMALL => [
                'id'            => MicrocreditProductsEnum::ASPIRING_ENTREPRENEUR_SMALL,
                'name'          => 'Начинающий предприниматель',
                'description'   => '',
                'min_loan'      => 100,
                'max_loan'      => 1000,
                'loan_terms'    => [
                    [
                        'month_min' => 1,
                        'month_max' => 24,
                        'percents'  => [
                            self::PLEDGE_EXISTS     => 4.25,
                            self::PARTIAL_PLEDGE    => 4.25,
                            self::NO_PLEDGE         => 6.37,
                        ],
                    ],
                ],
                'is_more_12'    => false,
            ],

            MicrocreditProductsEnum::PRIORITY_SMALL => [
                'id'            => MicrocreditProductsEnum::PRIORITY_SMALL,
                'name'          => 'Приоритетный',
                'description'   => '',
                'min_loan'      => 100,
                'max_loan'      => 1500,
                'loan_terms'    => [
                    [
                        'month_min' => 1,
                        'month_max' => 24,
                        'percents'  => [
                            self::PLEDGE_EXISTS     => 4,
                            self::PARTIAL_PLEDGE    => 4.25,
                            self::NO_PLEDGE         => 6.25,
                        ],
                    ],
                ],
                'is_more_12'    => false,
            ],
        ];
    }
}
