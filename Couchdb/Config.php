<?php

/**
 * Class Couchdb_Adapter - My short example for an CouchDB - Adapter Configuration Class
 *
 * THIS SOFTWARE IS PROVIDED BY THE REGENTS AND CONTRIBUTORS “AS IS” AND ANY EXPRESS OR 
 * IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY 
 * AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE REGENTS OR 
 * CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL 
 * DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, 
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER 
 * IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT 
 * OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * @category	Database
 * @package		Couchdb
 * @copyright	Copyright (c) 2010 Stefan Staudenmeyer (hadean@hotmail.de)
 * @license		http://www.gnu.org/philosophy/bsd.html
 * @version		0.1 beta - Stefan Staudenmeyer
 */

/**
 * Class Couchdb_Config - My short example for an Couchdb - Adapter Configuration Class
 * 
 * Couchdb - This is just a short example of my work and how I would start to design a Wrapper Class
 * with configuration Data to be read by the Couchdb class.
 * 
 * @category  	Database
 * @package  	Couchdb
 * @copyright	Copyright (c) 2010 Stefan Staudenmeyer (hadean@hotmail.de)
 * @license		http://www.gnu.org/philosophy/bsd.html
 */
final class Couchdb_Config
{
	// Connection - Variables
	protected $_host = NULL;
	protected $_port = NULL;
	protected $_user = NULL;
	protected $_password = NULL;
	
	/**
	 * Set the Hostname / IP to connect to.
	 * @param	string			$host	Hostname / IP of the Database.
	 * @return	Couchdb_Config	$this	This main class for method chaining.
	 * @throws	Couchdb_Exception_Parameter
	 */
	public function setHost($host)
	{
		$ip = new Zend_Validate_Ip;
		$name = new Zend_Validate_Hostname;
		if(
			$ip->isValid($host)
			xor $name->isValid($host)
		)
		{
			throw new Couchdb_Exception_Parameter("Wrong Parameters, host must either be a valid hostname or an IP");
		}
		$this->_host = $host;
		return $this;
	}
	
	
	/**
	 * Set the setPort to connect to.
	 * @param	integer			$port	Port to connect to. Must be numeric.
	 * @return	Couchdb_Config	$this	This main class for method chaining.
	 * @throws	Couchdb_Exception_Parameter
	 */
	public function setPort($port)
	{
		if(!is_integer($port))
		{
			throw new Couchdb_Exception_Parameter("Wrong Parameters, Port must be integer.");
		}
		$this->_port = $port;
		return $this;
	}
	
	/**
	 * OPTIONAL: Set the Administrators Username to be used when working with the Database.
	 * When passed, u also have to pass a password for authentification.
	 * @param	string			$user	Administrators Username.
	 * @return	Couchdb_Config	$this	This main class for method chaining.
	 * @throws	Couchdb_Exception_Parameter
	 */
	public function setUsername($user)
	{
		if(!is_string($user))
		{
			throw new Couchdb_Exception_Parameter("Wrong Parameters, Port must be integer.");
		}
		$this->_user = $user;
		return $this;
	}
	
	/**
	 * OPTIONAL: Set the Administrators Password to be used when working with the Database.
	 * When passed, u also have to pass an username for authentification.
	 * @param	string			$password	Administrators Password.
	 * @return	Couchdb_Config	$this		This main class for method chaining.
	 * @throws	Couchdb_Exception_Parameter
	 */
	public function setPassword($password)
	{
		if(!is_string($password))
		{
			throw new Couchdb_Exception_Parameter("Wrong Parameters, Port must be integer.");
		}
		$this->_password = $password;
		return $this;
	}
	
	/**
	 * Simple getter-method for the set Hostname / IP.
	 * @return	string	$host	Hostname/IP of the Database.
	 */
	public function getHost()
	{
		return (string)$this->_host;
	}
	
	/**
	 * Simple getter-method for the set Port.
	 * @return	string	$port	Port of the Database.
	 */
	public function getPort()
	{
		return (integer)$this->_port;
	}
	
	/**
	 * Simple getter-method for the Username.
	 * @return	string	$user	Username to be used in HTTP authentification.
	 */
	public function getUsername()
	{
		return (string)$this->_user;
	}
	
	/**
	 * Simple getter-method for the set Port.
	 * @return	string	$user	Password to be used in HTTP authentification.
	 */
	public function getPassword()
	{
		return (string)$this->_password;
	}
}