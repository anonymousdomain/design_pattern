<?php

abstract class SocialNetworkPostor
{

    abstract public function getSocialNetwork(): SocialNetworkConnector;

    public function post($content): void
    {

        $network = $this->getSocialNetwork();
        $network->logIn();
        $network->createPOst($content);
        // $network->logOut();
    }
}

class FaceBookPostor extends SocialNetworkPostor
{
    private $login, $password;
    public function __construct(string $login, string $password)
    {
        $this->login = $login;
        $this->password = $password;
    }
    public function getSocialNetwork(): SocialNetworkConnector
    {
        return new FaceBookConnector($this->login, $this->password);
    }
}
class LinkedInPostor extends SocialNetworkPostor
{
    private $email, $password;

    public function __construct(string $email, string $password)
    {

        $this->email = $email;
        $this->password = $password;
    }

    public function getSocialNetwork(): SocialNetworkConnector
    {
        return new LinkedInConnector($this->email, $this->password);
    }
}


interface SocialNetworkConnector
{
    public function logIn(): void;

    public function logOut(): void;

    public function createPost($content): void;
}

class FaceBookConnector implements SocialNetworkConnector
{

    private $login, $password;
    public function __construct(string $login, string $password)
    {
        $this->login = $login;
        $this->password = $password;
    }
    public function logIn(): void
    {
        echo "Send HTTP API request to log in user $this->login with " .
        "password $this->password\n";
    }
    public function logOut(): void
    {
        echo "Send HTTP API request to log out user $this->login\n";

    }

    public function createPost($content): void
    {
        echo "Send HTTP API requests to create a post in Facebook timeline.\n";
    }
}
class LinkedInConnector implements SocialNetworkConnector
{

    private $email, $password;
    public function __construct(string $email, string $password)
    {
        $this->email = $email;
        $this->password = $password;
    }
   
    public function logIn(): void
    {
        echo "Send HTTP API request to log in user $this->email with " .
            "password $this->password\n";
    }

    public function logOut(): void
    {
        echo "Send HTTP API request to log out user $this->email\n";
    }

    public function createPost($content): void
    {
        echo "Send HTTP API requests to create a post in LinkedIn timeline.\n";
    }
}

 function clientCode(SocialNetworkPostor $create){
$create->post("hello this is just a test runnig from client code ");
}


clientCode(new FaceBookPostor('Dawit Mekonnen','1234pass'));
clientCode(new LinkedInPostor('dawit@linkedin.com','1234pass'));