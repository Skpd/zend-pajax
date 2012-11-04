zend-pajax
==========

Context switch helper to handle Pajax requests.

##Usage

To enable Pajax context switch helper you need:
* Add `$pagaxable` array with list of pajaxable methods;
* Add Helper init into Controller::init() method;
* Enjoy.

```php
class IndexController extends Zend_Controller_Action
{

    /**
     * List of actions to handle
     * @var array
     */
    public $pajaxable = array(
        'index' => true,
    );

    public function init()
    {
        $this->_helper->pajaxContext()->initContext();
    }

    public function indexAction()
    {
        // this action will be handled by pajax requests
    }
}
```

There is no conflicts with `Zend_Controller_Action_Helper_ContextSwitch` or 
`Zend_Controller_Action_Helper_AjaxContext`, so you can use both of them:

```php
class IndexController extends Zend_Controller_Action
{

    public $ajaxable = array(
        'index' => array('json'),
    );

    /**
     * List of actions to handle
     * @var array
     */
    public $pajaxable = array(
        'index' => true,
    );

    public function init()
    {
        $this->_helper->ajaxContext()->initContext('json');
        $this->_helper->pajaxContext()->initContext();
    }

    public function indexAction()
    {
        // this action will be handled by pajax requests or json request, depends on headers.
    }
}
```