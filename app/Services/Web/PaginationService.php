<?php


namespace App\Services\Web;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class PaginationService
 *
 * @package App\Services\Web
 */
class PaginationService
{
    const DELIMITER = '...';

    /**
     * PaginationService
     *
     * @param LengthAwarePaginator $paginator df
     *
     * @return array
     */
    public function calculate(LengthAwarePaginator $paginator): array
    {
        $pagination_arr = [];
        $first_page_arr = [];
        $arround_items = 3;

        $start_range = $paginator->currentPage() - $arround_items;
        if ($start_range > $paginator->lastPage()) {
            $start_range = $paginator->lastPage();
        } elseif (1 > $start_range) {
            $start_range = 1;
        }


        $end_range = $paginator->currentPage() + $arround_items;
        $end_range = ($end_range > $paginator->lastPage()) ? $paginator->lastPage() : $end_range;

        $range_intermediate_of_pagination = range($start_range, $end_range);


        array_unshift($first_page_arr, 1);
        if (($range_intermediate_of_pagination[array_key_first($range_intermediate_of_pagination)] - 1) > 1) {
            array_push($first_page_arr, '...');
        }


        // создаем конец массива
        $last_page_arr = [$paginator->lastPage()];
        if (($paginator->lastPage() - $range_intermediate_of_pagination[array_key_last($range_intermediate_of_pagination)]) > 1) {
            array_unshift($last_page_arr, '...');
        }

        $pagination_arr += $first_page_arr;

        foreach ($range_intermediate_of_pagination as $item) {
            if (array_search($item, $pagination_arr) === false) {
                $pagination_arr[] = $item;
            }
        }

        foreach ($last_page_arr as $item) {
            if (is_string($item)) {
                $pagination_arr[] = $item;
                continue;
            }

            if (array_search($item, $pagination_arr) === false) {
                $pagination_arr[] = $item;
            }
        }

        return $pagination_arr;
    }

}