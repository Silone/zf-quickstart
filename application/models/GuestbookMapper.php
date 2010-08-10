<?php

class Application_Model_GuestbookMapper
{
    protected $dbTable;
    
    /**
     * Sets the table data gateway
     * @param string|Zend_DbTable_Abstract $dbTable
     * @return $this provides a fluent interface
     */
    public function setDbTable($dbTable)
    {
        if ( is_string($dbTable) )
        {
            $dbTable = new $dbTable();
        }
        
        if ( ! $dbTable instanceof Zend_Db_Table_Abstract )
        {
            throw new Exception('Invalid table data gateway provided');
        }
        
        $this->dbTable = $dbTable;
        
        return $this;
    }
    
    public function getDbTable()
    {
        if ( null === $this->dbTable )
        {
            $this->setDbTable('Application_Model_DbTable_Guestbook');
        }
        
        return $this->dbTable;
    }
    
    /**
     * Saves or inserts the record
     * @param Application_Model_Guestbook $guestbook
     */
    public function save(Application_Model_Guestbook $guestbook)
    {
        $data = array(
            'email'	=> $guestbook->getEmail(),
            'comment' => $guestbook->getComment(),
            'created' => date('Y-m-d H:i:s')
        );
        
        $id = $guestbook->getId();
        
        if ( null === $id )
        {
            $this->getDbTable()->insert($data);
        }
        else
        {
            $data['id'] = $id;
            $this->getDbTable()->update($data, array('id = ?' => $id));
        }
    }
    
    /**
     * Finds a corresponding row in database 
     * @param int $id
     * @param Application_Model_Guestbook $guestbook
     */
    public function find($id, Application_Model_Guestbook $guestbook)
    {
        $result = $this->getDbTable()->find($id);
        
        if ( 0 == count($result) )
        {
            return;
        }
        
        $row = $result->current();
        
        $guestbook
            ->setId($row->id)
            ->setEmail($row->email)
            ->setComment($row->comment)
            ->setCreated($row->created)
            ;
    }
    
    /**
     * fetches all entries from database and returns them as model classes
     * 
     * @return Application_Model_Guestbook[]
     */
    public function fetchAll()
    {
        $dbTable = $this->getDbTable();
        
        $resultSet = $dbTable->fetchAll();
        $entries = array();
        
        foreach ( $resultSet as $row )
        {
            $entry = new Application_Model_Guestbook();
            $entry
                ->setId($row->id)
                ->setEmail($row->email)
                ->setComment($row->comment)
                ->setCreated($row->created)
                ;
            $entries[] = $entry;    
        }
        
        return $entries;
    }
}
