<?php
    
    use PHPUnit\Framework\TestCase;
    use App\Common\Request;
    class TestAutoload extends TestCase {
        
        /**
        * @expectedException        Error
        * @expectedExceptionMessage Class
        */
        public function testWrongNonExistingClass()
        {
            $obj = new App\Common\NonExistentClass;
        }
        
        public function testCorrectClass()
        {
            $obj = new App\Common\Request;
        }

    }
    
?>