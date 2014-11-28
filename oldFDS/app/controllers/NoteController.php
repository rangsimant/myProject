<?php

class NoteController extends BaseController {

    /**
     * Users Profile
     * @var Post
     */
    protected $profile;

    /**
     * Post Model
     * @var Post
     */
    protected $post;

    /**
     * User Model
     * @var User
     */
    protected $user;

    /**
     * Inject the models.
     * @param Post $post
     * @param User $user
     */
    public function __construct(Post $post, User $user,Profile $profile)
    {
        parent::__construct();

        $this->post = $post;
        $this->user = $user;
        $this->profile = $profile;
    }
    
	/**
	 * Returns all the blog posts.
	 *
	 * @return View
	 */
	public function getIndex()
	{
		$title = Lang::get('note/note.title');
        $note = new Note();
        $user = $note->getProfile();
		// Show the page
		return View::make('site/note/index', compact('user','title'));
	}


}
