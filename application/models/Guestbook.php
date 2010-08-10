<?php

class Application_Model_Guestbook
{
    protected $comment;
    protected $created;
    protected $email;
    protected $id;
    
    public function __construct(array $options = null)
    {
        if ( is_array($options) )
        {
            $this->setOptions($options);
        }
    }
    
    public function __set($name, $value)
    {
        $method = 'set' . ucfirst($name);
        
        if ( ('mapper' == $name) || !method_exists($this, $method))
        {
            throw new Exception('Invalid guestbook property');
        }
        $this->$method($value);
    }

    public function __get($name)
    {
        $method = 'get' . ucfirst($name);
        if (('mapper' == $name) || !method_exists($this, $method))
        {
            throw new Exception('Invalid guestbook property');
        }
        return $this->$method();
    }
    
    /**
     * Set two to all params of the model as array
     * @param array $options
     * @return $this provides a fluent interface
     */
    public function setOptions(array $options)
    {
        $methods = get_class_methods($this);
        
        foreach ( $options as $key => $value )
        {
            $method = 'set' . ucfirst($key);
            if ( in_array( $method, $methods) )
            {
                $this->$method($value);
            }
        }
        
        return $this;
    }
    
	/**
     * @return string $comment
     */
    public function getComment()
    {
        return $this->comment;
    }

	/**
     * @param $comment the $comment to set
     * @return $this provides a fluent interface
     */
    public function setComment( $comment )
    {
        $this->comment = (string) $comment;
        return $this;
    }

	/**
     * @return timestamp $created
     */
    public function getCreated()
    {
        return $this->created;
    }

	/**
     * @param $created the $created to set
     * @return $this provides a fluent interface
     */
    public function setCreated( $created )
    {
        $this->created = $created;
        return $this;
    }

	/**
     * @return string $email
     */
    public function getEmail()
    {
        return $this->email;
    }

	/**
     * @param $email the $email to set
     * @return $this provides a fluent interface
     */
    public function setEmail( $email )
    {
        $this->email = $email;
        return $this;
    }

	/**
     * @return int $id
     */
    public function getId()
    {
        return $this->id;
    }

	/**
     * @param $id the $id to set
     * @return $this provides a fluent interface
     */
    public function setId( $id )
    {
        $this->id = (int) $id;
        return $this;
    }
}

