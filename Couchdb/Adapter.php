<?php

/**
 * Class Couchdb_Adapter - My short example for an CouchDB - Adapter Class
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
 * @category  	Database
 * @package  	Couchdb
 * @copyright	Copyright (c) 2010 Stefan Staudenmeyer (hadean@hotmail.de)
 * @license		http://www.gnu.org/philosophy/bsd.html
 * @version		0.1 beta - Stefan Staudenmeyer
 */

/**
 * Class Couchdb_Adapter - My short example for an CouchDB - Adapter Class
 * 
 * Couchdb_Adapter - This is just a short example of my work and how I would start to design
 * a Wrapper Class to let Models / Mappers connect to a Apache CouchDB.
 * 
 * @category  	Database
 * @package  	Couchdb
 * @copyright	Copyright (c) 2010 Stefan Staudenmeyer (hadean@hotmail.de)
 * @license		http://www.gnu.org/philosophy/bsd.html
 */
class Couchdb_Adapter
{
	// Connection - Variable
	private $_connection = NULL;
		
	/**
	 * Constructor to create a Connection to the Database. The Connection will be saved for
	 * future Actions like creating/reading/updating/deleting (CRUD) Documents within the DB.
	 * @param	Couchdb_Config $connection	Connection Class for the Database
	 * @return	Couchdb_Adapter
	 * @throws	Couchdb_Exception_Connection
	 */
	public function __construct(Couchdb_Config $connection)
	{
		$connecter = new Zend_Http_Client;
		$connecter->setUri('http://' . $connection->getHost() . ':' . $connection->getPort() . '/');
		if(
			$connection->getUsername() != NULL
			&& $connection->getPassword() != NULL
		)
		{
			$connecter->setAuth(
				$connection->getUsername(), 
				$connection->getPassword()
			);
		}
		if(!$connecter->request('GET')->isSuccessful())
		{
			throw new Couchdb_Exception_Connection("Could not connect to URl: " . 
				'http://' . $connection->getHost() . ':' . $connection->getPort());
		}
		$this->_connection = $connecter;
		return $this;
	}
	
	/**
	 * Simple Get-Method for reading Documents from the DB.
	 * @param	string	$url		URl to read from, including a trailing slash.
	 * @return	array	$documents	Array with the actual requested Documents.
	 * @throws	Couchdb_Exception_Connection
	 */	
	public function getFromUri($url)
	{
		$host = $this->_connection->getUri(TRUE);
		$uri = $this->_connection->setUri($host . $url)
								 ->request('GET');
		if(!$uri->isSuccessful())
		{
			throw new Couchdb_Exception_Connection("Could not connect to URl: " . 
				'http://' . $connection->getHost() . ':' . $connection->getPort() . $url);
		}
		$document = json_decode($uri->getBody());
		return $document;
	}
}