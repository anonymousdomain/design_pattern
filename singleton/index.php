<?

class Singleton
{

    private static $instance = [];
    protected function __construct()
    {
    }

    public static function getInstance()
    {

        $subclass = static::class;

        if (!isset(self::$instance[$subclass])) {
            self::$instance[$subclass] = new static();
        }

        return self::$instance[$subclass];
    }
}

class Logger extends Singleton
{
    private $fileHandle;

    public function __construct()
    {
        echo "hello LOgger ";
    }
}


class ClientCode
{
    public function __construct()
    {
        echo "this is just a client constraction ";
    }
}

$cl = new ClientCode();
