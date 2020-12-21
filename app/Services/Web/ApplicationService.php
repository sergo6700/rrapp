<?php


namespace App\Services\Web;


use App\Models\Acl\User;
use App\Models\Application\Application;
use App\Models\Service\Service;
use Auth;

/**
 * Class ApplicationService
 * @package App\Services\Web
 */
class ApplicationService
{
    /**
     * Create application
     * @param array $array
     */
    public function create(array $array): void
    {
        $application = new Application();
        if (Auth::check()) {
            $application->user_id = Auth::user()->id;
        } else {
            $application->full_name = $array['full_name'];
            $application->email = $array['email'];
        }

        $application->kind_of_activity = $array['kind_of_activity'];
//        $application->subject = $array['subject'];
        $application->content = $array['content'];
        $application->type_id = Application::FEEDBACK_TYPE;
        $application->page_url = $array['page_url'];
        $application->page_title = $array['page_title'];
        $application->save();
    }

	/**
	 * Create new application
	 *
	 * @param array $params
	 * @return Application
	 */
	public function createDefault(array $params): Application
	{
		return Application::create($params);
    }

	/**
	 * Form array to create application from service feedback
	 *
	 * @param Service $service
	 * @param User $user
	 * @param array $params
	 * @return array
	 */
	public function formFromService(Service $service, User $user, array $params): array
	{
		return $params + [
				'service_id' => $service->id,
				'user_id' => $user->id,
				'type_id' => Application::SERVICE_TYPE,
			];
    }

}
