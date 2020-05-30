<?php

namespace BfwTwig;

/**
 * Styx observer
 * @author Aetiom <aetiom@protonmail.com>
 * @version 1.0
 */
class Observer implements \SplObserver
{
    /**
     * @var bool $enable : enable custom HTTP errors
     */
    protected $enable;
    
    /**
     * @var string $template : error twig template
     */
    protected $template;

    /**
     * @var array $map : error map with HTTP error status code as key 
     * and http error status text as data
     */
    protected $map;

    /**
     * @var \Twig\Environment $twig : twig environment
     */
    protected $twig;
    
    
    
    /**
     * Constructor
     * @param \BFW\Config $config : styx config
     */
    public function __construct(\Twig\Environment $twig, Array $config)
    {
        $this->enable = $config['enable'];
        $this->template = $config['template'];

        $this->map = $config['map'];

        $this->twig = $twig;
    }
    
    
    
    /**
     * Receive triggers from BFW Framework 
     * @param \SplSubject $subject
     */
    public function update(\SplSubject $subject) 
    {
		if ($this->enable === true && http_response_code()>=400){
			if ($subject->getAction() === 'ctrlRouterLink_done_checkRouteFound') {
				$this->redirectHttpError(http_response_code());
			}
		}
    }
	
	
    
    /**
     * Redirect HTTP error
     * @param int $code : HTTP error code
     */
    protected function redirectHttpError(int $code)
    {
        http_response_code($code);

        echo $this->twig->render($this->template, [
            'statusCode' => $code,
            'statusText' => isset($this->map[$code]) ? $this->map[$code] : ''
        ]);
    }
}