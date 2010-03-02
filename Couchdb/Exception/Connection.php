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
 * Class Couchdb_Exception_Connection - Exception Class to be thrown on Connection Errors
 * 
 * Couchdb_Exception_Connection - This class will be thrown by Couchdb if the connection fails
 * with any kind of error.
 * 
 * @category  	Database
 * @package  	Couchdb
 * @copyright	Copyright (c) 2010 Stefan Staudenmeyer (hadean@hotmail.de)
 * @license		http://www.gnu.org/philosophy/bsd.html
 */
class Couchdb_Exception_Connection extends Exception{}