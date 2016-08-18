<?php 
namespace App\Http\Controllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Storage;

use Pqb\FilemanagerLaravel\FilemanagerLaravel;

class FilemanagerLaravelController extends Controller {
	public function __construct(){
		// $this->middleware('auth');
		
	}
	public function getShow()
	{
		return view('filemanager-laravel::filemanager.index');
	}
	public function getConnectors()
	{
		$f = FilemanagerLaravel::Filemanager();
		$f->connector_url = url('/').'/filemanager/connectors';
		
		$user = auth()->user();

		if ( !Storage::disk('users')->exists( $user->id ) )
			Storage::disk('users')->makeDirectory( $user->id );

		if ($user->hasRole('admin'))
			$f->setFileRoot( public_path('filemanager/userfiles') );
		else
			$f->setFileRoot( public_path('filemanager/userfiles/'.$user->id) );

		$f->run();
	}
	public function postConnectors()
	{
		$f = FilemanagerLaravel::Filemanager();
		$f->connector_url = url('/').'/filemanager/connectors';

		$user = auth()->user();

		if ( !Storage::disk('users')->exists( $user->id ) )
			Storage::disk('users')->makeDirectory( $user->id );

		if ($user->hasRole('admin'))
			$f->setFileRoot( public_path('filemanager/userfiles') );
		else
			$f->setFileRoot( public_path('filemanager/userfiles/'.$user->id) );

		$f->run();
	}

}
