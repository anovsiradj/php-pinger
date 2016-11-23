<?php // 201611231533

namespace anovsiradj;

use Exception;

class Pinger
{
	protected static $instances = array();
	protected $socket;

	private $id;
	private $hostname;
	private $port;
	private $timeout;

	public $errno;
	public $errstr;

	public $status;
	public $time;

	public static function init($id, $hostname = null, $port = 80, $timeout = 10)
	{
		if (!isset(static::$instances[$id])) {
			if (empty($hostname)) {
				throw new Exception('<b>' . __CLASS__ . "</b>: ID \"<b>{$id}</b>\" Not Found. HOSTNAME <b>Cannot</b> be Empty.");
				return;
			}
			static::$instances[$id] = new Pinger($id, $hostname, $port, $timeout);
		}
		return static::$instances[$id];
	}

	private function __construct($id, $hostname, $port, $timeout)
	{
		$this->id = $id;
		$this->hostname = $hostname;
		$this->port = $port;
		$this->timeout = $timeout;
	}

	public function connect()
	{
		$this->reset();
		$starttime = microtime(true);
		$this->socket = @fsockopen($this->hostname, $this->port, $this->errno, $this->errstr, $this->timeout);
		$stoptime  = microtime(true);

		if ($this->socket) {
			@fclose($this->socket);
			$this->time = ($stoptime-$starttime)*1000;
			$this->status = true;
			return true;
		} else {
			$this->status = false;
			return false;
		}
	}

	public function reset()
	{
		$this->status = null;
		$this->time = 0;

		$this->errno = 0;
		$this->errstr = null;

		if (isset($this->socket)) unset($this->socket);
	}
}
