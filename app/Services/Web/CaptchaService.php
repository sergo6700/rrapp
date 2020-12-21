<?php

namespace App\Services\Web;

use GuzzleHttp\Client;

/**
 * Class CaptchaService
 *
 * @package App\Services\Web
 */
class CaptchaService
{
	/**
	 * Url to check captcha
	 *
	 * @var string
	 */
	protected $captcha_url = 'https://www.google.com/recaptcha/api/siteverify';

    /**
     * Score (1.0 is very likely a good interaction, 0.0 is very likely a bot)
     * By default, we can use a score of 0.5.
     *
     * @var float
     */
	protected $score = 0.5;


	/**
	 * Check reCaptcha v2
	 *
	 * @param null|string $response
	 * @return bool
	 */
	public function verifyV2(?string $response): bool
	{
		$secret = env('CAPTCHA_SECRET', '');
        if (!$secret) {
            throw new \InvalidArgumentException('The shared key between your site and reCAPTCHA is empty');
        }

		$client = new Client();

		$answer = $client->post($this->captcha_url, [
			'form_params' => compact('secret', 'response'),
		]);

		$answer = json_decode($answer->getBody(), true);

		return $answer['success'];
	}

    /**
     * Check reCaptcha v3
     *
     * @param string|null $response
     * @return bool
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function verify(?string $response): bool
    {
        $secret = env('CAPTCHA_SECRET_V3', '');
        if (!$secret) {
            throw new \InvalidArgumentException('The shared key between your site and reCAPTCHA is empty');
        }

        $client = new Client();
        $response = $client->request(
            'POST',
            $this->captcha_url,
            [
                'query' => [
                    'secret' => $secret,
                    'response' => $response
                ]
            ]
        );

        $response = json_decode($response->getBody(), true);

        return ($response['success'] === true && $response['score'] > $this->score);
    }
}
