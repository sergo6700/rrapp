<?php

namespace App\Jobs;

use App\Events\Models\AbstractApplicationCreated;
use App\Support\Email\EmailGateway;
use App\Support\Email\EmailFactory;

/**
 * Class ApplicationCreated
 *
 * @package App\Jobs
 */
class ApplicationCreated extends AbstractApplicationCreated
{
    /**
     * Get data to application create email and send email
     */
    public function handle(): void
    {
        $emailObj = EmailFactory::create($this->model);

        EmailGateway::send(
            $emailObj->getEmails(),
            $emailObj->getSubject(),
            $emailObj->getContent()
        );
    }
}
