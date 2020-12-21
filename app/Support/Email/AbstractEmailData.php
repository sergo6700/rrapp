<?php


namespace App\Support\Email;

use App\Models\Application\Application;

/**
 * Interface EmailData
 *
 * @package App\Support\Email
 */
abstract class AbstractEmailData implements EmailData
{
    /**
     * Generate link
     *
     * @return string $link
     */
    public function generateURL(Application $application): string
    {
        $link = '—';
        if ($application->page_url) {
            $page_title = $application->page_title;
            if (!$page_title) {
                $pattern = '/^http(s)?:\/\//';
                $replacement = '';
                $page_title = preg_replace($pattern, $replacement, $application->page_url);
            }

            $link = "<a href='$application->page_url' target='_blank'>$page_title</a>";
        }

        return $link;
    }
}