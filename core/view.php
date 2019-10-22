<?php 
    class View
    {
      protected $data = array();
      protected $path;

      public function __construct($path, array $data = array())
      {
        $this->path = $path;
        $this->data = $data;
      }

      public function render()
      {

        // Extract the data so you can access all the variables in
        // the "data" array inside your included view files
        ob_start(); 
        extract($this->data);
        ob_end_clean();
        try
        {
        include $this->path;
        }
        catch(\Exception $e)
        {
          ob_end_clean(); throw $e;
        }
        return ob_get_clean();
      }

      /**
       * Make it able for you to write a code like this: echo new View("home.php")
       */
      public function __toString()
      {
        return $this->render();
      }
    }
?>