<?php


namespace App\Support\Service;


use App\Models\Application\Application;
use App\Models\Service\Service;

class ServiceHelper
{
    /**
     * Get total service applications link
     * @param Service $service
     * @return string
     */
    public static function getTotalApplicationsLink(Service $service): string
    {
        return '<a href="application-service?service_id='.$service->id.'">'.$service->applications
            ->where('type_id', Application::SERVICE_TYPE)->count().'</a>';
    }

    /**
     * Get new service applications link
     * @param Service $service
     * @return string
     */
    public static function getNewApplicationsLink(Service $service): string
    {
        $completed = $service->applications->where('is_completed', true)->where('type_id', Application::SERVICE_TYPE);
        $new_count = $service->applications
                ->where('type_id', Application::SERVICE_TYPE)->count() - $completed->count();

        return '<a href="application-service?service_id='.$service->id.'">'.$new_count.'</a>';
    }
}