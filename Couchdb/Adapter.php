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
	// Configuration - Variable (instanceof Couchdb_Config)
	private $_config = NULL;
		
	/**
	 * Constructor to create a Connection to the Database. The Connection will be saved for
	 * future Actions like creating/reading/updating/deleting (CRUD) Documents within the DB.
	 * @param	Couchdb_Config $connection	Configuration Class for the Database
	 * @return	Couchdb_Adapter
	 * @throws	Couchdb_Exception_Connection
	 */
	public function __construct(Couchdb_Config $config)
	{
		$this->_config = $config;
		return $this;
	}
	
	/**
	 * Private Get-Method for the host String of global config variables.
	 * @return string	Host - String to connect to.
	 */
	private function _getHostString()
	{
		return 'http://' . $this->_config->getHost() . ':' . $this->_config->getPort() . '/';
	}
	
	/**
	 * Simple Get-Method for reading Documents from the DB.
	 * @param	string		$url		URl to read from, including a trailing slash.
	 * @param	string|TRUE	$revision	Revision of Document, TRUE returns the latest Revision.
	 * @return	array		$documents	Array with the actual requested Documents.
	 * @throws	Couchdb_Exception_Connection
	 */	
	public function getFromUri($url, $revision = TRUE)
	{
		$connecter = new Zend_Http_Client;
		if(
			$this->_config->getUsername() != NULL
			&& $this->_config->getPassword() != NULL
		)
		{
			$connecter->setAuth(
				$this->_config->getUsername(), 
				$this->_config->getPassword()
			);
		}		
		$host = $this->_getHostString();
		$uri = ($revision === TRUE) 
			? $url
			: $url . '?rev=' . $revision;
		$document = $connecter->setUri($host . $uri)
							  ->request('GET');
		if(!$document->isSuccessful())
		{
			$error = "Could not connect to URl: " . $host . $uri;
			if($revision !== TRUE)
			{
				$error .= ". Also consider that your called revision was compacted away.";
			}
			throw new Couchdb_Exception_Connection($error);
		}
		$array = json_decode($document->getBody());
		return $array;
	}
}