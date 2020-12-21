<?php


namespace App\Support\Email;

/**
 * Interface EmailData
 *
 * @package App\Support\Email
 */
interface EmailData
{
    /**
     * Get emails of application feedback
     * @return array
     */
    public function getEmails(): array;

    /**
     * Get subject application service
     * @return string
     */
    public function getSubject(): string;

    /**
     * Get content of email
     * @return string
     */
    public function getContent(): string;
}