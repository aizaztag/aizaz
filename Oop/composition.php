<?php

interface CommonInterface{
    public function getBlogs();
    public function getPostById($id);
}

class BaseController{

    public function loadView($view, $data = [])
    {
        if (file_exists($view . '.php')) {
            require_once($view . '.php');
        } else {
            require_once('404.php');
        }
    }

    public function loadModel($model)
    {
        // require_once($model . '.php');
        return new $model(new Database());
    }

}

class Post implements CommonInterface{

    private $blogpost;

    public function __construct(Database $blogpost)
    {
        $this->blogpost = $blogpost;
    }

    // Get All BlogPost
    public function getBlogs()
    {

        $this->blogpost->query("SELECT * FROM blog");
        return $this->blogpost->resultset();
    }

    // Get BlogPost By Id
    public function getPostById($id)
    {
        $this->blogpost->query("SELECT * FROM posts WHERE id = :id");
        $this->blogpost->bind(':id', $id);
        return $this->blogpost->single();
    }

}

class Database{
    public function query()
    {
        return 'blog table';
    }

    public function resultset()
    {
        return ['title' => 'titile', 'body' => 'body'];
    }
}

class Blog implements CommonInterface
{
    private $blogpost;

    public function __construct(Database $blogpost)
    {
        $this->blogpost = $blogpost;
    }

    // Get All BlogPost
    public function getBlogs()
    {
        $this->blogpost->query("SELECT * FROM blog");
        return $this->blogpost->resultset();
    }

    // Get BlogPost By Id
    public function getPostById($id)
    {
        $this->blogpost->query("SELECT * FROM posts WHERE id = :id");
        $this->blogpost->bind(':id', $id);
        return $this->blogpost->single();
    }
}


class HomeController extends BaseController
{
    protected $model;

    public function __construct($model)
    {
        $this->model = $model;
        // Load Models
        $this->blogModel = $this->loadModel($this->model); // calling base class function
    }

    // Load All Posts
    public function index()
    {
        $data = [
            'posts' => $this->blogModel->getBlogs() // calling related model function  // like blog or post
        ];
        //load view to retrieve data
        $this->loadView('blogs', $data); // calling base class function
    }
}

$blog = new HomeController('Blog');
//var_dump($blog->loadModel('Blog'));
$blog->index();