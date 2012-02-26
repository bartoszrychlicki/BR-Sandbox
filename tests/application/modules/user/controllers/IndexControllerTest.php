<?php
class User_IndexControllerTest extends Zend_Test_PHPUnit_ControllerTestCase
{

    public function setUp()
    {
        $this->bootstrap = new Zend_Application(APPLICATION_ENV, APPLICATION_PATH . '/configs/application.ini');
        parent::setUp();
    }

    public function testLoginFormIsOnIndex()
    {
        $this->dispatch('/user');
        
        // assertions
        $this->assertModule('user');
        $this->assertController('index');
        $this->assertAction('index');
        $this->assertQuery("form");
    }

    public function testPassingEmptyForWillNotGetMeIn()
    {
		$this->request->setMethod('post')
						->setPost(array(
							'username' => '',
							'password'	=> '',
							));
	
        $this->dispatch('/user');
        
        // assertions
        $this->assertModule('user');
        $this->assertController('index');
        $this->assertAction('index');
        $this->assertQuery("form");
    }

    public function testPassignRightValuesWillGetMeInOnDigest()
    {
		$this->request->setMethod('post')
						->setPost(array(
							'username' => 'brdesign',
							'password'	=> 'brdesign',
							));
	
        $this->dispatch('/user');
        
        // assertions
        $this->assertRedirectTo('/');
    }

	/**
	 * @dataProvider wrongUserNameDataProvider
	 */
	public function testPassingWrongUserNameWillNotGetMeIn($username, $password)
	{
		$this->request->setMethod('post')
						->setPost(array(
							'username' => $username,
							'password'	=> $password,
							));
	
        $this->dispatch('/user');
        
        // assertions
        $this->assertNotRedirectTo('/');
        $this->assertModule('user');
        $this->assertController('index');
        $this->assertAction('index');
        $this->assertQuery("form");
	}
	
	public function wrongUserNameDataProvider() {
		return array(
			array('username' => 'niematakiegousera', 'password' => 'krysp'),
			array('username' => '', 'password' => ''),
			array('username' => rand(1,100000), 'password' => rand(1, 100000000)),
			array('username' => 'niematakiegousera', 'password' => 'krysp'),
		);
	}
}



