<?php


namespace App\Services\Web;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

/**
 * Class UloginService
 * @package App\Services\Web
 */
class UloginService
{
    /**
     * Endpoint for requesting user data
     *
     * @var string ULOGIN_URL
     */
    protected const ULOGIN_URL = 'http://ulogin.ru/token.php?token=';

	/**
     * Allowed array keys that should be in the response from the URL Ulogin (the URL is stored in the ULOGIN_URL constant)
     *
	 * @var array ALLOWED_KEYS
	 */
	private const ALLOWED_KEYS = [
		'network',
		'identity',
		'first_name',
		'last_name',
	];

    /**
     * Get user data from Ulogin
     *
     * @param array $array
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get_data(array $array) :array
    {
        $url = self::ULOGIN_URL . $array['token'] . '&host=' . \URL::to('/');
        try {
            $response = $this->requestData($url);
            $userOfSocialNetwork = json_decode($response->getBody(), true);

            if ((JSON_ERROR_NONE !== json_last_error()) || !$this->validateArrayUser($userOfSocialNetwork)) {
                throw new \DomainException('Incorrect response from Ulogin');
            }

            return [
            	'success' => true,
				'user' => $userOfSocialNetwork
			];
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
			return [
				'success' => false,
				'exception' => $e
			];
        }
    }


    /**
     * Request data from the specified URL
     *
     * @param string $url
     * @return Response
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function requestData(string $url): Response
    {
        $client = new Client();
        return $client->request('GET', $url);
    }

    /**
     * Validate array with user data
     *
     * @param $array
     * @return bool
     */
    private function validateArrayUser(array $array) :bool
    {
        $result_arr = array_intersect_key(
        	$array,
			array_flip(self::ALLOWED_KEYS)
		);

        return count($result_arr) === count(self::ALLOWED_KEYS);
    }
}
