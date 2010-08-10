<?php

class Application_Form_Guestbook extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
        
        // Set the method for the display form to POST
        $this->setMethod('post');
        
        
        $elements = array();
        // Add an email element
        
        $email = new Zend_Form_Element_Text('email');
        $email
            ->setLabel('Your email address:')
            ->setRequired()
            ->addFilter(new Zend_Filter_StringTrim())
            ->addValidator(new Zend_Validate_EmailAddress())
            ;
        $elements[] = $email;

        // Add the comment element
        $comment = new Zend_Form_Element_Textarea('comment');
        $comment
            ->setLabel('Please Comment:')
            ->setRequired()
            ->addValidator(new Zend_Validate_StringLength(0, 20))
            ;
            
        $elements[] = $comment;    

        // Add the submit button
        $elements[] = $this->createElement('submit', 'submit', array(
            'ignore' => true,
            'label' => 'Sign Guestbook'
        ));

        $this->addElements($elements);
        
        // And finally add some CSRF protection
        $this->addElement('hash', 'csrf', array('ignore' => true));
        
        
    }


}

