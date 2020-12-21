<?php


namespace App\Support\Hash;

/**
 * Class HashHelper
 * @package App\Support\Hash
 */
class HashHelper
{
    /**
     * Function hash name
     *
     * @var string
     */
    protected $functionHashName;

    /**
     * HashService constructor (eg. 'md5', 'sha1' and so on)
     * @param string $functionHashName
     */
    public function __construct(string $functionHashName = 'md5')
    {
        $this->functionHashName = $functionHashName;
    }

    /**
     * @param string $str
     * @return string
     */
    public function compute(string $str) :string
    {
        return call_user_func_array($this->functionHashName, [$str]);
    }

    /**
     * Hash comparison
     *
     * @param string $known_string
     * @param string $user_string
     * @return bool
     */
    public function isEqual(string $known_string , string $user_string ) :bool
    {
        return hash_equals($known_string , $user_string);
    }
}