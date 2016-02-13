<?php

namespace App;

use App\Section;
use App\Traits\UserTrait;
use Illuminate\Http\Request;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
	/**
	 * Adds a method to append the user_id and tenant_id onto a record
	 */
	use UserTrait;

	protected $fillable = ['quiz_title', 'quiz_description', 'is_public'];

    /*
    * Realtionship: one quiz can have many sections
     */
    public function sections()
    {
    	return hasMany(Section::class);
    }

    /*
    Get a paginated list of quizzes
     */
    public function getQuizzes()
    {
    	return $this->paginate(5);
    }

    /**
     * Stores a new quiz
     * @param  Request $request The request object

     */
    public function createQuiz(Request $request)
    {
 		// Set the basic properties
		$this->quiz_title = $request->quiz_title;
		$this->quiz_description = $request->quiz_description;
		$this->is_public = $request->is_public;

		// Set the user_id & tenant_id (from the Auth::user()) & persist
		$this->addUserAttributes();
		$this->save(); //sets the row id - rqd for the hash below

		// Set the quiz url & update the record
		$this->quiz_url = Hashids::encode($this->id);
 		$this->save();
    }

}
